<?php

$_SESSION["usuario"] = array(
	'id' => 3,
	'nombre' => 'Carlos Rodrigo'
);

if(!isset($_SESSION["usuario"])) {
	header('Location: index-2.html');
}

//Obtener Reservas del Usuario

$idUsuario = $_SESSION["usuario"]["id"];

include('helpers/class.Conexion.php');

$db = new Conexion();

setlocale(LC_ALL,"es_ES");

$obtenerReservas = $db->query("SELECT * FROM reserva WHERE usuario = $idUsuario");
if($db->rows($obtenerReservas) > 0) {
	while($resReserva = $db->recorrer($obtenerReservas)) {
		//Obtener nombre del Lugar
		$idResto = $resReserva["restaurante"];
		$obtenerLugar = $db->query("SELECT l.nombre_lugar FROM restaurante r, lugar l WHERE r.id_restaurante = $idResto AND r.lugar = l.id_lugar");
		$nombreLugar = $db->recorrer($obtenerLugar);

		$fecha_reserva = explode("-",$resReserva["fecha"]);

		$dia_reserva = $fecha_reserva[2];

		$mes_reserva = strftime("%b", strtotime($resReserva["fecha"]));
		
		$dia_semana = strftime("%A", strtotime($resReserva["fecha"]));

		$reservas[] = array(
			'id' => $resReserva["id_reserva"],
			'restaurante' => $nombreLugar[0],
			'nombre_reserva' => $resReserva["nombre_reserva"],
			'fecha' => $resReserva["fecha"],
			'hora' => $resReserva["hora"],
			'dia' => $dia_reserva,
			'mes' => $mes_reserva,
			'dia_semana' => $dia_semana,
			'cantidad' => $resReserva["cantidad_personas"],
			'estado' => $resReserva["estado"] 
		);
	}
	$db->liberar($obtenerReservas);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MaskhayPlace - Reservas de Usuario">
    <meta name="author" content="UPDS">
    <title>MaskhayPlace | Mis Reservas</title>

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
	
	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>

	<style>
	#sign-in-dialog .form-group input.form-control {
		padding-left: 15px;
	}
	#sign-in-dialog .form-group i {
		left:250px;
		top:6px;
		line-height:1.5;
	}
	</style>
</head>

<body>
	
	<div id="page">
		
	<header class="header_in is_sticky">
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
						<li><a href="#" class="btn_add">Publicar Lugar</a></li>
					<?php
					if(!isset($_SESSION["usuario"])) {
						echo '<li><a href="#sign-in-dialog" id="sign-in" class="login" title="Iniciar Sesión">Iniciar Sesión</a></li>';
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
                            <li><span><a href="index.php">Inicio</a></span></li>
                            <li><span><a href="#">Categorias</a></span>
                                <ul>
                                    <li><a href="#">Hoteles</a></li>
                                    <li><a href="#">Restaurantes</a></li>
                                    <li><a href="#">Farmacias</a></li>
                                </ul>
							</li>
						<?php
						if(isset($_SESSION["usuario"])){
						?>
							<li><span><a href="#"><span class="ti-angle-down"> </span><?=$_SESSION["usuario"]["nombre"]?></a></span>
								<ul>
									<li><a href="#">
										<span class="ti-dashboard"> </span>
										Administrar mi Negocio</a>
									</li>
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
		
	<div class="sub_header_in">
		<div class="container">
			<h1>Mis Reservas</h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->
	
	<main>
		<div id="reservas" class="container margin_60_35">
			<div class="box_booking">	
		<?php
		if(isset($reservas)) {
			foreach ($reservas as $key => $reserva) {
		?>
				<div class="strip_booking">
					<div class="row">
						<div class="col-lg-2 col-md-2">
							<div class="date">
								<span class="month"><?=$reserva["mes"]?></span>
								<span class="day"><strong><?=$reserva["dia"]?></strong><?=$reserva["dia_semana"]?></span>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<h3 class="restaurant_booking"><?=$reserva["restaurante"]?><span><?=$reserva["cantidad"]?> Personas</span></h3>
						</div>
						<div class="col-lg-2 col-md-2">
							<ul class="info_booking">
								<li><strong>ID Reserva</strong> <?=$reserva["id"]?></li>
								<li><strong>A Nombre de</strong> <?=$reserva["nombre_reserva"]?></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-2">
							<ul class="info_booking">
								<li><strong>Fecha/Hora</strong> <?=$reserva["fecha"]." - ".$reserva["hora"]?></li>
								<li><strong style="margin-bottom: 12px;">Estado</strong> <span class="loc_open"><?=$reserva["estado"]?></span></li>
							</ul>
						</div>
						<div class="col-lg-2 col-md-2">
							<div class="booking_buttons">
								<button href="#sign-in-dialog" class="btn_2 updateReserva" data-id="<?=$reserva["id"]?>">Modificar</button>
								<button class="btn_3 eliminar_reserva" data-id="<?=$reserva["id"]?>">Cancelar</button>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /strip booking -->
		<?php
			}
		} else {
			?>
			<h3>Sin reservas</h3>
			<?php
		}
		?>
			</div>
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
			<h3>Modificar Reserva</h3>
		</div>
		<div class="box_detail booking">
			<div id="AJAXreserva"></div>
			<div class="sign-in-wrapper">
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

				<input type="hidden" id="id_reserva">
				<button id="EnviarReserva" class="add_top_30 btn_1 full-width purchase">Modificar Reserva</button>
			</div>
		</div>
		<!--form -->
	</div>

	<!-- /Sign In Popup -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="assets/public/js/common_scripts.js"></script>
	<script src="assets/public/js/functions.js"></script>
	<script src="assets/public/extras/validate.js"></script>

	<!-- INPUT QUANTITY  -->
	<script src="assets/public/js/input_qty.js"></script>
	
	<script>
	$('.updateReserva').magnificPopup({
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

	$(document).on('click', '.updateReserva', function() {
		var id_reserva = $(this).data('id');
		
		$.ajax({
			type: "GET",
			url: "app/requestAJAX/obtenerReserva.request.php",
			data: {
				id: id_reserva
			},
			cache: false,
			success: function (response) {
				if(response != 0) {
					var jsonData = JSON.parse(response);
					for (var i = 0; i < jsonData.data.length; i++) {
						var reserva = jsonData.data[i];
					}
					$('#nombre_reserva').val(reserva.nombre_reserva);
					$('#fecha_reserva').val(reserva.fecha);
					$('#cant_reserva').val(reserva.cantidad_personas);
					$('.qtyTotal').html(reserva.cantidad_personas);
					var hora = reserva.hora;
					var hora_final = hora.substring(0, hora.length - 3);
					$('#hora_reserva').val(hora_final).niceSelect('update');
					$('#id_reserva').val(id_reserva);
				}
			}
		});
	});

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
	
	$(document).on('click', '.eliminar_reserva', function() {
		var btn = $(this);
		var id;
		alertify.confirm('Cancelar Reserva', 'Estas seguro?', 
		function(){ 
			id = btn.data('id');
			$.ajax({
				type: "POST",
				url: "app/requestAJAX/cancelarReserva.request.php",
				data: {
					id: id
				},
				success: function (response) {
					if(response == 1) {
						alertify.success('Reserva Cancelada');
						location.reload()
					} else {
						alertify.error('ERROR: ' + response);
					}
				}
			});

		}, 
		function(){ alertify.error('Accion Cancelada')}).set('labels', {ok:'Si', cancel:'No'}); ;
	});

	$(document).on('click', '#EnviarReserva', function() {
		var id = $('#id_reserva').val();
		var nombre = $('#nombre_reserva').val();
		var fecha = $('#fecha_reserva').val();
		var cant = $('#cant_reserva').val();
		var hora = $('#hora_reserva').val();
		// alert('Reserva realizada con exito \n' + nombre + '\n' + fecha + '\n' + cant + '\n' + hora);
		$.ajax({
			type: "POST",
			url: "app/requestAJAX/modificarReserva.request.php",
			data: {
				id: id,
				nombre: nombre,
				fecha: fecha,
				cant: cant,
				hora: hora,
			},
			cache: false,
			success: function (response) {
				if(response == 1) {
					$('#AJAXreserva').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Finalizado!</strong> Su reserva a sido enviada para su verificacion.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					location.reload();
				} else {
					$('#AJAXreserva').html('<div class="alert alert-info alert-dismissible fade show" role="alert"><strong>ERROR!</strong> '+response+'.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		});
	});

	</script>

</body>
</html>