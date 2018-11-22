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
    <!-- <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet"> -->

    <!-- BASE CSS -->
    <link href="assets/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/public/css/style.css" rel="stylesheet">
	<link href="assets/public/css/vendors.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/public/css/animate.css-master/animate.min.css">


    <!-- YOUR CUSTOM CSS -->
    <link href="assets/public/css/custom.css" rel="stylesheet">

</head>

<body>
	
	<div id="page" class="theia-exception">
		
	<header class="header_in">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-12">
					<div id="logo">
						<a href="index.html">
							<img src="assets/public/img/logo_sticky.svg" width="165" height="35" alt="" class="logo_sticky">
						</a>
					</div>
				</div>
				<div class="col-lg-9 col-12">
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
		<!-- search_mobile -->
		<div class="layer"></div>
		<div id="search_mobile">
			<a href="#" class="side_panel"><i class="icon_close"></i></a>
			<div class="custom-search-input-2">
				<div class="form-group">
					<input class="form-control inpBuscar" type="text" id="inpBuscarMob" placeholder="Que estas Buscando...">
					<i class="icon_search"></i>
				</div>
				<div class="form-group">
					<input id="inpDondeMob" class="form-control" type="text" placeholder="Donde">
					<i class="icon_pin_alt miPosicion" ></i>
				</div>
				<select class="wide selectCat" id="selectCategoriaMob">
					<option value="">Categoria</option>	
					<option value="hotel">Hotel</option>
					<option value="restaurante">Restaurante</option>
					<option value="farmacia">Farmacia</option>
				</select>
				<input type="btn" class="btnBuscarP" value="Search">
			</div>
		</div>
		<!-- /search_mobile -->
	</header>
	<!-- /header -->
	
	<main>
		<div id="results">
		   <div class="container">
			   <div class="row">
				   <div class="col-lg-3 col-md-4 col-10">
					   <h4><strong id="numResBusqueda">0 </strong>resultado para todos los listados</h4>
				   </div>
				   <div class="col-lg-9 col-md-8 col-2">
					   <a href="#0" class="side_panel btn_search_mobile"></a> <!-- /open search panel -->
						<div class="row no-gutters custom-search-input-2 inner">
							<div class="col-lg-4">
								<div class="form-group">
									<input class="form-control inpBuscar" type="text" id="inpBuscarDesk" placeholder="Que estas Buscando...">
									<i class="icon_search"></i>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
									<input id="inpDondeDesk" class="form-control" type="text" placeholder="Donde">
									<i class="icon_pin_alt miPosicion"></i>
								</div>
							</div>
							<div class="col-lg-3">
								<select class="wide selectCat" id="selectCategoriaDesk">
										<option value="">Categoria</option>	
										<option value="hotel">Hotel</option>
										<option value="restaurante">Restaurante</option>
										<option value="farmacia">Farmacia</option>
								</select>
							</div>
							<div class="col-lg-1">
								<input type="submit" class="btnBuscarP" value="Search">
							</div>
						</div>
				   </div>
			   </div>
			   <!-- /row -->
		   </div>
		   <!-- /container -->
	   </div>
	   <!-- /results -->
		
		<div class="filters_listing version_2  sticky_horizontal">
			<div class="container">
				<ul class="clearfix">
					<li>
						<div class="switch-field">
							<input class="orden" type="radio" id="all" name="listing_filter" value="all" checked>
							<label for="all">All</label>
							<input class="orden" type="radio" id="popular" name="listing_filter" value="pop">
							<label for="popular">Popular</label>
							<input class="orden" type="radio" id="latest" name="listing_filter" value="ult">
							<label for="latest">Latest</label>
						</div>
					</li>
					
				</ul>
			</div>
			<!-- /container -->
		</div>
		<!-- /filters -->
		
		<div class="collapse" id="collapseMap">
			<div id="map" class="map"></div>
		</div>
		<!-- /Map -->
		
		<div class="container margin_60_35">
			<div class="row">
				<aside class="col-lg-3" id="sidebar">
					<div id="filters_col">
						<a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt">Filters </a>
						<div class="collapse show" id="collapseFilters">
							<div class="filter_type">
								<h6>Category</h6>
								<ul>
									<li>
										<label class="container_check">Hotel <small id="numHoteles">0</small>
										  <input type="checkbox" class="chboxCat" value="catHotel" id="catHotel">
										  <span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">Restaurante <small id="numRestaurantes">0</small>
										  <input type="checkbox" class="chboxCat" value="catRestaurante" id="catRestaurante">
										  <span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">Farmacia <small id="numFarmacias">0</small>
										  <input type="checkbox" class="chboxCat" value="catFarmacia" id="catFarmacia">
										  <span class="checkmark"></span>
										</label>
									</li>
								</ul>
							</div>
							<div class="filter_type">
                                <h6>Distance</h6>
                                <div class="distance"> Radius around selected destination <span></span> km</div>
								<input id="radioKm" type="range" min="0" max="5" step="1" value="0" data-orientation="horizontal">
                            </div>
							<div class="filter_type">
								<h6>Rating</h6>
								<ul>
									<li>
										<label class="container_check">Superb 5 <small id="pts5">0</small>
										  <input type="checkbox" class="chboxPts" id="cPts5">
										  <span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">Good 3+ <small id="pts34">0</small>
										  <input type="checkbox" class="chboxPts" id="cPts34">
										  <span class="checkmark"></span>
										</label>
									</li>
									<li>
										<label class="container_check">Pleasant 1+ <small id="pts02">0</small>
										  <input type="checkbox" class="chboxPts" id="cPts02">
										  <span class="checkmark"></span>
										</label>
									</li>
								</ul>
							</div>
						</div>
						<!--/collapse -->
					</div>
					<!--/filters col-->
				</aside>
				<!-- /aside -->

				<div class="col-lg-9">
					<div class="row" id="cardLugares">

					</div>
					<!-- /row -->

					<p class="text-center" id="btnVermas"><a href="#0" class="btn_1 rounded add_top_30">Load more</a></p>
				</div>
				<!-- /col -->
			</div>		
		</div>
		<!-- /container -->
		
	</main>
	<!--/main-->
	
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
	<!-- <script src="assets/validate.js"></script> -->
	
	<!-- Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE"></script>
	<script src="assets/public/js/markerclusterer.js"></script>
	<script src="assets/public/js/map.js"></script>
	<script src="assets/public/js/infobox.js"></script>
	<script>
			var datos;
			var busqueda;
			var lugar;
			var categoria=[''];
			var radio;
			var puntos=[''];
			var orden='all';

			//Parametros Url
			function getParameterByName(name) {
				name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
				var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
					results = regex.exec(location.search);
				return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
			}
			getLocation();
			//primera Vez
			$.getJSON('busqueda/controller/busqueda.php',
			{
				buscar:getParameterByName('buscar'),
				lugar:getParameterByName('lugar'),
				categoria:[getParameterByName('categoria')],
				distaciaRad:'',
				orden:'all',
				puntaje:['all']
			},
			function (data, textStatus, jqXHR) {
						// numero de sitios
						console.log(data)
						datos=data;
						$('#numHoteles').html(data.numSitios.hoteles);
						$('#numRestaurantes').html(data.numSitios.restaurantes);
						$('#numFarmacias').html(data.numSitios.farmacias);
						// puntajes
						$('#pts5').html(data.sitiosPuntaje.pts5);
						$('#pts34').html(data.sitiosPuntaje.pts34);
						$('#pts02').html(data.sitiosPuntaje.pts02);
						//num Resultados
						$('#numResBusqueda').html(data.sitios.length + ' ');
						//card Sitios
						var htmlsitios='';
						for (let i = 0; i < data.sitios.length && i<limit; i++) {
							var sitio=data.sitios[i];
							htmlsitios += `<div class="col-md-6">
												<div class="strip grid animated pulse">
												<figure>
												<a href="#0" class="wish_bt"></a>
												<a href="${urlDetalles(sitio.categoria)}?id=${sitio.id_lugar}"><img src="${sitio.logo}" class="img-fluid" alt=""/>
												<div class="read_more"><span>Read more</span></div>
												</a>
												<small>${sitio.categoria}</small>
												</figure>
												<div class="wrapper">
												<h3><a href="${urlDetalles(sitio.categoria)}?id=${sitio.id_lugar}">${sitio.nombre_lugar}</a></h3>
												<small>${sitio.direccion}</small>
												<p>${sitio.descripcion}</p>
												<a class="address" href="https://www.google.com/maps/dir/${coord.lat},${coord.lng}/${sitio.latitud_gps},${sitio.longitud_gps}">Get directions</a>
												</div>
												<ul>
													<li></li>
													<li>
													<div class="score"><span>Calificaciones<em>${sitio.numCalificaciones}</em></span><strong>${sitio.promedio}</strong></div>
													</li>
												</ul>
												</div>
												</div>`
						
						}

						$('#cardLugares').html(htmlsitios);
						if(limit>= data.sitios.length)
						{
							document.getElementById('btnVermas').style.display='none'
						}
				}
			);
			// $.ajax({
			// 	type: "GET",
			// 	url: "busqueda/controller/busqueda.php",
			// 	data: {
			// 		buscar:getParameterByName('buscar'),
			// 		lugar:getParameterByName('lugar'),
			// 		categoria:[getParameterByName('categoria')],
			// 		distaciaRad:'',
			// 		orden:'all',
			// 		puntaje:varPuntos()
			// 	},
			// 	success: function (response) {
			// 		console.log(response);
			// 	}
			// });

			// buscar
			function varBuscar()
			{
				var data;
				var buscDesk=document.getElementById('inpBuscarDesk').value;
				var buscMob=document.getElementById('inpBuscarMob').value;
				var width=window.innerWidth;
				data=(width>991)?buscDesk:buscMob;
				return data;
			}
			//categorias
			function varCategorias()
			{
				var categorias=[];
				//checkBox categorias
				chkbHoteles=document.getElementById('catHotel');
				chkbRestaurante=document.getElementById('catRestaurante');
				chkbFarmacia=document.getElementById('catFarmacia');
				var sCatDesk=document.getElementById('selectCategoriaDesk').value;//select Desktop
				var sCatMob=document.getElementById('selectCategoriaMob').value;//select Mobile
				if(chkbHoteles.checked==true ||(sCatDesk!=''&& sCatDesk=='hotel')||(sCatMob!=''&& sCatMob=='hotel'))
				{
					categorias.push('hotel')
				}
				if(chkbFarmacia.checked==true ||(sCatDesk!=''&& sCatDesk=='farmacia')||(sCatMob!=''&& sCatMob=='farmacia'))
				{
					categorias.push('farmacia')					
				}
				if(chkbRestaurante.checked==true ||(sCatDesk!=''&& sCatDesk=='restaurante')||(sCatMob!=''&& sCatMob=='restaurante'))
				{
					categorias.push('restaurante')					
				}
				return categorias;
			}
			// puntos
			function varPuntos()
			{
				var puntos=[];
				chkbPts5=document.getElementById('cPts5');
				chkbPts34=document.getElementById('cPts34');
				chkbPts02=document.getElementById('cPts02');
				if(chkbPts5.checked==true)
				{
					puntos.push('5')
				}
				if(chkbPts34.checked==true)
				{
					puntos.push('34')					
				}
				if(chkbPts02.checked==true)
				{
					puntos.push('02')					
				}
				console.log(puntos)
				return puntos;
			}

			function varPosicion()
			{
				var width=window.innerWidth;
				var donde='';
				donde=(width>991)?$('#inpDondeDesk').val():$('#inpDondeMob').val();
				var resp={lat:'',lng:''}
				if (donde.includes(',')) {
					var donde=donde.split(',')
					resp.lat=donde[0]
					resp.lng=donde[1]
					console.log(resp)
				}
				else if(donde!='')
				{
					donde=getCoordSitio(donde);
				}
				return donde;
			}
			$('.miPosicion').click(function () { 
				var coord=getLocation();
				$('#inpDondeDesk').val(`${coord.lat},${coord.lng}`);
				$('#inpDondeMob').val(`${coord.lat},${coord.lng}`);
			});
			//Acciones para Get
			//buscar
			$('.inpBuscar').keyup(function (e) { 
				getDatos();
			});
			//checkbox categorias
			$('.chboxCat').click(function () { 
				getDatos();
			});
			//select categorias
			$('.selectCat').change(function () { 
				getDatos();
			});
			//puntos
			$('.chboxPts').click(function () { 
				getDatos();
			});
			//scroll
			$('#radioKm').change(function () { 
				getDatos();
			});
			$('#btnBuscar').click(function () { 
				getDatos();
			});
			//modificador var Orden
			$('.orden').click(function () { 
				console.log($(this).val())
				orden=this.value;
				getDatos();
			});
			$('#btnVermas').click(function () { 
				limit+=limit;
				getDatos();
				
			});
			$('.btnBuscarP').click(function () { 
				getDatos();
			});
			
			var limit=6;
			function getDatos()
			{
				$.getJSON('busqueda/controller/busqueda.php',
					{
						buscar: varBuscar(),
						lugar: '',
						categoria: varCategorias(),
						distaciaRad: $('#radioKm').val(),
						coordenada: varPosicion(),
						orden: orden,
						puntaje: varPuntos()
					},
					function (data, textStatus, jqXHR) {
						// numero de sitios
						datos=data;
						console.log(data)
						$('#numHoteles').html(data.numSitios.hoteles);
						$('#numRestaurantes').html(data.numSitios.restaurantes);
						$('#numFarmacias').html(data.numSitios.farmacias);
						// puntajes
						$('#pts5').html(data.sitiosPuntaje.pts5);
						$('#pts34').html(data.sitiosPuntaje.pts34);
						$('#pts02').html(data.sitiosPuntaje.pts02);
						//num Resultados
						$('#numResBusqueda').html(data.sitios.length + ' ');
						//card Sitios
						var htmlsitios='';
						var coord=getLocation();
						for (let i = 0; i < data.sitios.length && i<limit; i++) {
							var sitio=data.sitios[i];
							htmlsitios += `<div class="col-md-6">
												<div class="strip grid animated pulse">
												<figure>
												<a href="#0" class="wish_bt"></a>
												<a href="${urlDetalles(sitio.categoria)}?id=${sitio.id_lugar}"><img src="${sitio.logo}" class="img-fluid" alt=""/>
												<div class="read_more"><span>Read more</span></div>
												</a>
												<small>${sitio.categoria}</small>
												</figure>
												<div class="wrapper">
												<h3><a href="${urlDetalles(sitio.categoria)}?id=${sitio.id_lugar}">${sitio.nombre_lugar}</a></h3>
												<small>${sitio.direccion}</small>
												<p>${sitio.descripcion}</p>
												<a class="address" href="https://www.google.com/maps/dir/${coord.lat},${coord.lng}/${sitio.latitud_gps},${sitio.longitud_gps}">Get directions</a>
												</div>
												<ul>
													<li></li>
													<li>
													<div class="score"><span>Calificaciones<em>${sitio.numCalificaciones}</em></span><strong>${sitio.promedio}</strong></div>
													</li>
												</ul>
												</div>
												</div>`
						
						}
						if(limit>= data.sitios.length)
						{
							document.getElementById('btnVermas').style.display='none'
						}
						$('#cardLugares').html(htmlsitios);
					}
				);
			}
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
				var coord={
					lat: '',
					lng: ''
				}
			function getCoordSitio(sitio)
			{
				var geocoder= new google.maps.Geocoder();
				var address=sitio;
				geocoder.geocode({
					address: address,
					},
					function(results, status)
					{
						if(status== 'OK')
						{
							console.log(sitio)
							console.log(`latitud: ${results[0].geometry.location.lat()}`)
							console.log(`longitud: ${results[0].geometry.location.lng()}`)
							coord.lat=results[0].geometry.location.lat();
							coord.lat=results[0].geometry.location.lng();
						}
					}
				);
				return coord;
			}
			function getLocation() {

					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(function (pos) {
							coord.lat = pos.coords.latitude;
							coord.lng = pos.coords.longitude;
						});
					} else {
						console.log("No soportado.");
					}
					return coord;
				}
			
	
	</script>		
  
</body>
</html>