<?php
session_start();

$_SESSION["usuario"] = array(
	'id' => 4,
	'nombre' => 'Marcelo'
);

$idLugar = $_GET['id'];

$usuarioID = $_SESSION["usuario"]["id"];

include('helpers/class.Conexion.php');

$db = new Conexion();
$db->charset();

//Obtener Datos Lugar
$obtenerLugarQ = $db->query("SELECT * FROM lugar WHERE id_lugar = $idLugar LIMIT 1");
$resLugar = $db->recorrer($obtenerLugarQ);

//Obtener Datos Retaurante realionado lugar
$obtenerRestoQ = $db->query("SELECT * FROM restaurante WHERE lugar = $idLugar LIMIT 1");
$resResto = $db->recorrer($obtenerRestoQ);

//Obtener Imagenes
$obtenerImgs = $db->query("SELECT * FROM imagen WHERE lugar = $idLugar");
if($db->rows($obtenerImgs) > 0) {
	while($resImg = $db->recorrer($obtenerImgs)) {
		$imgsResto[] = array(
			'id' => $resImg["id_imagen"],
			'desc' => $resImg["descripcion"],
			'url' => $resImg["url"],
		);
	}
}
$db->liberar($obtenerImgs);

//Obtener numeros de contacto
$obtenerContactos = $db->query("SELECT * FROM contacto WHERE lugar = $idLugar");
if($db->rows($obtenerContactos) > 0) {
	while($resContact = $db->recorrer($obtenerContactos)) {
		$contactsLugar[] = array(
			'id' => $resContact["id_contacto"],
			'tipo' => $resContact["tipo"],
			'numero' => $resContact["numero"],
		);
	}
}
$db->liberar($obtenerContactos);

$idResto = $resResto["id_restaurante"];

//Obtener Horarios de Atencion
$obtenerHorario = $db->query("SELECT * FROM horario WHERE restaurante = $idResto LIMIT 1");
$resHorario = $db->recorrer($obtenerHorario);

//Procesar Horario de Atencion
setlocale(LC_ALL,"es_ES");
$dia_semana = strftime("%A");
$hora_actual = date('H:i');
$hora_actual = explode(":", $hora_actual);

$abierto = false;

//Verificar si en el dia correspondiente esta abierto
if($resHorario["semanal"]) {
	
	if($dia_semana == 'Sábado') {
		if($resHorario["sabado"] != NULL and $resHorario["sabado"] != 'Cerrado') {
			$horario_dia =  $resHorario["sabado"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana == 'Domingo') {
		if($resHorario["domingo"] != NULL and $resHorario["domingo"] != 'Cerrado') {
			$horario_dia =  $resHorario["domingo"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else {
		if($resHorario["lun_vier"] != NULL and $resHorario["lun_vier"] != 'Cerrado') {
			$horario_dia =  $resHorario["lun_vier"];
			$horario_dia = explode("-",$horario_dia);
		}
	}
} else {
	if($dia_semana == 'Sábado') {
		if($resHorario["sabado"] != NULL and $resHorario["sabado"] != 'Cerrado') {
			$horario_dia =  $resHorario["sabado"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana == 'Domingo') {
		if($resHorario["domingo"] != NULL and $resHorario["domingo"] != 'Cerrado') {
			$horario_dia =  $resHorario["domingo"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana = 'Lunes'){
		if($resHorario["lunes"] != NULL and $resHorario["lunes"] != 'Cerrado') {
			$horario_dia =  $resHorario["lunes"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana = 'Martes'){
		if($resHorario["martes"] != NULL and $resHorario["martes"] != 'Cerrado') {
			$horario_dia =  $resHorario["martes"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana = 'Miercoles'){
		if($resHorario["miercoles"] != NULL and $resHorario["miercoles"] != 'Cerrado') {
			$horario_dia =  $resHorario["miercoles"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana = 'Jueves'){
		if($resHorario["jueves"] != NULL and $resHorario["jueves"] != 'Cerrado') {
			$horario_dia =  $resHorario["jueves"];
			$horario_dia = explode("-",$horario_dia);
		}
	} else if($dia_semana = 'Viernes'){
		if($resHorario["viernes"] != NULL and $resHorario["viernes"] != 'Cerrado') {
			$horario_dia =  $resHorario["viernes"];
			$horario_dia = explode("-",$horario_dia);
		}
	}
}

if(isset($horario_dia)) {
	$horarioDiaInicio = explode(":",$horario_dia[0]);
	$horarioDiaFinal = explode(":",$horario_dia[1]);

	if($hora_actual[0] >= $horarioDiaInicio[0] and $hora_actual[0] <= $horarioDiaFinal[0]) {
		$abierto = true;
	}
}

//Obetener Menu del dia
$obtenerMenu = $db->query("SELECT * FROM menu WHERE restaurante = $idResto AND dia_semana = '$dia_semana' LIMIT 1");
if($db->rows($obtenerMenu) > 0) {
	$resMenu = $db->recorrer($obtenerMenu);
	$idMenu = $resMenu["id_menu"];
	$obtenerPlatos = $db->query("SELECT * FROM menu_plato WHERE menu = $idMenu");
	$cantPlatos = $db->rows($obtenerPlatos);
	if($cantPlatos > 0) {
		while($resPlato = $db->recorrer($obtenerPlatos)) {
			$platos[] = array(
				'id' => $resPlato["id_menuplato"],
				'nombre' => $resPlato["nombre_plato"],
				'precio' => $resPlato["precio_plato"],
				'desc' => $resPlato["descripcion_plato"],
				'img' => $resPlato["imagen_menuplato"],
			);	
		}

		$mitad = $cantPlatos / 2;
		$mitad = ceil($mitad);

		if($mitad == $cantPlatos) {
			$lista_platos1 = $platos;
		} else {
			for ($i=0; $i < $mitad; $i++) { 
				$lista_platos1[] = $platos[$i];
			}
			for ($j=$mitad; $j < count($platos); $j++) { 
				$lista_platos2[] = $platos[$j];
			}
		}

	}
	$db->liberar($obtenerMenu);
}

//Obtener Calificaciones de Lugar

$obtenerCalificaciones = $db->query("SELECT * FROM calificacion WHERE lugar = $idLugar");
$cantCalificaciones = $db->rows($obtenerCalificaciones);
if($cantCalificaciones > 0) {
	$total_calif = 0;
	while($califRes = $db->recorrer($obtenerCalificaciones)) {
		
		$total_calif += $califRes["calificacion"];

		$idUsuario = $califRes["usuario"];
		$obtenerUsuario = $db->query("SELECT usuario, nombre, apellidos FROM usuarioregistrado WHERE id_usuarioregistrado = $idUsuario");
		$resUsuario = $db->recorrer($obtenerUsuario);

		$calificaciones[] = array(
			'id' => $califRes["id_calificacion"],
			'usuario' => $resUsuario["usuario"],
			'nombre_usuario' => $resUsuario["nombre"] . " " . $resUsuario["apellidos"],
			'calificacion' => $califRes["calificacion"],
			'comentario' => $califRes["comentario"],
			'fecha' => $califRes["fecha"],
			'respuesta' => $califRes["respuesta"],
		);

		$db->liberar($obtenerUsuario);
	}

	$promedio_calif = $total_calif / $cantCalificaciones;

	//Obtener Categorita dependiendo del promedio del lugar
	if($promedio_calif > 0 and $promedio_calif <= 1.8) {
		$cate_calif = "Malo";
	} else if($promedio_calif > 1.8 and $promedio_calif <= 3.6) {
		$cate_calif = "Regular";
	} else if($promedio_calif > 3.6 and $promedio_calif <= 4.5) {
		$cate_calif = "Bueno";
	} else {
		$cate_calif = "Excelente";
	}

	$calificacionesCat = array(
		array('calificacion' => 1, 'cant' => 0, 'porcentaje' => 0),
		array('calificacion' => 2, 'cant' => 0, 'porcentaje' => 0),
		array('calificacion' => 3, 'cant' => 0, 'porcentaje' => 0),
		array('calificacion' => 4, 'cant' => 0, 'porcentaje' => 0),
		array('calificacion' => 5, 'cant' => 0, 'porcentaje' => 0));

	//Obtener las calificaciones del lugar
	$obtenerCatCalif = $db->query("SELECT COUNT(*) AS 'cantidad' , calificacion FROM calificacion WHERE lugar = 1 GROUP BY calificacion ORDER BY calificacion");
	while ($resCatCalif = $db->recorrer($obtenerCatCalif)) {
		$porcentaje = (100 / $cantCalificaciones) * $resCatCalif["cantidad"];
		foreach ($calificacionesCat as $key => $calificacion) {
			if($calificacion["calificacion"] == $resCatCalif["calificacion"]) {
				$calificacionesCat[$key]["cant"] = $resCatCalif["cantidad"];
				$calificacionesCat[$key]["porcentaje"] = $porcentaje;
			}
		}
	}
	
	$db->liberar($obtenerCalificaciones, $obtenerCatCalif);
}

//Obtener Caificacion Usuario al lugar
$lugarCalificado = false;
$obtenerCalfUsuario = $db->query("SELECT * FROM calificacion WHERE lugar = $idLugar AND usuario = $usuarioID");
$cantCalifUsuario = $db->rows($obtenerCalfUsuario);
if($cantCalifUsuario > 0) {
	$lugarCalificado = true;
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MaskhayPlace - Detalle de Lugar">
    <meta name="author" content="UPDS">
    <title>MaskhayPlace | Detalle de Restaurante</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="assets/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/public/css/style.css" rel="stylesheet">
	<link href="assets/public/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="assets/public/css/custom.css" rel="stylesheet">
	<style>
	.hero_in.restaurant_detail:before {
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.hero_in.restaurant_detail .wrapper {
		background-color: black;
		background-color: rgba(0, 0, 0, 0.2);
	}
	.hero_in:before {
		animation: pop-in 5s 0.1s cubic-bezier(0, 0.5, 0, 1) forwards;
		content: "";
		opacity: 0;
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		z-index: -1;
	}
	.hero_in .wrapper {
		height: 100%;
	}
	
	</style>
</head>

<body>
	
	<div id="page" class="theia-exception">
		
	<header class="header_in">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div id="logo">
						<a href="index.html">
							<img src="assets/public/img/logo.png" width="165" height="35" class="logo_sticky">
						</a>
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<ul id="top_menu">
						<li><a href="account.html" class="btn_add">Publicar Lugar</a></li>
						<li><a href="#sign-in-dialog" id="sign-in" class="login" title="Iniciar Sesión">Iniciar Sesión</a></li>
						<!-- <li><a href="wishlist.html" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li> -->
					</ul>
					<!-- /top_menu -->
					<a href="#menu" class="btn_mobile">
						<div class="hamburger hamburger--spin" id="hamburger">
							<div class="hamburger-box">
								<div class="hamburger-inner"></div>
							</div>
						</div>
					</a>
					<nav id="menu" class="main-menu">
                        <ul>
                            <li><span><a href="index.php">Inicio</a></span></li>
                            <li><span><a href="#">Categorias</a></span>
                                <ul>
                                    <li><a href="#">Hoteles</a></li>
                                    <li><a href="#">Restaurantes</a></li>
                                    <li><a href="#">Farmacias</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->		
	</header>
	<!-- /header -->
	
	<main>		
		<div class="hero_in restaurant_detail" style="background: url('<?=$imgsResto[0]["url"]?>') center center no-repeat; background-size: cover;">
			<div class="wrapper">
				<span class="magnific-gallery">
				<?php
				if(isset($imgsResto)) {
				$cantimg = count($imgsResto);
				$i = 0;
					foreach($imgsResto as $img) {
						if($i == 0) {
					?>
						<a href="<?=$img['url']?>" class="btn_photos" title="<?=$img['desc']?>" data-effect="mfp-zoom-in">Ver Fotos</a>
					<?php		
						} else {
					?>
						<a href="<?=$img['url']?>" title="<?=$img['desc']?>" data-effect="mfp-zoom-in"></a>
					<?php
						}
					}
				}
				?>
				</span>
			</div>
		</div>
		<!--/hero_in-->
		
		<nav class="secondary_nav sticky_horizontal_2">
			<div class="container">
				<ul class="clearfix">
					<li><a href="#description" class="active">Descripción</a></li>
					<li><a href="#reviews">Calificaciones</a></li>
					<li><a href="#sidebar">Reservas</a></li>
				</ul>
			</div>
		</nav>

		<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-8">
						<section id="description">
							<div class="detail_title_1">
								<h1><?=$resLugar["nombre_lugar"]?></h1>
								<h5><?=$resResto["categoria"]?></h5>
								<a class="address" href="https://www.google.com/maps/dir//Assistance+%E2%80%93+H%C3%B4pitaux+De+Paris,+3+Avenue+Victoria,+75004+Paris,+Francia/@48.8606548,2.3348734,14z/data=!4m15!1m6!3m5!1s0x47e66e1de36f4147:0xb6615b4092e0351f!2sAssistance+Publique+-+H%C3%B4pitaux+de+Paris+(AP-HP)+-+Si%C3%A8ge!8m2!3d48.8568376!4d2.3504305!4m7!1m0!1m5!1m1!1s0x47e67031f8c20147:0xa6a9af76b1e2d899!2m2!1d2.3504327!2d48.8568361"><?=$resLugar["direccion"]?></a>
							</div>
							<p><?=$resLugar["descripcion"]?></p>

							<?php
							if(isset($contactsLugar)) {
							?>
							<h5 class="add_bottom_15">Contacto</h5>
							<div class="row add_bottom_30">
								<ul class="hotel_facilities" style="margin-left: 20px;">
								<?php 
								foreach ($contactsLugar as $key => $contacto) {
									if($contacto["tipo"] == 'Celular') {
										echo '<li><img src="assets/public/img/iconos/smartphone.svg" width="25">'.$contacto["numero"].'</li>';
									} else if($contacto["tipo"] == 'Telefono') {
										echo '<li><img src="assets/public/img/iconos/phone.svg" width="25">'.$contacto["numero"].'</li>';
									} else if($contacto["tipo"] == 'Whatsapp') {
										echo '<li><img src="assets/public/img/iconos/whatsapp.svg" width="25">'.$contacto["numero"].'</li>';
									}
								}
								?>	
								</ul>
							</div>
							<!-- /row -->
							<?php
							}
							?>
							<h5 class="add_bottom_15">Caracteristicas</h5>
							<div class="row add_bottom_30">
								<ul class="hotel_facilities" style="margin-left: 20px;">
								<?php 
								if($resResto["parqueo"] == 1) {
									echo '<li><img src="assets/public/img/iconos/parqueo.svg" width="45">Parqueo</li>';
								}
								if($resResto["recreativo"] == 1) {
									echo '<li><img src="assets/public/img/iconos/recreativo.svg" width="45">Area Recreativa</li>';								
								}
								if($resResto["internet"] == 1) {
									echo '<li><img src="assets/public/img/iconos/wifi.svg" width="45">Wifi</li>';								
								}
								if($resResto["area_fumadores"] == 1) {
									echo '<li><img src="assets/public/img/iconos/fumadores.svg" width="45">Area Fumadores</li>';
								}
								if($resResto["auto_servicio"] == 1) {
									echo '<li><img src="assets/public/img/iconos/autoservicio.svg" width="45">Auto Servicio</li>';								
								}
								if($resResto["reserva_mesa"] == 1) {
									echo '<li><img src="assets/public/img/iconos/reserva.svg" width="45">Reserva Mesa</li>';								
								}
								?>	
								</ul>
							</div>
							<!-- /row -->
							<?php 
							if($resHorario != null) {
							?>
							<div class="opening">
                                <div class="ribbon">
								<?php 
								if($abierto) {
									echo '<span class="open">Ahora Abierto</span>';
								} else {
									echo '<span class="closed">Ahora Cerrado</span>';
								}
								?>
                                </div>
                                <i class="icon_clock_alt"></i>
                                <h4>Horario de Atencion</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul>
									<?php
										if($resHorario["semanal"] == 1) {
									?>
											<li>Lunes a Viernes <span><?=$resHorario["lun_vier"]?></span></li>
									<?php
										} else {
									?>
											<li>Lunes <span><?=$resHorario["lunes"]?></span></li>
                                            <li>Martes <span><?=$resHorario["martes"]?></span></li>
                                            <li>Miercoles <span><?=$resHorario["miercoles"]?></span></li>
                                            <li>Jueves <span><?=$resHorario["jueves"]?></span></li>
                                            <li>Viernes <span><?=$resHorario["viernes"]?></span></li>
									<?php
										}
									?>         
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li>Sábado <span><?=$resHorario["sabado"]?></span></li>
                                            <li>Domingo <span><?=$resHorario["domingo"]?></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
							<?php
							}
							?>						
                            <!-- /opening -->
							<hr>
							<?php
							if(isset($resMenu)) {
							?>
							<h5>Menu del día - <?=$resMenu["dia_semana"]?></h5>
							<h4><?=$resMenu["nombre_menu"]?></h4>
							<p><?=$resMenu["decripcion_menu"]?></p>
							<div class="row add_bottom_15">
                                <div class="col-lg-6 col-md-12">
                                    <ul class="menu_list">
                                    <?php
									foreach ($lista_platos1 as $key => $plato) {
									?>
										<li>
                                            <div class="thumb">
                                                <img src="<?= $plato["img"] != null || $plato["img"] != '' ? $plato["img"] : "assets/public/img/menu_list_1.jpg"?>" alt="<?=$plato["desc"]?>">
                                            </div>
                                            <h6><?=$plato["nombre"]?> <span><?=$plato["precio"]?>.Bs</span></h6>
                                            <p>
												<?=$plato["desc"]?>
                                            </p>
                                        </li>
									<?php
									}
									?>
                                    </ul>
                                </div>
								<?php
								if(isset($lista_platos2)) {
								?>
                                <div class="col-lg-6 col-md-12">
                                    <ul class="menu_list">
                                    <?php
									foreach ($lista_platos2 as $key => $plato) {
									?>
										<li>
                                            <div class="thumb">
                                                <img src="<?= $plato["img"] != null || $plato["img"] != '' ? $plato["img"] : "assets/public/img/menu_list_3.jpg"?>" alt="<?=$plato["desc"]?>">
                                            </div>
                                            <h6><?=$plato["nombre"]?> <span><?=$plato["precio"]?>.Bs</span></h6>
                                            <p>
												<?=$plato["desc"]?>
                                            </p>
                                        </li>
									<?php
									}
									?>
                                    </ul>
                                </div>
								<?php
								}
								?>
                            </div>
							<hr>
							<?php
							}
							?>
							<h3>Ubicación</h3>
							<div id="map" class="map map_single add_bottom_45"></div>
							<!-- End Map -->
						</section>
						
						<!-- /section -->
						<section id="reviews">
							<h2>Calificaciones</h2>
							<div class="reviews-container add_bottom_30">
								<div class="row">
									<div class="col-lg-3">
										<div id="review_summary">
											<strong><?=isset($promedio_calif) ? $promedio_calif : 0?></strong>
											<em><?=isset($cate_calif) ? $cate_calif : "Sin Calificacion"?></em>
											<small>Basado en <?=$cantCalificaciones?> calificaciones</small>
										</div>
									</div>
									<div class="col-lg-9">
									<?php
									foreach ($calificacionesCat as $key => $calificacionCat) {
									?>
										<div class="row">
											<div class="col-lg-10 col-9">
												<div class="progress">
													<div class="progress-bar" role="progressbar" style="width: <?=$calificacionCat["porcentaje"]?>%" aria-valuenow="<?=$calificacionCat["porcentaje"]?>" aria-valuemin="0" aria-valuemax="100"></div>
												</div>
											</div>
											<div class="col-lg-2 col-3"><small><strong><?=$calificacionCat["calificacion"]?> estrellas</strong></small></div>
										</div>
									<?php
									}
									?>
									</div>
								</div>
								<!-- /row -->
							</div>

							<div id="comentarios" class="reviews-container">
								
							<?php
							foreach ($calificaciones as $key => $calificacion) {
							?>
								<div class="review-box clearfix">
									<figure class="rev-thumb"><img src="assets/public/img/avatar1.jpg" alt="">
									</figure>
									<div class="rev-content">
										<div class="rev-title">
											<b><?=$calificacion["nombre_usuario"]?></b>
										</div>
										<div class="rating">
										<?php
										$votacion = $calificacion["calificacion"];
										for ($i=0; $i < 5; $i++) {
										?>
											<i class="icon_star <?=$votacion <= $i ? "" : "voted"?>"></i>
										<?php
										}
										?>
										</div>
										<div class="rev-info">
											<?=$calificacion["usuario"]?> – <?=$calificacion["fecha"]?>:
										</div>
										<div class="rev-text">
											<p>
												<?=$calificacion["comentario"]?>
											</p>
										</div>
									</div>
								</div>
							<?php
							}
							?>
							</div>
							<!-- /review-container -->
						</section>
						<!-- /section -->

						<?php
						if(!$lugarCalificado) {
							?>
						<hr>
							<div id="realizarComentario" class="add-review">
								<h5>Deja tu Calificacion</h5>
								<div class="row">
									<div id="AJAXresponse"></div>
									<div class="form-group col-md-6">
										<label>Puntaje </label>
										<div class="custom-select-form">
										<select id="calificacion_puntaje" class="wide">
											<option value="1">1 (Muy Mala)</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5" selected>5 (Excelente)</option>
										</select>
										</div>
									</div>
									<div class="form-group col-md-12">
										<label>Tu comentario</label>
										<textarea id="comentario" class="form-control" style="height:130px;"></textarea>
									</div>
									<div class="form-group col-md-12 add_top_20 add_bottom_30">
										<input type="hidden" value="<?=$idLugar?>" id="idLugar">	
										<button class="btn_1" id="btnEnviar">Enviar</button>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
					<!-- /col -->
					

					<aside class="col-lg-4" id="sidebar">
						<div id="AJAXreserva"></div>
						
					<?php
					if($resResto["reserva_mesa"] == 1) {
					?>
						<div class="box_detail booking">

							<div class="price">
								<h5 class="d-inline">Reservar</h5>
								<div class="score"><span><?=$cate_calif?><em><?=$cantCalificaciones?> Calificaciones</em></span><strong><?=$promedio_calif?></strong></div>
							</div>

							<div class="form-group">
								<input class="form-control" type="text" id="nombre_reserva" placeholder="Para quien..">
							</div>

							<div class="form-group" id="input-dates">
								<input class="form-control" type="text" id="fecha_reserva" placeholder="Cuando..">
								<i class="icon_calendar"></i>
							</div>

							<div class="panel-dropdown">
								<a href="#">Cantidad <span class="qtyTotal">1</span></a>
								<div class="panel-dropdown-content right">
									<div class="qtyButtons">
										<label>Personas</label>
										<input type="text" name="qtyInput" id="cant_reserva" value="1">
									</div>
								</div>
							</div>

							<div class="form-group clearfix">
								<div class="custom-select-form">
									<select class="wide" id="hora_reserva">
										<option value="8:00">8:00</option>	
										<option value="9:00">9:00</option>	
										<option value="10:00">10:00</option>
										<option value="11:00">11:00</option>
										<option value="12:00">12:00</option>
										<option value="13:00">13:00</option>
										<option value="14:00">14:00</option>
										<option value="15:00">15:00</option>
										<option value="16:00">16:00</option>
										<option value="17:00">17:00</option>
										<option value="18:00">18:00</option>
										<option value="19:00">19:00</option>
										<option value="20:00">20:00</option>
										<option value="21:00">21:00</option>
										<option value="22:00">22:00</option>
										<option value="23:00">23:00</option>
									</select>
								</div>
							</div>
							<input type="hidden" id="idResto" value="<?=$resResto["id_restaurante"]?>">
							<button id="EnviarReserva" class=" add_top_30 btn_1 full-width purchase">Reservar</button>
							<div class="text-center"><small>No es necesario ningun pago extra</small></div>
						</div>
					<?php
					}
					?>
						<!-- <ul class="share-buttons">
							<li><a class="fb-share" href="#0"><i class="social_facebook"></i> Share</a></li>
							<li><a class="twitter-share" href="#0"><i class="social_twitter"></i> Tweet</a></li>
							<li><a class="gplus-share" href="#0"><i class="social_googleplus"></i> Share</a></li>
						</ul> -->
					</aside>
				</div>
				<!-- /row -->
		</div>
		<!-- /container -->
		
	</main>
	<!--/main-->
	
	<footer>
		<div class="container margin_60_35">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-sm-6">
					<a data-toggle="collapse" data-target="#collapse_ft_1" aria-expanded="false" aria-controls="collapse_ft_1" class="collapse_bt_mobile">
						<h3>Quick Links</h3>
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
					</a>
					<div class="collapse show" id="collapse_ft_1">
						<ul class="links">
							<li><a href="#0">About us</a></li>
							<li><a href="#0">Faq</a></li>
							<li><a href="#0">Help</a></li>
							<li><a href="#0">My account</a></li>
							<li><a href="#0">Create account</a></li>
							<li><a href="#0">Contacts</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<a data-toggle="collapse" data-target="#collapse_ft_2" aria-expanded="false" aria-controls="collapse_ft_2" class="collapse_bt_mobile">
						<h3>Categories</h3>
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
					</a>
					<div class="collapse show" id="collapse_ft_2">
						<ul class="links">
							<li><a href="#0">Shops</a></li>
							<li><a href="#0">Hotels</a></li>
							<li><a href="#0">Restaurants</a></li>
							<li><a href="#0">Bars</a></li>
							<li><a href="#0">Events</a></li>
							<li><a href="#0">Fitness</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<a data-toggle="collapse" data-target="#collapse_ft_3" aria-expanded="false" aria-controls="collapse_ft_3" class="collapse_bt_mobile">
						<h3>Contacts</h3>
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
					</a>
					<div class="collapse show" id="collapse_ft_3">
						<ul class="contacts">
							<li><i class="ti-home"></i>97845 Baker st. 567<br>Los Angeles - US</li>
							<li><i class="ti-headphone-alt"></i>+39 06 97240120</li>
							<li><i class="ti-email"></i><a href="#0">info@sparker.com</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<!-- Sign In Popup -->
	<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="small-dialog-header">
			<h3>Sign In</h3>
		</div>
		<form>
			<div class="sign-in-wrapper">
				<a href="#0" class="social_bt facebook">Login with Facebook</a>
				<a href="#0" class="social_bt google">Login with Google</a>
				<div class="divider"><span>Or</span></div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" id="email">
					<i class="icon_mail_alt"></i>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="password" id="password" value="">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="clearfix add_bottom_15">
					<div class="checkboxes float-left">
						<label class="container_check">Remember me
						  <input type="checkbox">
						  <span class="checkmark"></span>
						</label>
					</div>
					<div class="float-right mt-1"><a id="forgot" href="javascript:void(0);">Forgot Password?</a></div>
				</div>
				<div class="text-center"><input type="submit" value="Log In" class="btn_1 full-width"></div>
				<div class="text-center">
					Don’t have an account? <a href="register.html">Sign up</a>
				</div>
				<div id="forgot_pw">
					<div class="form-group">
						<label>Please confirm login email below</label>
						<input type="email" class="form-control" name="email_forgot" id="email_forgot">
						<i class="icon_mail_alt"></i>
					</div>
					<p>You will receive an email containing a link allowing you to reset your password to a new preferred one.</p>
					<div class="text-center"><input type="submit" value="Reset Password" class="btn_1"></div>
				</div>
			</div>
		</form>
		<!--form -->
	</div>
	<!-- /Sign In Popup -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="assets/public/js/common_scripts.js"></script>
	<script src="assets/public/js/functions.js"></script>
	<script src="assets/public/extras/validate.js"></script>
	
	<!-- Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE"></script>
	<!-- <script src="assets/public/js/map_single_restaurant.js"></script> -->
	
	<!-- INPUT QUANTITY  -->
	<script src="assets/public/js/input_qty.js"></script>
	
	<!-- DATEPICKER  -->
	<script>

	//DatePicker
    $('#fecha_reserva').daterangepicker({
        "singleDatePicker": true,
        "parentEl": '#input-dates',
		"opens": "left",
		"locale": {
			"format": "YYYY/MM/DD",
			"separator": " - ",
			"daysOfWeek": [
				"Do",
				"Lu",
				"Ma",
				"Mi",
				"Ju",
				"Vi",
				"Sa"
			],
			"monthNames": [
				"Enero",
				"Febrero",
				"Marzo",
				"Abril",
				"Mayo",
				"Junio",
				"Julio",
				"Augosto",
				"Septiembre",
				"Octubre",
				"Noviembre",
				"Deciembre"
			]
    	}
    });

	//Datos del Retaurante para marcadores

	var 
	mapObject,
	markers = [],
	markersData = {
		'Marker': [
		{
			type_point: '<?=$resResto["categoria"]?>',
			name: '<?=$resLugar["nombre_lugar"]?>',
			location_latitude: <?=$resLugar["latitud_gps"]?>, 
			location_longitude: <?=$resLugar["longitud_gps"]?>,
			map_image_url: '<?= $resLugar["logo"] != null && $resLugar["logo"] != '' ? $resLugar["logo"] : "assets/public/img/thumb_map_single_restaurant.jpg"?>',
			rate: '<?=$cate_calif?> | <?=$promedio_calif?>',
			name_point: '<?=$resLugar["nombre_lugar"]?>',
			description_point: '<?=$resLugar["descripcion"]?>'
		}
		]
	};

	
	//Opciones de Mapa
	var mapOptions = {
		zoom: 15,
		center: new google.maps.LatLng(<?=$resLugar["latitud_gps"]?>, <?=$resLugar["longitud_gps"]?>),
		mapTypeId: google.maps.MapTypeId.ROADMAP,

		mapTypeControl: false,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
			position: google.maps.ControlPosition.LEFT_CENTER
		},
		panControl: false,
		panControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.TOP_LEFT
		},
		scrollwheel: false,
		scaleControl: false,
		scaleControlOptions: {
			position: google.maps.ControlPosition.TOP_LEFT
		},
		streetViewControl: true,
		streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_TOP
		},
		styles: [
			{
				"featureType": "administrative.country",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative.province",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative.locality",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative.neighborhood",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "administrative.land_parcel",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "landscape.man_made",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "landscape.natural.landcover",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "landscape.natural.terrain",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.business",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.government",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.medical",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.park",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.park",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.place_of_worship",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.school",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "poi.sports_complex",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.highway",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.highway.controlled_access",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "road.arterial",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "road.local",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "simplified"
					}
				]
			},
			{
				"featureType": "transit.line",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit.station.airport",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit.station.bus",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "transit.station.rail",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "all",
				"stylers": [
					{
						"visibility": "on"
					}
				]
			},
			{
				"featureType": "water",
				"elementType": "labels",
				"stylers": [
					{
						"visibility": "off"
					}
				]
			}
		]
	};

	//Instanciacion de Mapa
	var
	marker;
	mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
	for (var key in markersData)
		markersData[key].forEach(function (item) {
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
				map: mapObject,
				icon: 'assets/public/img/pins/' + key + '.png',
			});

			if ('undefined' === typeof markers[key])
				markers[key] = [];
			markers[key].push(marker);
			google.maps.event.addListener(marker, 'click', (function () {
			closeInfoBox();
			getInfoBox(item).open(mapObject, this);
			mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
			}));
	});

	function hideAllMarkers () {
		for (var key in markers)
			markers[key].forEach(function (marker) {
				marker.setMap(null);
			});
	};

	function closeInfoBox() {
		$('div.infoBox').remove();
	};

	function getInfoBox(item) {
		return new InfoBox({
			content:
			'<div class="marker_info" id="marker_info">' +
			'<img src="' + item.map_image_url + '" width="240" alt=""/>' +
			'<span>'+ 
				'<span class="infobox_rate">'+ item.rate +'</span>' +
				'<em>'+ item.type_point +'</em>' +
				'<h3>'+ item.name_point +'</h3>' +
				'<em style="font-size:9px; text-align:justify">'+ item.description_point +'</em>',
			disableAutoPan: false,
			maxWidth: 0,
			pixelOffset: new google.maps.Size(10, 92),
			closeBoxMargin: '',
			closeBoxURL: "assets/public/img/close_infobox.png",
			isHidden: false,
			alignBottom: true,
			pane: 'floatPane',
			enableEventPropagation: true
		});
	};

	$(document).on('click', '#btnEnviar', function() {
		var puntaje = $('#calificacion_puntaje').val();
		var comentario = $('#comentario').val();
		var idLugar = $('#idLugar').val();

		$.ajax({
			type: "POST",
			url: "app/requestAJAX/realizarComentario.request.php",
			data: {
				puntaje: puntaje,
				comentario: comentario,
				lugar: idLugar
			},
			cache: false,
			success: function (response) {
				if(response == 1) {
					$("#comentarios").load(location.href + " #comentarios");
					$('#AJAXresponse').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Correcto!</strong> Calificacion realizado con exito.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					setTimeout(() => {
						$("#realizarComentario").load(location.href + " #realizarComentario");
					}, 3000);
				} else {
					$('#AJAXresponse').html('<div class="alert alert-info alert-dismissible fade show" role="alert"><strong>ERROR!</strong> '+response+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		});

	});

	$(document).on('click', '#EnviarReserva', function() {
		var nombre = $('#nombre_reserva').val();
		var fecha = $('#fecha_reserva').val();
		var cant = $('#cant_reserva').val();
		var hora = $('#hora_reserva').val();
		var id_resto = $('#idResto').val();
		// alert('Reserva realizada con exito \n' + nombre + '\n' + fecha + '\n' + cant + '\n' + hora);
		$.ajax({
			type: "POST",
			url: "app/requestAJAX/realizarReserva.request.php",
			data: {
				nombre: nombre,
				fecha: fecha,
				cant: cant,
				hora: hora,
				id_resto: id_resto
			},
			cache: false,
			success: function (response) {
				if(response == 1) {
					$('#AJAXreserva').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Finalizado!</strong> Su reserva a sido enviada para su verificacion.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					$('#nombre_reserva').val('');
					$('#fecha_reserva').val('');
					$('#cant_reserva').val('0');
					$('.qtyTotal').html('0');
				} else {
					$('#AJAXreserva').html('<div class="alert alert-info alert-dismissible fade show" role="alert"><strong>ERROR!</strong> '+response+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		});
	});

    </script>
	<script src="assets/public/js/infobox.js"></script>

</body>
</html>