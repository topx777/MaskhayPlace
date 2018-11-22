<?php
session_start();

$idLugar = $_GET['id'];

if(isset($_SESSION["usuario"]))
	$usuarioID = $_SESSION["usuario"]["id"];

include('helpers/class.Conexion.php');

$db = new Conexion();
$db->charset();

//Obtener Datos Lugar
$obtenerLugarQ = $db->query("SELECT * FROM lugar WHERE id_lugar = $idLugar LIMIT 1");
$resLugar = $db->recorrer($obtenerLugarQ);

//Obtener Datos Hotel realionado lugar
$obtenerHotelQ = $db->query("SELECT * FROM hotel WHERE lugar = $idLugar LIMIT 1");
$resHotel = $db->recorrer($obtenerHotelQ);

//Obtener Imagenes
$obtenerImgs = $db->query("SELECT * FROM imagen WHERE lugar = $idLugar");
if($db->rows($obtenerImgs) > 0) {
	while($resImg = $db->recorrer($obtenerImgs)) {
		$imgsHotel[] = array(
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

$idHotel = $resHotel["id_hotel"];

//Obtener Piezas ofrecidas en el hotel
$obtenerPiezas = $db->query("SELECT * FROM pieza WHERE hotel = $idHotel");
if($db->rows($obtenerPiezas) > 0) {

	while($resPieza = $db->recorrer($obtenerPiezas)) {
		$piezas[] = array(
			'id' => $resPieza["id_pieza"],
			'nombre' => $resPieza["nombre_pieza"],
			'descripcion' => $resPieza["descripcion_pieza"],
			'precio' => $resPieza["precio_noche"],
			'sanitario' => $resPieza["sanitario_privado"],
			'frigobar' => $resPieza["frigobar"],
			'hotel' => $resPieza["hotel"],
			'imagen' => $resPieza["imagen_pieza"],
		);
	}

	$db->liberar($obtenerPiezas);
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
	if($promedio_calif >= 0 and $promedio_calif <= 1.8) {
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
	$obtenerCatCalif = $db->query("SELECT COUNT(*) AS 'cantidad' , calificacion FROM calificacion WHERE lugar = $idLugar GROUP BY calificacion ORDER BY calificacion");
	while ($resCatCalif = $db->recorrer($obtenerCatCalif)) {
		$porcentaje = floor((100 / $cantCalificaciones) * $resCatCalif["cantidad"]);
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
if(isset($_SESSION["usuario"])) {
	$obtenerCalfUsuario = $db->query("SELECT * FROM calificacion WHERE lugar = $idLugar AND usuario = $usuarioID");
	$cantCalifUsuario = $db->rows($obtenerCalfUsuario);
	if($cantCalifUsuario > 0) {
		$lugarCalificado = true;
	}
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
    <title>MaskhayPlace | Detalle de Hotel</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="assets/public/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assets/public/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/public/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/public/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/public/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="assets/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/public/css/style.css" rel="stylesheet">
	<link href="assets/public/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="assets/public/css/custom.css" rel="stylesheet">
	<style>
	.hero_in.hotels_detail:before {
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
	}
	.hero_in.hotels_detail .wrapper {
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
							<img src="assets/public/img/logo.png" width="165" height="35" alt="" class="logo_sticky">
						</a>
					</div>
				</div>
				<div class="col-lg-9 col-12">
					<ul id="top_menu">
					<?php
						if(isset($_SESSION["usuario"])) {
							if($_SESSION["usuario"]["negocio"] == 0) {
								echo '<li><a href="agregar_lugar.php" class="btn_add">Publicar Lugar</a></li>';;
							}
						} else {
							echo '<li><a href="#sign-in-dialog" class="btn_add logearsePOP">Publicar Lugar</a></li>';
						}
					?>
						
					<?php
					if(!isset($_SESSION["usuario"])) {
						echo '<li><a href="#sign-in-dialog" class="login logearsePOP" title="Iniciar Sesión">Iniciar Sesión</a></li>';
					}
					?>
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
                            <li><span><a href="index-2.php">Inicio</a></span></li>
						<?php
						if(isset($_SESSION["usuario"])){
						?>
							<li><span><a href="#"><span class="ti-angle-down"> </span><?=$_SESSION["usuario"]["nombre"]?></a></span>
								<ul>
						<?php 	if($_SESSION["usuario"]["negocio"] == 1): ?>
									<li><a href="administrar_lugar.php">
										<span class="ti-dashboard"> </span>
										Administrar mi Negocio</a>
									</li>
						<?php 		endif; ?>
									<li><a href="reservas_usuario.php">
										<span class="ti-agenda"> </span>
										Mis Reservas</a>
									</li>
									<li><a href="app/requestAJAX/cerrarSesion.request.php">
										<span class="ti-shift-left"> </span>
										Cerrar Sesion</a>
									</li>
								</ul>
							</li>
						<?php
						}
						?>
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
		<div class="hero_in hotels_detail" <?php if(isset($imgsHotel)) { ?>style="background: url('<?=$imgsHotel[0]["url"]?>') center center no-repeat; background-size: cover;"<?php } ?>>
			<div class="wrapper">
				<span class="magnific-gallery">
				<?php
				if(isset($imgsHotel)) {
				$cantimg = count($imgsHotel);
				$i = 0;
					foreach($imgsHotel as $img) {
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
					<li><a href="#description" class="active">Descripcion</a></li>
					<li><a href="#reviews">Calificaciones</a></li>
					<li><a href="#sidebar"></a></li>
				</ul>
			</div>
		</nav>

		<div class="container margin_60_35">
				<div class="row">
					<div class="col-lg-12">
						<section id="description">
							<div class="detail_title_1">
								<div class="cat_star">
								<?php
								$nivelHotel = $resHotel["nivel"];
								for ($i=0; $i < $nivelHotel; $i++) { 
									echo '<i class="icon_star"></i>';
								}
								?>
								</div>
								<h1><?=$resLugar["nombre_lugar"]?></h1>
								<h5><?=$resHotel["categoria"]?></h5>
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

							<h5 class="add_bottom_15">Servicios</h5>
							<div class="row add_bottom_30">
								<ul class="hotel_facilities" style="margin-left: 20px;">
								<?php 
								if($resHotel["parqueo"] == 1) {
									echo '<li><img src="assets/public/img/iconos/parqueo.svg" width="45">Parqueo</li>';
								}
								if($resHotel["piscina"] == 1) {
									echo '<li><img src="assets/public/img/iconos/piscina.svg" width="45">Piscina</li>';
								}
								if($resHotel["area_recreativa"] == 1) {
									echo '<li><img src="assets/public/img/iconos/recreativo.svg" width="45">Area Recreativa</li>';								
								}
								if($resHotel["bar"] == 1) {
									echo '<li><img src="assets/public/img/iconos/bar.svg" width="45">Bar</li>';								
								}
								if($resHotel["internet"] == 1) {
									echo '<li><img src="assets/public/img/iconos/wifi.svg" width="45">Wifi</li>';								
								}
								if($resHotel["cable"] == 1) {
									echo '<li><img src="assets/public/img/iconos/cable.svg" width="45">Cable</li>';
								}
								if($resHotel["aire_acondicionado"] == 1) {
									echo '<li><img src="assets/public/img/iconos/aire_acondicionado.svg" width="45">Aire Acondicionado</li>';								
								}
								if($resHotel["desayuno"] == 1) {
									echo '<li><img src="assets/public/img/iconos/desayuno.svg" width="45">Desayuno</li>';								
								}
								if($resHotel["gimnasio"] == 1) {
									echo '<li><img src="assets/public/img/iconos/gimnasio.svg" width="45">Gimnasio</li>';								
								}
								if($resHotel["mascota"] == 1) {
									echo '<li><img src="assets/public/img/iconos/mascota.svg" width="45">Mascota</li>';								
								}
								if($resHotel["spa"] == 1) {
									echo '<li><img src="assets/public/img/iconos/spa.svg" width="45">Spa</li>';								
								}
								if($resHotel["comedor"] == 1) {
									echo '<li><img src="assets/public/img/iconos/comedor.svg" width="45">Comedor</li>';								
								}
								if($resHotel["servicio_habitacion"] == 1) {
									echo '<li><img src="assets/public/img/iconos/servicio_habitacion.svg" width="45">Servicio Habitacion</li>';								
								}
								?>	
								</ul>
							</div>
							<!-- /row -->					
							<hr>

							<?php 
							if(isset($piezas)) {
							foreach ($piezas as $key => $pieza) {
							?>
							<div class="room_type">
								<div class="row">
									<div class="col-md-4">
										<img src="<?=$pieza["imagen"] != null && $pieza["imagen"] != '' ? $pieza["imagen"] : "assets/public/img/gallery/hotel_list_1.jpg"?>" class="img-fluid" alt="">
									</div>
									<div class="col-md-8">
										<h4><?=$pieza["nombre"]?></h4>
										<p><?=$pieza["descripcion"]?>.</p>
										<ul class="hotel_facilities">
										<?php
										if($pieza["sanitario"] == 1)
											echo '<li><img src="assets/public/img/iconos/sanitario.svg" width="40" alt="">Sanitario Privado</li>';
										if($pieza["frigobar"] == 1)
											echo '<li><img src="assets/public/img/iconos/frigobar.svg" width="40" alt="">Frigobar</li>';
										?>
										</ul>
									</div>
								</div>
								<!-- /row -->
							</div>
							<?php 
							}
							?>
							<hr>
							<h3>Precios</h3>
							<table class="table table-striped add_bottom_45">
								<tbody>
								<?php
								foreach ($piezas as $key => $pieza) {
								?>
									<tr>
										<td><?=$pieza["nombre"]?> (Hasta las 12:00 AM del dia siguiente)</td>
										<td><?=$pieza["precio"]?>.Bs</td>
									</tr>
								<?php
								}
								?>
								</tbody>
							</table>
							<hr>
							<?php	
							}
							?>
							<h3>Ubicación</h3>
							<div id="map" class="map map_single add_bottom_45"></div>
							<!-- End Map -->
						</section>
						<!-- /section -->
					
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
								if(isset($calificacionesCat)) {
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
								} 
								?>	
									</div>
								</div>
								<!-- /row -->
							</div>

							<div id="comentarios" class="reviews-container">
								
							<?php
						if(isset($calificaciones)) {
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
								<div id="AJAXresponse"></div>
								<div class="row">
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
									<?php
									if(!isset($_SESSION["usuario"])) {
										echo '<a href="#sign-in-dialog" class="logearsePOP btn_1">Enviar</a>';
									} else {
										echo '<button class="btn_1" id="btnEnviar">Enviar</button>';
									}
									?>
										
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
					<!-- /col -->
					
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
						<h3>Enlaces rapidos</h3>
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
					</a>
					<div class="collapse show" id="collapse_ft_1">
						<ul class="links">
							<li><a href="#0">Acerca de nosotros</a></li>
							<li><a href="#0">Pregunas frecuentes</a></li>
							<li><a href="#0">Ayuda</a></li>
							<li><a href="#0">Mi cuenta</a></li>
							<li><a href="#0">Crear cuenta</a></li>
							<li><a href="#0">Contactos</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<a data-toggle="collapse" data-target="#collapse_ft_2" aria-expanded="false" aria-controls="collapse_ft_2" class="collapse_bt_mobile">
						<h3>Categorias</h3>
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
					</a>
					<div class="collapse show" id="collapse_ft_2">
						<ul class="links">
							<li><a href="#0">Hoteles</a></li>
							<li><a href="#0">Restaurantes</a></li>
							<li><a href="#0">Farmacias</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<a data-toggle="collapse" data-target="#collapse_ft_3" aria-expanded="false" aria-controls="collapse_ft_3" class="collapse_bt_mobile">
						<h3>Contactos</h3>
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
					</a>
					<div class="collapse show" id="collapse_ft_3">
						<ul class="contacts">
							<li><i class="ti-home"></i>Calle Irigoyen #1018<br>COCHABAMBA - BOLIVIA</li>
							<li><i class="ti-headphone-alt"></i>76589013 - 4355679</li>
							<li><i class="ti-email"></i><a href="#0">info@maskhayplace.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6">
					<a data-toggle="collapse" data-target="#collapse_ft_4" aria-expanded="false" aria-controls="collapse_ft_4" class="collapse_bt_mobile">
						<div class="circle-plus closed">
							<div class="horizontal"></div>
							<div class="vertical"></div>
						</div>
						<h3>Mantente en contacto</h3>
					</a>
					<div class="collapse show" id="collapse_ft_4">
						<div id="newsletter">
							<div id="message-newsletter"></div>
							<form method="post" action="assets/newsletter.php" name="newsletter_form" id="newsletter_form">
								<div class="form-group">
									<input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Ingresa tu emaol">
									<input type="submit" value="Submit" id="submit-newsletter">
								</div>
							</form>
						</div>
						<div class="follow_us">
							<h5>Siguenos</h5>
							<ul>
								<li><a href="#0"><i class="ti-facebook"></i></a></li>
								<li><a href="#0"><i class="ti-twitter-alt"></i></a></li>
								<li><a href="#0"><i class="ti-google"></i></a></li>
								<li><a href="#0"><i class="ti-pinterest"></i></a></li>
								<li><a href="#0"><i class="ti-instagram"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			
		</div>
	</footer>
	<!--/footer-->
	</div>
	<!-- page -->
	
	<!-- Sign In Popup -->
	<div id="sign-in-dialog" class="zoom-anim-dialog mfp-hide">
		<div class="small-dialog-header">
			<h3>Iniciar Sesion</h3>
		</div>
		<div class="login-box">
			<div id="LOGINresponse"></div>
			<div class="sign-in-wrapper">
				<div class="form-group">
					<label>Usuario</label>
					<input type="text" class="form-control" placeholder="Nombre de Usuario" name="usuario" id="usuario">
					<i class="icon_profile"></i>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" placeholder="Password" name="password" id="password">
					<i class="icon_lock_alt"></i>
				</div>
				<div class="text-center"><button id="Logearse" class="btn_1 full-width">Iniciar Sesion</button></div>
				<div class="text-center">
					Nuevo en nuestro sitio? <a href="logearse_registrarse.php">Registrate</a>
				</div>
			</div>
		</div>
		<!--form -->
	</div>
	<!-- /Sign In Popup -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="assets/public/js/common_scripts.js"></script>
	<script src="assets/public/js/functions.js"></script>
	
	<!-- Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE"></script>
	<!-- <script src="assets/public/js/map_single_restaurant.js"></script> -->
	
	<!-- DATEPICKER  -->
	<script>

	$('.logearsePOP').magnificPopup({
		type: 'inline',
		fixedContentPos: true,
		fixedBgPos: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: true,
		midClick: true,
		removalDelay: 300,
		closeMarkup: '<button title="%title%" type="button" class="mfp-close"></button>',
		mainClass: 'my-mfp-zoom-in'
	});

	//Datos del Hotel para marcadores

	var 
	mapObject,
	markers = [],
	markersData = {
		'Marker': [
		{
			type_point: '<?=$resHotel["categoria"]?>',
			name: '<?=$resLugar["nombre_lugar"]?>',
			location_latitude: <?=$resLugar["latitud_gps"]?>, 
			location_longitude: <?=$resLugar["longitud_gps"]?>,
			map_image_url: '<?= $resLugar["logo"] != null && $resLugar["logo"] != '' ? $resLugar["logo"] : "assets/public/img/thumb_map_single_restaurant.jpg"?>',
			rate: '<?=isset($cate_calif) ? $cate_calif : "Sin Calificacion"?> | <?=isset($promedio_calif) ? $promedio_calif : 0?>',
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

	//Evento para Iniciar Sesion
	$(document).on('click', '#Logearse', function() {
			var usuario = $('#usuario').val();
		var password = $('#password').val();
		
		$.ajax({
			type: "POST",
			url: "app/requestAJAX/logearseSesion.request.php",
			data: {
				usuario: usuario,
				password: password
			},
			cache: false,
			success: function (response) {
				if(response == 1) {
					$('#LOGINresponse').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Correcto!</strong> Usuario Logeado con exito!.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					location.reload();
				} else {
					$('#LOGINresponse').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ERROR:</strong> '+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		});

	});


	$(document).on('click', '#btnEnviar', function() {
		var puntaje = $('#calificacion_puntaje').val();
		var comentario = $('#comentario').val();
		var idLugar = $('#idLugar').val();
		
		// console.log(idLugar);

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
					$("#reviews").load(location.href + " #reviews");
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

    </script>
	<script src="assets/public/js/infobox.js"></script>

</body>
</html>