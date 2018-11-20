<?php 
  include('helpers/class.Conexion.php');
  
  $_SESSION["usuario"] = array(
    'id' => 3,
    'nombre' => "Carlos Rodrigo"
  );

  $db = new Conexion();
  $db->charset();
  //--------------------------OBTENER DATOS DE LA TABLA LUGAR-----------------------------------
  //-------------OBTENER NOMBRE DEL LUGAR-----------------------------
  $idUsuario = $_SESSION["usuario"]["id"];
  $obtenerLugar = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario LIMIT 1");
  if($db->rows($obtenerLugar) > 0) {
    $resLugar = $db->recorrer($obtenerLugar);
  } else {
    header('Location: HoteleriaVacia.html');
  }
  //-------------OBTENER DIRECCION-----------------------------
  $obtenerDireccion = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario LIMIT 1");
  if($db->rows($obtenerDireccion) > 0) {
    $resDireccion = $db->recorrer($obtenerDireccion);
  } else {
    header('Location: HoteleriaVacia.html');
  }
  //-------------OBTENER DESCRIPCION-----------------------------
  $obtenerDescripcion = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario LIMIT 1");
  if($db->rows($obtenerDescripcion) > 0) {
    $resDescripcion = $db->recorrer($obtenerDescripcion);
  } else {
    header('Location: HoteleriaVacia.html');
  }
  //-------------OBTENER LONGITUD-----------------------------
  $obtenerLongitud = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario LIMIT 1");
  if($db->rows($obtenerLongitud) > 0) {
    $resLongitud = $db->recorrer($obtenerLongitud);
  } else {
    header('Location: HoteleriaVacia.html');
  }
  //-------------OBTENER LATITUD-----------------------------
  $obtenerLatitud = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario LIMIT 1");
  if($db->rows($obtenerLatitud) > 0) {
    $resLatitud = $db->recorrer($obtenerLatitud);
  } else {
    header('Location: HoteleriaVacia.html');
  }
  //-------------OBTENER LOGO-----------------------------
  $obtenerLogo = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario LIMIT 1");
  if($db->rows($obtenerLogo) > 0) {
    $resLogo = $db->recorrer($obtenerLogo);
  } else {
    header('Location: HoteleriaVacia.html');
  }
  


 ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Ansonika">
  <title>Administracion de Hoteleria</title>
	
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


  <link rel="stylesheet" type="text/css" href="estilo.css">




  <!-- Agregar la librería de Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE&callback=initMap" async defer></script>
    <script src="mis js/google/google-api.js"></script>
    <!--------------------ENLACE PARA EL CUADRO DE GOOGLE------------------------->
    <script src="cuadroGoogle.js"></script>
    


	
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
        
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="user-profile.html">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">Mi Perfil</span>
          </a>
        </li>
		
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistings" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Categorias</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMylistings">
            <li>
              <a href="Hoteleria.php">Hoteleria <span class="badge badge-pill badge-primary"></span></a>
            </li>
			<li>
              <a href="Restaurante.html">Restaurante<span class="badge badge-pill badge-success"></span></a>
            </li>
			<li>
              <a href="listings.html">Farmacia<span class="badge badge-pill badge-danger"></span></a>
            </li>
          </ul>
        </li>
		
		
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
       <!--------------------CERRAR CESION--------------------------------->
     <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar Cesion</a>
        </li>
      </ul>
    </div>
  </nav>


  <!-- /Navigation-->
  <div class="content-wrapper">
      <div class="container-fluid">
      <!-- -------------------------------------Lugar------------------------------------>
      <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-user"></i>Lugar</h2>
      </div>
      <center>
      <div class="row">
        <div class="col-md-4" style="padding-top: 30px;">
          <div class="form-group">
            <form>
              <img src="<?=$resLogo["logo"]?>" style="width: 100%;">
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModificarImg">Cambiar Imagen</button>
            </form>

            </div>
        </div>
        </center>
        
        <div class="col-md-12 add_top_30">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nombre del Negocio</label>
                <form method="POST">
                <input type="text" class="form-control" name="nombreNegocio" value="<?=$resLugar["nombre_lugar"]?>" id="nombreLugar" required="">
                </form>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Direccion</label>
                <input type="text" class="form-control" value="<?=$resDireccion["direccion"]?>" id="direccion" required="">
              </div>
            </div>
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Descripcion</label>
                <textarea id="descripcion" style="height:100px;"  class="form-control" placeholder="Personal info"><?=$resDescripcion["descripcion"]?></textarea>
              </div>
            </div>
          </div>
          <!-- /row-->
          <center>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Longitud</label>
                <input type="text" class="form-control" value="<?=$resLongitud["longitud_gps"]?>" id="longitud" required="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Latitud</label>
                <input type="text" class="form-control" value="<?=$resLatitud["latitud_gps"]?>" id="latitud" required="">
              </div>
            </div>
          </div>
          </center>
          <!-- -------------------------------------GOOGLE------------------------------------->
          <div>
            <div class="header_box version_2" style="width:300px;">
                <h2>
                    <label>Geolocalizacion:</label><br>
                </h2>                
            </div>
            <div class="row">
                <!-- Mapa de GOOGLE -->
                <div  id="map" style="width:8000px; height:500px; float: left"></div>
            </div>
            <div class="modal-footer modal-lg">
            </div>
        </div>
          <!-- /row-->
        </div>
        <input class="btn_1 medium" type="submit" name="btnGuardarLugar" value="Guardar">

      
    </div>
   <!-- -------------------------------------AREAS DISPONIBLES------------------------------------->
		<div class="box_general padding_bottom" style="overflow: hidden;">
			<div class="header_box version_2">
				<h2><i class="fa fa-file"></i>Areas Disponibles</h2>
			</div>
			
      <div class="tablaSwich" style="width: 50%; float: left;">
         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb"> Parqueo</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox" value="<?=$resChBParqueo["parqueo"]?>">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>
    
         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb"> Piscina</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Areas Recreativas</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Bar</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

      </div>

    <div class="tablaSwich" style="width: 50%; float: right;">
      <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Gimnasio</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Spa</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Comedor</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>
      </div>
		</div>

<!-- ---------------------SERVICIOS------------------------->
    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Servicios</h2>
      </div>
      
      <div class="tablaSwich" style="width: 60%">
         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">TV por Cable</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>
    
         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Internet</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Desayuno</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Servicio de Habitacion</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Aire Acondicionado</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

      </div>
    </div>

    <!-- ---------------------Permisos------------------------->
    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-file"></i>Permisos</h2>
      </div>
      
      <div class="tablaSwich" style="width: 60%">
         <li class="list-group-item">
          <table class="sw">
            <tr>
              <td>
                <label id="lb">Mascotas</label>
              </td>
              <td class="btnswich">
                <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

      </div>
    </div>


		<!---------------------------------------------------Datos para las habitaciones------------------------------------->
		
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-dollar"></i>Habitaciones</h2>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table id="pricing-list-container" style="width:100%;">
						<tr class="pricing-list-item">
							<td>
								<div class="row">
                  
									<div class="col-md-2">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Nombre" required="">
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Descripcion" required="">
										</div>
									</div>
                  
									<div class="col-md-2">
										<div class="form-group">
											<input type="number" class="form-control" placeholder="Precio"  min="0" required="">
										</div>
									</div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <table class="sw">
                         <tr>
                           <td>
                             <label id="lb">Sanitario</label>
                           </td>
                           <td class="btnswich">
                             <label class="switch">
                             <input type="checkbox">
                             <div class="slider round"></div>
                          </label>
                           </td>
                         </tr>
                       </table>
                    </div>
                  </div>

                  <div class="col-md-2">
                    <div class="form-group">
                      <table class="sw">
                         <tr>
                           <td>
                             <label id="lb">Frigobar</label>
                           </td>
                           <td class="btnswich">
                             <label class="switch">
                             <input type="checkbox">
                             <div class="slider round"></div>
                          </label>
                           </td>
                         </tr>
                       </table>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <form action="/file-upload" title="Click" class="dropzone"></form>
                      <center><label>Imagen de la Habitacion</label></center>
                      </div>
                  </div>

								</div>
							</td>
						</tr>
					</table>
					<a href="#" class="btn_1 gray" data-toggle="modal" data-target="#ModalHabitacion"><i class="fa fa-fw fa-plus-circle"></i>Añadir</a>
          <a href="#" class="btn_1 gray" data-toggle="modal" data-target="#ModalHabitacion"><i class="fa fa-fw fa-plus-circle"></i>Editar</a>
					</div>
			</div>
			<!-- /row-->
		</div>
		<!-- /box_general-->
		<p><a href="#0" class="btn_1 medium">Guardar</a></p>
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

    <!------------------------------MODAL PARA crear habitacion------------------------------>
    <div class="modal fade" id="ModalHabitacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Nueva Habitacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <table>
          <tr>
            <td>
              <div class="form-group">
                      <input type="text" class="form-control" placeholder="Nombre">
                    </div>
                  </div>
            </td>
            <td class="Habtd">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Descripcion">
              </div>
            </td>
          </tr>
        </table>

        <table>
          <tr>
            <td>
              <div class="form-group">
                <input type="number" class="form-control" placeholder="Precio"  min="0" style="width: 100px;">
              </div> 
            </td>
            <td class="Habtd">
               <label id="lb">Sanitario</label>
            </td>
            <td class="btnswich" style="padding-left: 20px;">
              <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
              </label>
            </td>
            <td class="Habtd">
              <label id="lb">Frigobar</label>
            </td>
            <td class="btnswich" style="padding-left: 20px;">
              <label class="switch">
                <input type="checkbox">
                <div class="slider round"></div>
              </label>
            </td>
          </tr>
        </table>
        <center>
          <table>
            <tr>
              <td>
                <div style="width: 300px;">
                    <div class="form-group">
                      <form action="/file-upload" class="dropzone"></form>
                      <center><label>Imagen de la Habitacion</label></center>
                      </div>
                  </div>
              </td>
            </tr>
          </table>
        </center>
                    
        </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary add-pricing-list-item" data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div>


    <!------------------------------fin modal habitacion------------------------------>
    <!------------------------------MODAL PARA MODIFICAR IMAGEN------------------------------>
    <div class="modal fade" id="ModificarImg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modificar Imagen</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          
            <div class="row">
              <div class="col-md-6">
                <div class="form-group" style="padding-left: 50px;">
                  <form action="Hoteleria.php" method="POST" enctype="multipart/form-data">
                    <br>
                    <img style="width: 400px;" src="<?=$resLogo["logo"]?>"><br><br>
                    
                    <input type="file" name="Imagen" required="">

                    
      
                    <div class="modal-footer" style="padding-left: 400px;">
                      <input type="submit" class="btn btn-secondary" data-dismiss="modal" name="btnAceptar" value="Cancelar">
                      <input type="submit" class="btn btn-primary" name="btnAceptar" value="Aceptar">
                    </div>

                  </form>
      
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>


    <!------------------------------MODAL PARA CERRAR CESION------------------------------>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Desea salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seguro que quiere cerrar cesion?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Aceptar</a>
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
	<script>
      $('.editor').summernote({
		fontSizes: ['10', '14'],
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough']],
			['fontsize', ['fontsize']],
			['para', ['ul', 'ol', 'paragraph']]
		  ],
        placeholder: 'Write here ....',
        tabsize: 2,
        height: 200
      });
    </script>
	
</body>
</html>
