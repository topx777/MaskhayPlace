<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="MaskhayPlace - Reservas de Usuario">
	<meta name="author" content="UPDS">
	<title>MaskhayPlace | Publicar Lugar</title>

  <!-- Favicons-->
  <link rel="shortcut icon" href="assets/admin/img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="assets/admin/img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/admin/img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/admin/img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/admin/img/apple-touch-icon-144x144-precomposed.png">
	
  <!-- Bootstrap core CSS-->
  <link href="assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="assets/admin/css/admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="assets/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  <link href="assets/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="assets/admin/vendor/dropzone.css" rel="stylesheet">
  <link href="assets/admin/css/date_picker.css" rel="stylesheet">
  <!-- Your custom styles -->
  <link href="assets/admin/css/custom.css" rel="stylesheet">
  <!-- WYSIWYG Editor -->
  <link rel="stylesheet" href="assets/admin/js/editor/summernote-bs4.css">
	
	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

	<!-- CSS -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
	<!-- Default theme -->
	<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
	
	<style>
	#map {
		height: 100%;
	}
	</style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html"><img src="assets/admin/img/logo.png" data-retina="true" alt="" width="165" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
          <a class="nav-link" href="add-listing.html">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="nav-link-text">Agregar Lugar</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar sesión</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
		<div id="AJAXresponse"></div>
		<div class="box_general padding_bottom" id="Basico">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Informacion Basica</h2>
			</div>
			<div class="container marketing">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>Logo</label>
						<input class="form-control" type="file" id="logo_lugar">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Nombre del Lugar </label>
						<input type="text" id="nombre_lugar" class="form-control" placeholder="Nombre del Lugar">
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Categoria</label>
						<div class="styled-select">
							<select id="categoria_lugar" name="categoria" onChange="mostrarCategoria();">
									<option>Elija una categoria</option>
									<option value="Farmacia">Farmacia</option>
									<option value="Hotel">Hotel</option>
									<option value="Restaurante">Restaurante</option>
							</select>
						</div>
					</div>
				</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label>Direccion</label>
							<input type="text" class="form-control" id="direccion_lugar" placeholder="Direccion de Lugar">
						</div>
					</div>
				</div>
				<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Descripcion</label>
								<textarea name="descripcion" id="descripcion_lugar" class="form-control" rows="3" required="required"></textarea>
							</div>
						</div>
					</div>
				</div>
			<!-- /row-->
				<div class="header_box version_2">
					<h2><i class="fa fa-phone"></i> Contacto </h2>
				</div>
				<div class="container marketing">

					<div class="row">
						<div class="col-md-9" id="NumContactosLugar">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Tipo</label>
										<div class="styled-select">
											<select id="tipo_numero1" name="tipo_numero1">
													<option>Elija un Tipo</option>
													<option value="Celular">Celular</option>
													<option value="Fijo">Fijo</option>
													<option value="Whatsapp">Whatsapp</option>
											</select>
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Numero 1</label>
										<input type="text" id="numero_contacto1" class="form-control" placeholder="Numero de Contacto">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<button id="agregarContacto" class="btn btn-primary" style="margin-top: 32px;"><i class="fa fa-plus fa-fw"></i> Agregar Numero</button>
						</div>
					</div>


				</div>
						<div class="header_box version_2">
								<h2><i class="fa fa-image"></i> Imagen </h2>
						</div>
						<div class="container marketing">
							<div class="row">
								<div class="col-md-9" id="ImagenesLugar">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Archivo Imagen</label>
												<input class="form-control" type="file" id="imagen_lugar1">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Descripcion</label>
												<textarea name="descripcion_imagen1" id="descripcion_imagen1" class="form-control" rows="1"></textarea>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-3">
									<button id="agregarImagen" class="btn btn-primary" style="margin-top: 32px;"><i class="fa fa-plus fa-fw"></i> Agregar Imagen</button>
								</div>
							</div>
						</div>
								
								
						<div class="header_box version_2">
							<h2><i class="fa fa-map-marker"></i>Ubicacion</h2>
						</div>
						<div class="container marketing">
							<div class="row">
									<div class="col-md-12">
										<div id="map" style="height:500px;"></div>
									</div>
							</div>
							<div class="row" style="margin-top: 15px;">
								<div class="col-md-6">
									<div class="form-group">
										<label>Latitud</label>
										<input type="text" id="longitud_lugar" class="form-control" disabled>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Longitud</label>
										<input type="text" id="latitud_lugar" class="form-control" disabled>
									</div>
								</div>
							</div>
						</div>
					
			<!-- /row-->
		
			</div>
			<!-- /row-->
			<div class="box_general padding_bottom" id="Farmacia">
				<center><h2>FARMACIA</h2></center>	
			
						<div class="header_box version_2">
							<h2><i class="fa fa-clock-o"></i>Horario</h2>
						</div>
					
						<div class="container marketing">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="styled-select">
									<select id="farmacia_horario1">
										<option>Desde</option>
										<option>1:00</option>
										<option>2:00</option>
										<option>3:00</option>
										<option>4:00</option>
										<option>5:00</option>
										<option>6:00</option>
										<option>7:00</option>
										<option>8:00</option>
										<option>9:00</option>
										<option>10:00</option>
										<option>11:00</option>
										<option>12:00</option>	
										<option>13:00</option>
										<option>14:00</option>
										<option>15:00</option>
										<option>16:00</option>
										<option>17:00</option>
										<option>18:00</option>
										<option>19:00</option>
										<option>20:00</option>
										<option>21:00</option>
										<option>22:00</option>
										<option>23:00</option>
										<option>24:00</option>
									</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="styled-select">
									<select id="farmacia_horario2">
									<option>Desde</option>
										<option>1:00</option>
										<option>2:00</option>
										<option>3:00</option>
										<option>4:00</option>
										<option>5:00</option>
										<option>6:00</option>
										<option>7:00</option>
										<option>8:00</option>
										<option>9:00</option>
										<option>10:00</option>
										<option>11:00</option>
										<option>12:00</option>	
										<option>13:00</option>
										<option>14:00</option>
										<option>15:00</option>
										<option>16:00</option>
										<option>17:00</option>
										<option>18:00</option>
										<option>19:00</option>
										<option>20:00</option>
										<option>21:00</option>
										<option>22:00</option>
										<option>23:00</option>
										<option>24:00</option>
									</select>
									</div>
								</div>
							</div>
						</div>

         
				
			</div>
			<br>
			<div class="header_box version_2">
				<h2><i class="fa fa-cog"></i>Caracteristicas</h2>
			</div>
		
			<div class="container marketing">
			<div class="row">
					<div class="col-lg-6">
						<div class="card ">
							<ul class="list-group list-group-flush">
								<div class="form-check-inline">
									<li class="list-group-item "><label class="form-check-label">
										<input type="checkbox" id="turno_farmacia" class="form-check-input" value="">Turno
									</label></li>
								</div>
									<li class="list-group-item "><div class="form-check-inline">
										<label class="form-check-label">
										<input type="checkbox" id="vacunas_farmacia" class="form-check-input" value="">Vacunas
										</label>
									</div></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="card ">
								<ul class="list-group list-group-flush">
								<li class="list-group-item "><div class="form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" id="servicio_farmacia" class="form-check-input"value="">Servicio de enfermeria
									</label>
								</div></li>
								<li class="list-group-item "><div class="form-check-inline">
									<label class="form-check-label">
										<input type="checkbox" id="entrega_farmacia" class="form-check-input" value="">Entrega a domiciolio
									</label>
								</div></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- /box_general-->
	
		<div class="box_general padding_bottom" id="Hotel">
				<center><h2>HOTEL</h2></center>
			<div class="header_box version_2">
				<h2><i class="fa fa-building"></i>Informacion</h2>
			</div>
			<div class="container marketing">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Categoria</label>
						<div class="styled-select">
						<select id="hotel_categoria">
							<option>Hotel</option>
							<option>Residecial</option>
							<option>Hostal</option>
							<option>Alojamiento</option>
						</select>
						</div>
					</div>
				</div>
	
			
					<div class="col-md-6">
						<div class="form-group">
							<label>Nivel</label>
							<div class="styled-select">
							<select id="hotel_nivel">
								<option>0</option>
								<option>1</option>
								<option>2</option>
								<option>3</option>
								<option>4</option>
								<option>5</option>
							</select>
							</div>
						</div>
					</div>
				</div>
         
				<div class="row">
			<div class="col-lg-4">
			<div class="card ">
					<ul class="list-group list-group-flush">
							<li class="list-group-item ">	<div class="form-check-inline">
					<label class="form-check-label">
						<input type="checkbox" id="hotel_parqueo" class="form-check-input" value="">Parqueo
				</label>
			</div></li>
					<li class="list-group-item ">	<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" id="hotel_piscina" class="form-check-input" value="">piscina
						</label>
					</div></li>
					<li class="list-group-item ">	<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" id="hotel_recreativa" class="form-check-input"value="">Area Recreativa 
						</label>
					</div></li>
					<li class="list-group-item "><div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" id="hotel_bar" class="form-check-input" value="">Bar
						</label>
					</div></li>
					<li class="list-group-item ">
						<div class="form-check-inline">
							<label class="form-check-label">
								<input type="checkbox" id="hotel_cable" class="form-check-input"value="">Cable
							</label>
						</div>
					</li>
			</ul>
	</div>
</div>
<div class="col-lg-4">
						<div class="card ">
							<ul class="list-group list-group-flush">
						<li class="list-group-item "><div class="form-check-inline">
								<label class="form-check-label">
									<input type="checkbox" id="hotel_internet" class="form-check-input"value="">Internet
								</label>
							</div></li>
							<li class="list-group-item "><div class="form-check-inline">
									<label class="form-check-label">
										<input type="checkbox"id="hotel_acondicionado" class="form-check-input"value="">Aire acondicionado
									</label>
								</div></li>
								<li class="list-group-item "><div class="form-check-inline">
										<label class="form-check-label">
											<input type="checkbox" id="hotel_desayuno" class="form-check-input"value="">Desayuno 
										</label>
									</div></li>
									<li class="list-group-item "><div class="form-check-inline">
											<label class="form-check-label">
												<input type="checkbox" id="hotel_gimnasio" class="form-check-input"value="">Gimnasio
											</label>
										</div></li>
										<li class="list-group-item "><div class="form-check-inline">
												<label class="form-check-label">
													<input type="checkbox" id="hotel_mascota" class="form-check-input"value="">Mascotas
												</label>
											</div></li>
							</ul>
							</div>
				</div>
				<div class="col-lg-4">
							<div class="card ">
								<ul class="list-group list-group-flush">
											<li class="list-group-item "><div class="form-check-inline">
													<label class="form-check-label">
														<input type="checkbox" id="hotel_spa" class="form-check-input"value="">Spa
													</label>
												</div></li>
												<li class="list-group-item "><div class="form-check-inline">
														<label class="form-check-label">
															<input type="checkbox" id="hotel_comedor" class="form-check-input"value="">Comedor
														</label>
													</div></li>
													<li class="list-group-item "><div class="form-check-inline">
															<label class="form-check-label">
																<input type="checkbox" id="hotel_servicio" class="form-check-input"value="">Servicio a la habitacion
															</label>
														</div></li>
														</ul>
														</div>
														</div>
		</div>
			<!-- /row-->
		
		</div>
		<!-- /box_general-->
		</div>
		<div>
			<div class="form-group">
					<div class="box_general padding_bottom" id="Restaurante">
					<center><h2>RESTAUTANT</h2></center>

			<div class="header_box version_2">
					<div class="header_box version_2">
							<h2><i class="fa fa-glass"></i>Servicios</h2>
						</div>
						<div class="container marketing">
							<div class="row" style="margin-top: 15px;">
								<div class="col-md-6">
									<div class="form-group">
										<label>Categoria Restaurante</label>
										<input type="text" id="categoria_restaurante" class="form-control">
									</div>
								</div>
							</div>
              <div class="row">
						<div class="col-lg-6">
						<div class="card " >
								<ul class="list-group list-group-flush">
										<li class="list-group-item ">	<div class="form-check-inline">
					<label class="form-check-label">
						<input type="checkbox" id="resto_parqueo" class="form-check-input" value="">Parqueo
				</label>
				</div></li>
						<li class="list-group-item ">	<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" id="resto_recreativo" class="form-check-input" value="">Recreativo
						</label>
					</div></li>
					<li class="list-group-item ">	<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" id="resto_fumadores" class="form-check-input"value="">Area fumadores 
						</label>
					</div></li>
			</ul>
			</div>
						</div>
					<div class="col-lg-6">
						<div class="card ">
								<ul class="list-group list-group-flush">
					<li class="list-group-item ">	<div class="form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" id="resto_servicio" class="form-check-input" value="">Auto servicio
						</label>
					</div></li>
					<li class="list-group-item ">	<div class="form-check-inline">
							<label class="form-check-label">
								<input type="checkbox" id="resto_internet" class="form-check-input"value="">Internet
							</label>
						</div></li>
						<li class="list-group-item ">	<div class="form-check-inline">
								<label class="form-check-label">
									<input type="checkbox" id="resto_reserva" class="form-check-input"value="">Reserva mesa
								</label>
							</div></li>
							</ul>
							</div>
							</div></div>
						</div>
					</div>
			<!-- /row-->
		
			
		</div>
	
		<!-- /box_general-->
		
	
		<!-- /box_general-->
		<p><button id="EnviarInfo" class="btn_1 medium">Guardar</button></p>
		</div>
		
	  <!-- /.container-fluid-->
   	</div>
    <!-- /.container-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © SPARKER 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Cerrar Sesion?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Estas seguro de cerrar sesion?.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="app/requestAJAX/cerrarSesion.request.php">Cerrar</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="assets/admin/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/admin/vendor/datatables/jquery.dataTables.js"></script>
    <script src="assets/admin/vendor/datatables/dataTables.bootstrap4.js"></script>
		<script src="assets/admin/vendor/jquery.selectbox-0.2.js"></script>
		<script src="assets/admin/vendor/retina-replace.min.js"></script>
		<script src="assets/admin/vendor/jquery.magnific-popup.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="assets/admin/js/admin.js"></script>
	<!-- Custom scripts for this page-->
		<script src="assets/admin/vendor/dropzone.min.js"></script>
		<script src="assets/admin/vendor/bootstrap-datepicker.js"></script>
		<script>$('input.date-pick').datepicker();</script>
	<!-- WYSIWYG Editor -->
		<script src="assets/admin/js/editor/summernote-bs4.min.js"></script>

		<script type="text/javascript" src="assets/admin/js/jquery.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE&callback=initMap" async defer></script>


		<script type="text/javascript">
		var cantContactos = 1;
		var cantImagenes = 1;

		var contactos = [];
		var imagenes = [];

		contactos.push({ tipo: $('#tipo_numero1'), numero: $('#numero_contacto1') });
		imagenes.push({ file: $('#imagen_lugar1'), desc: $('#descripcion_imagen1') }); 

		window.onload = function() {
			var categoria = $('#categoria_lugar').val();
			if(categoria == 'Farmacia') {
				$('#Farmacia').show();
				$('#Restaurante').hide();
				$('#Hotel').hide();
			} else if(categoria == 'Hotel') {
				$('#Farmacia').hide();
				$('#Restaurante').hide();
				$('#Hotel').show();
			} else if(categoria == 'Restaurante') {
				$('#Farmacia').hide();
				$('#Restaurante').show();
				$('#Hotel').hide();
			} else {
				$('#Farmacia').hide();
				$('#Restaurante').hide();
				$('#Hotel').hide();
			}
		}


		var marker;

		function initMap() {
				var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 15,
				center: {lat: -17.378833, lng: -66.165167} 
				});

				marker = new google.maps.Marker({
				map: map,
				draggable: true,
				animation: google.maps.Animation.DROP,
				position: {lat: -17.378833, lng: -66.165167}
				});
				marker.addListener('click', toggleBounce);

				marker.addListener( 'dragend', function (event)
				{
						//escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
						//document.getElementById("coordenadasEquipo").value = this.getPosition().lat()+","+ this.getPosition().lng();
						// console.log(this.getPosition().lat()+","+ this.getPosition().lng());
						$('#latitud_lugar').val(this.getPosition().lat());
						$('#longitud_lugar').val(this.getPosition().lng());
				});
		}

		// permite arrastar el marcador
		function toggleBounce() {
				if (marker.getAnimation() !== null) {
				marker.setAnimation(null);
				} else {
				marker.setAnimation(google.maps.Animation.BOUNCE);
				}
		}

		// captura el evento click sobre le marcador
		function funcionClick() {
				if (marker.getAnimation() != null) {
				marker.setAnimation(null);
				} else {
				marker.setAnimation(google.maps.Animation.BOUNCE);
				}
		}

		function mostrarCategoria() {
			var categoria = $('#categoria_lugar').val();
			if(categoria == 'Farmacia') {
				$('#Farmacia').show();
				$('#Restaurante').hide();
				$('#Hotel').hide();
			} else if(categoria == 'Hotel') {
				$('#Farmacia').hide();
				$('#Restaurante').hide();
				$('#Hotel').show();
			} else if(categoria == 'Restaurante') {
				$('#Farmacia').hide();
				$('#Restaurante').show();
				$('#Hotel').hide();
			} else {
				$('#Farmacia').hide();
				$('#Restaurante').hide();
				$('#Hotel').hide();
			}
		}

		$(document).on('click', '#agregarContacto', function() {
			cantContactos++;
			contactoContent = '<div class="row">';
			contactoContent += '<div class="col-md-6">';
			contactoContent += '<div class="form-group">';
			contactoContent += '<label>Tipo</label>';
			contactoContent += '<div class="styled-select">';
			contactoContent += '<select id="tipo_numero'+cantContactos+'" name="tipo_numero'+cantContactos+'">';
			contactoContent += '<option>Elija un Tipo</option>';
			contactoContent += '<option value="Celular">Celular</option>';
			contactoContent += '<option value="Fijo">Fijo</option>';
			contactoContent += '<option value="Whatsapp">Whatsapp</option>';
			contactoContent += '</select>';
			contactoContent += '</div>';
			contactoContent += '</div>';
			contactoContent += '</div>';
			contactoContent += '<div class="col-md-6">';
			contactoContent += '<div class="form-group">';
			contactoContent += '<label>Numero '+cantContactos+'</label>';
			contactoContent += '<input type="text" id="numero_contacto'+cantContactos+'" class="form-control" placeholder="Numero de Contacto '+cantContactos+'">';
			contactoContent += '</div>';
			contactoContent += '</div>';
			contactoContent += '</div>';

			$('#NumContactosLugar').append(contactoContent);

			var contacto = { tipo: $('#tipo_numero'+cantContactos), numero: $('#numero_contacto'+cantContactos) };
			contactos.push(contacto);
		});

		$(document).on('click', '#agregarImagen', function() {
			cantImagenes++;

			imagenContent = '<div class="row">';
			imagenContent += '<div class="col-md-6">';
			imagenContent += '<div class="form-group">';
			imagenContent += '<label>Archivo Imagen '+cantImagenes+'</label>';
			imagenContent += '<input class="form-control" type="file" id="imagen_lugar'+cantImagenes+'">';
			imagenContent += '</div>';
			imagenContent += '</div>';
			imagenContent += '<div class="col-md-6">';
			imagenContent += '<div class="form-group">';
			imagenContent += '<label>Descripcion</label>';
			imagenContent += '<textarea name="descripcion_imagen1" id="descripcion_imagen'+cantImagenes+'" class="form-control" rows="1"></textarea>';
			imagenContent += '</div>';
			imagenContent += '</div>';
			imagenContent += '</div>';
			
			$('#ImagenesLugar').append(imagenContent);

			var imagen = { file: $('#imagen_lugar'+cantImagenes), desc: $('#descripcion_imagen'+cantImagenes) };
			imagenes.push(imagen); 
		});

		$(document).on('click', '#EnviarInfo', function() {
			var form = new FormData();
			
			form.append("nombre_lugar", $('#nombre_lugar').val());
			form.append("direccion_lugar", $('#direccion_lugar').val());
			form.append("latitud_gps", $('#latitud_lugar').val());
			form.append("longitud_gps", $('#longitud_lugar').val());
			form.append("descripcion_lugar", $('#descripcion_lugar').val());
			form.append("logo", document.getElementById('logo_lugar').files[0]);
			form.append("categoria", $('#categoria_lugar').val());

			for (var x = 0; x < contactos.length; x++) {
				form.append("cont_tipo"+(x+1), $(contactos[x]["tipo"]).val());
				form.append("cont_num"+(x+1), $(contactos[x]["numero"]).val());
			}
			form.append("cantContactos", contactos.length);

			for (var y = 0; y < imagenes.length; y++) {
				form.append("imagen_url"+(y+1), $(imagenes[y]["file"]).prop('files')[0]);
				form.append("imagen_desc"+(y+1), $(imagenes[y]["desc"]).val());
				// console.log(document.getElementById('imagen_lugar'+(y+1)).files[0]);
				// console.log($(imagenes[y]["file"]).prop('files')[0]);
			}
			form.append("cantImagenes", imagenes.length);

			var categoria = $('#categoria_lugar').val();
			
			if(categoria == 'Farmacia') {
				form.append("farmacia_horario1", $('#farmacia_horario1').val());
				form.append("farmacia_horario2", $('#farmacia_horario2').val());
				
				form.append("farmacia_turno", $('#turno_farmacia').prop('checked'));
				form.append("farmacia_vacunas", $('#vacunas_farmacia').prop('checked'));
				form.append("farmacia_servicio", $('#servicio_farmacia').prop('checked'));
				form.append("farmacia_entrega", $('#entrega_farmacia').prop('checked'));
				// console.log($('#turno_farmacia').prop('checked'));
				// form.append()
			} else if(categoria == 'Hotel') {
				form.append("hotel_categoria", $('#hotel_categoria').val());
				form.append("hotel_nivel", $('#hotel_nivel').val());

				form.append("hotel_parqueo", $('#hotel_parqueo').prop('checked'));
				form.append("hotel_piscina", $('#hotel_piscina').prop('checked'));
				form.append("hotel_recreativa", $('#hotel_recreativa').prop('checked'));
				form.append("hotel_bar", $('#hotel_bar').prop('checked'));
				form.append("hotel_cable", $('#hotel_cable').prop('checked'));
				form.append("hotel_internet", $('#hotel_internet').prop('checked'));
				form.append("hotel_acondicionado", $('#hotel_acondicionado').prop('checked'));
				form.append("hotel_desayuno", $('#hotel_desayuno').prop('checked'));
				form.append("hotel_gimnasio", $('#hotel_gimnasio').prop('checked'));
				form.append("hotel_mascota", $('#hotel_mascota').prop('checked'));
				form.append("hotel_spa", $('#hotel_spa').prop('checked'));
				form.append("hotel_comedor", $('#hotel_comedor').prop('checked'));
				form.append("hotel_servicio", $('#hotel_servicio').prop('checked'));

			} else if(categoria == 'Restaurante') {
				form.append("resto_categoria", $('#categoria_restaurante').val());

				form.append("resto_parqueo", $('#resto_parqueo').prop('checked'));
				form.append("resto_recreativo", $('#resto_recreativo').prop('checked'));
				form.append("resto_fumadores", $('#resto_fumadores').prop('checked'));
				form.append("resto_servicio", $('#resto_servicio').prop('checked'));
				form.append("resto_internet", $('#resto_internet').prop('checked'));
				form.append("resto_reserva", $('#resto_reserva').prop('checked'));
			}

			$('#EnviarInfo').attr("disabled", true);
			
			$.ajax({
				type: "POST",
				url: "requestAJAX/publicarLugar.request.php",
				data: form,
				cache: false,
				contentType: false,
				processData: false,
				success: function (response) {
					if(response == 1) {
						$('#AJAXresponse').html('<div class="alert alert-success" role="alert">Lugar Agregado con exito!</div>');
						alertify
						.alert("Correcto", "Lugar Publicado con exito, su publicacion sera revisada en las siguientes 24 horas para ser publicada.", function(){
							alertify.success('Redirigiendo...');
							location.href = "administrar_lugar.php";
						});
					} else {
						$('#AJAXresponse').html('<div class="alert alert-error" role="alert">ERROR: '+response+'</div>');
					}
				}
			});


		});

		</script>
</body>
</html>
