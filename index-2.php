<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="SPARKER - Premium directory and listings template by Ansonika.">
    <meta name="author" content="Ansonika">
    <title>SPARKER | Premium directory and listings template by Ansonika.</title>

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
	
	<!-- Modernizr -->
	<script src="assets/public/js/modernizr.js"></script>

</head>

<body>
		
	<div id="page">
		
	<header class="header menu_fixed">
		<div id="logo">
			<a href="index.html" title="Sparker - Directory and listings template">
				<img src="assets/public/img/logo2.png" width="165" height="35" alt="" class="logo_normal">
				<img src="assets/public/img/logo.png" width="165" height="35" alt="" class="logo_sticky">
			</a>
		</div>
		<ul id="top_menu">
			<?php
				if(isset($_SESSION["usuario"])) {
					if($_SESSION["usuario"]["negocio"] == 0) {
						echo '<li><a href="#" class="btn_add">Publicar Lugar</a></li>';
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
			<?php 	endif; ?>
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
	</header>
	<!-- /header -->
	
	<main class="pattern">
		<section class="header-video">
			<div id="hero_video">
				<div class="wrapper">
				<div class="container">
					<h3>Busca lo que necesitas!</h3>
						Descubre el Top de Hoteles, Restaurantes y Farmacias en COCHABAMBA
					</p>
					<form method="GET" action="grid-listings-filterscol-search-aside.php">
						<div class="row no-gutters custom-search-input-2">

							<div class="col-lg-4">
								<div class="form-group">
									<input class="form-control" name="buscar" type="text" placeholder="Qué estas Buscando ...">
									<i class="icon_search"></i>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<input class="form-control"name="lugar" type="text" placeholder="Donde ...">
									<i class="icon_pin_alt"></i>
								</div>
							</div>
							<div class="col-lg-3">
								<select name="categoria" class="wide">
									<option value="">Categoria</option>	
									<option value="hotel">Hotel</option>
									<option value="restaurante">Restaurante</option>
									<option value="farmacia">Farmacia</option>
								</select>
							</div>
							<div class="col-lg-2">
								<input type="submit" value="Buscar">
							</div>
						</div>
						<!-- /row -->
					</form>
				</div>
			</div>
			</div>
			<img src="assets/public/img/video_fix.png" alt="" class="header-video--media" data-video-src="assets/public/video/intro" data-teaser-source="assets/public/video/intro" data-provider="" data-video-width="1920" data-video-height="960">
		</section>
		<!-- /header-video -->

		<div class="main_categories">
			<div class="container">
				<ul class="clearfix">
					<li>
						<a href="grid-listings-filterscol-search-aside.php?buscar=&lugar=&categoria=farmacia">
							<i class="icon-shop"></i>
							<h3>Farmacias</h3>
						</a>
					</li>
					<li>
						<a href="grid-listings-filterscol-search-aside.php?buscar=&lugar=&categoria=hotel">
							<i class="icon-lodging"></i>
							<h3>Hoteles</h3>
						</a>
					</li>
					<li>
						<a href="grid-listings-filterscol-search-aside.php?buscar=&lugar=&categoria=restaurante">
							<i class="icon-restaurant"></i>
							<h3>Restaurantes</h3>
						</a>
					</li>
				</ul>
			</div>
			<!-- /container -->
		</div>
		<!-- /main_categories -->
		
		<div class="container margin_60_35">
			<div class="main_title_3">
				<span></span>
				<h2>Mejores Hoteles</h2>
				<p>Mejores Precios en los Mejores Hoteles.</p>
				<a href="grid-listings-filterscol-search-aside.php?buscar=&lugar=&categoria=hotel">Ver todo</a>
			</div>
			<div class="row add_bottom_30" id="divTopHoteles">
				
			</div>
			<!-- /row -->
			
			<div class="main_title_3">
				<span></span>
				<h2>Mejores Restaurantes en Cochabamba </h2>
				<p>Porque no comemos para vivir, vivimos para comer.</p>
				<a href="grid-listings-filterscol-search-aside.php?buscar=&lugar=&categoria=restaurante">Ver todo</a>
			</div>
			<div class="row add_bottom_30" id="divTopRestaurante">
			
			</div>
			<!-- /row -->
			
			<div class="main_title_3">
				<span></span>
				<h2>Farmacias populares</h2>
				<p>Porque su salud nos importa, encuentre las mejores farmacias</p>
				<a href="grid-listings-filterscol-search-aside.php?buscar=&lugar=&categoria=farmacia">Ver todo</a>
			</div>
			<div class="row " id="divTopFarmacias">
				
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		
		<div class="call_section pattern">
			<div class="wrapper">
				<div class="container margin_80_55">
					<div class="main_title_2">
						<span><em></em></span>
						<h2>COMO FUNCIONA</h2>
						<p>Facil, rapido y eficaz</p>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="box_how">
								<i class="pe-7s-search"></i>
								<h3>Busca sitios</h3>
								<p>Puedes usar el mapa para buscar los sitios que necesites, como restaurantes, hoteles y farmacias.</p>
								<span></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="box_how">
								<i class="pe-7s-info"></i>
								<h3>Mira la informacion del lugar</h3>
								<p>Si te intersa algun tipo de negocio registrado de tu interes antes de tomar una decicion mira la informacion acerca del lugar que escogiste.</p>
								<span></span>
							</div>
						</div>
						<div class="col-md-4">
							<div class="box_how">
								<i class="pe-7s-like2"></i>
								<h3>Reservar, llegar o llamar</h3>
								<p>Puedes usar las opciones de reserva tu sitio de hotel o comida favorita en cada publicacion que escojas .</p>
							</div>
						</div>
					</div>
					<!-- /row -->
					<p class="text-center add_top_30 wow bounceIn" data-wow-delay="0.5"><a href="logearse_registrarse.php" class="btn_1 rounded">Registrate ahora</a></p>
				</div>
			</div>
			<!-- /wrapper -->
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->

	<footer class="plus_border">
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
	<script src="assets/validate.js"></script>
	
	<!-- SPECIFIC SCRIPTS -->
	<script src="assets/public/js/video_header.js"></script>
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

		HeaderVideo.init({
			container: $('.header-video'),
			header: $('.header-video--media'),
			videoTrigger: $("#video-trigger"),
			autoPlayVideo: true
		});
		$.getJSON('busqueda/controller/buscar.php',
			function (data, textStatus, jqXHR) {
				console.log(data)
				var hoteles="";
				var farmacias="";
				var restaurantes="";
				data.hoteles.forEach(hotel => {
					hoteles+=`<div class="col-lg-3 col-sm-6">
									<a href="${urlDetalles(hotel.categoria)}?id=${hotel.id_lugar}" class="grid_item small">
										<figure>
											<img src="${hotel.logo}" alt="">
											<div class="info">
													<div class="cat_star">
															${puntuacion(hotel.promedio)}
													</div> 
												<h3>${hotel.nombre_lugar}</h3>
											</div>
										</figure>
									</a>
								</div>`;

				});
				$('#divTopHoteles').html(hoteles);
				
				data.restaurantes.forEach(restaurante => {
					restaurantes+=`<div class="col-lg-3 col-sm-6">
										<a href="${urlDetalles(restaurante.categoria)}?id=${restaurante.id_lugar}" class="grid_item small">
											<figure><img src="${restaurante.logo}" alt="">
													<div class="info">
														<div class="cat_star">
															${puntuacion(restaurante.promedio)}
														</div> 
														<h3>${restaurante.nombre_lugar}</h3> 
													</div>
											</figure>
										</a>
									</div>`;
				});
				$('#divTopRestaurante').html(restaurantes);

				data.farmacias.forEach(farmacia => {
					farmacias+=`<div class="col-lg-3 col-sm-6">
                				    <a href="${urlDetalles(farmacia.categoria)}?id=${farmacia.id_lugar}" class="grid_item small">
                				        <figure>
                				            <img src="${farmacia.logo}" alt="">
                				            <div class="info">
                				                <h3>${farmacia.nombre_lugar}</h3>
                				            </div>
                				        </figure>
                				    </a>
                				</div>`;
				});
				$('#divTopFarmacias').html(farmacias);

				function puntuacion(puntos) {
					var cad = ``;
					for (let index = 1; index <= puntos; index++) {
						cad += `<i class="icon_star"></i>`;
					}
					console.log(cad);
					return cad;
				}
				
			}
		);
		function urlDetalles(categoria)
			{
				var url="";
				switch (categoria) {
					case 'Hotel':
					{
						url='hotel_detalle.php'
					}
						break;
					case 'Farmacia':
					{
						url='farmacia_detalle.php';
					}
					break;
					case 'Restaurante':
					{
						url='restaurante_detalle.php';
					}
						break;
				}
				return url;
			}

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
	</script>

</body>
</html>