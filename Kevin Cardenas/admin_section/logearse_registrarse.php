<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MaskhayPlace - Reservas de Usuario">
    <meta name="author" content="UPDS">
    <title>MaskhayPlace | Iniciar Sesion</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="../assets/public/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="../assets/public/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="../assets/public/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="../assets/public/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="../assets/public/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../assets/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/public/css/style.css" rel="stylesheet">
	<link href="../assets/public/css/vendors.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="../assets/public/css/custom.css" rel="stylesheet">
</head>

<body>
	
	<div id="page">
		
	<header class="header_in is_sticky">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div id="logo">
						<a href="index.html">
							<img src="../assets/public/img/logo.png" width="165" height="35" alt="" class="logo_sticky">
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
			<h1>Cuenta</h1>
		</div>
		<!-- /container -->
	</div>
	<!-- /sub_header -->
	
	<main>
		<div class="container margin_60">
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Ya tengo cuenta</h3>
					<div id="LoginINResponse"></div>
					<div class="form_container">
						<div class="form-group">
							<label>Usuario</label>
							<input type="text" class="form-control" name="usuario" id="usuario_in" placeholder="Nombre de Usuario*">
						</div>
						<div class="form-group">
							<label>Contraseña</label>
							<input type="password" class="form-control" name="password_in" id="password_in" value="" placeholder="Password*">
						</div>
						<div class="text-center"><button id="LoginIN" class="btn_1 full-width">Iniciar Sesion</button></div>
					</div>
					<!-- /form_container -->
				</div>
				
			</div>
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Registrarse</h3> <small class="float-right pt-2">* Campos requeridos</small>
					<div id="RegisterINResponse"></div>
					<div class="form_container">
						<div class="form-group">
							<label>Nombre de Usuario</label>
							<input type="text" class="form-control" name="usuario_in_2" id="usuario_in_2" placeholder="Nombre Usuario*">
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" class="form-control" name="password_in_2" id="password_usuario" value="" placeholder="Password*">
						</div>
						<div class="form-group">
							<label>Repite Password</label>
							<input type="password" class="form-control" name="passwordres_in_2" id="respassword_usuario" value="" placeholder="Repite Password*">
						</div>
						<div class="form-group">
							<label>Correo</label>
							<input type="email" class="form-control" name="correo" id="correo_usuario" placeholder="Correo*">
						</div>
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<label>Nombre</label>
										<input type="text" class="form-control" placeholder="Nombre*" id="nombre_usuario">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<label>Apellidos</label>
										<input type="text" class="form-control" placeholder="Apellidos*" id="apellidos_usuario">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Celular</label>
										<input type="text" class="form-control" id="celular_usuario" placeholder="Celular *">
									</div>
								</div>
							</div>
							<!-- /row -->
						</div>
						<div class="text-center"><button id="RegistrarseIN" class="btn_1 full-width">Registrarse</div>
					</div>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>
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
					Nuevo en nuestro sitio? <a href="#">Registrate</a>
				</div>
			</div>
		</div>
		<!--form -->
	</div>
	<!-- /Sign In Popup -->
	
	<div id="toTop"></div><!-- Back to top button -->
	
	<!-- COMMON SCRIPTS -->
    <script src="../assets/public/js/common_scripts.js"></script>
	<script src="../assets/public/js/functions.js"></script>
  
	<script>
	
	//Evento para Iniciar Sesion
	$(document).on('click', '#Logearse', function() {
		var usuario = $('#usuario').val();
		var password = $('#password').val();
		
		$.ajax({
			type: "POST",
			url: "../app/requestAJAX/logearseSesion.request.php",
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

	//Evento para Iniciar Sesion
	$(document).on('click', '#LoginIN', function() {
		var usuario = $('#usuario_in').val();
		var password = $('#password_in').val();
		
		$.ajax({
			type: "POST",
			url: "../app/requestAJAX/logearseSesion.request.php",
			data: {
				usuario: usuario,
				password: password
			},
			cache: false,
			success: function (response) {
				if(response == 1) {
					$('#LoginINResponse').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Correcto!</strong> Usuario Logeado con exito!.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					location.reload();
				} else {
					$('#LoginINResponse').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ERROR:</strong> '+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		});

	});

	//Evento para Registrarse
	$(document).on('click', '#RegistrarseIN', function() {
		var usuario = $('#usuario_in_2').val();
		var password = $('#password_usuario').val();
		var respassword = $('#respassword_usuario').val();
		var correo = $("#correo_usuario").val();
		var nombre = $("#nombre_usuario").val();
		var apellidos = $("#apellidos_usuario").val();
		var celular = $("#celular_usuario").val();
		
		// console.log(usuario, password, respassword, correo, nombre, apellidos, celular);

		$.ajax({
			type: "POST",
			url: "../app/requestAJAX/registrarseSesion.request.php",
			data: {
				usuario: usuario,
				password: password,
				respassword: respassword,
				correo: correo,
				nombre: nombre,
				apellidos: apellidos,
				celular: celular
			},
			cache: false,
			success: function (response) {
				if(response == 1) {
					$('#RegisterINResponse').html('<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Correcto!</strong> Usuario Logeado con exito!.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					location.reload();
				} else {
					$('#RegisterINResponse').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>ERROR:</strong> '+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
				}
			}
		});

	});
	
	</script>

</body>
</html>