<?php
  session_start();

  include('helpers/class.Conexion.php');
  
  $idLugar = $_GET["id"];

  $db = new Conexion();
  $db->charset();
  //--------------------------OBTENER DATOS DE LA TABLA LUGAR-----------------------------------
  //-------------OBTENER DATOS DEL LUGAR-----------------------------
  $idUsuario = $_SESSION["usuario"]["id"];

  $obtenerLugar = $db->query("SELECT * FROM lugar WHERE id_lugar = $idLugar LIMIT 1");
  if($db->rows($obtenerLugar) > 0) {
    $resLugar = $db->recorrer($obtenerLugar);
  }
  
  $idLugar = $resLugar["id_lugar"];

  //Obtener Imagenes Lugar

  $obtenerImagenes = $db->query("SELECT * FROM imagen WHERE lugar = $idLugar");
  if($db->rows($obtenerImagenes) > 0) {
    while($resImg = $db->recorrer($obtenerImagenes)) {
      $imagenes[] = array(
        'id' => $resImg["id_imagen"],
        'desc' => $resImg["descripcion"],
        'url' => $resImg["url"]
      );
    }
  }
   
   // var_dump($idLugar);
  $db->close();
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
          <a class="nav-link" href="Hoteleria.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-edit"></i>
            <span class="nav-link-text">Datos Hotel</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="imagenes_lugar.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-image"></i>
            <span class="nav-link-text">Imagenes Hotel</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="contactos_lugar.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-phone"></i>
            <span class="nav-link-text">Contactos Hotel</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="calificaciones_lugar.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-star"></i>
            <span class="nav-link-text">Ver Calificaciones</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="hoteleria_piezas.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-bed"></i>
            <span class="nav-link-text">Piezas Hotel</span>
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
        <?php
            if ($resLugar["activo"] == 1) {
              echo "<div class='alert alert-success' role='alert'>
                      Su Lugar se encuentra activo
                    </div>" ;
            }else{
              echo "<div class='alert alert-danger' role='alert'>
                      Su Lugar no encuentra activo
                    </div>" ;
            }
         ?>
  	
		<div class="box_general padding_bottom">
			<div class="header_box version_2">
				<h2><i class="fa fa-image"></i>Imagenes</h2>
			</div>
			<div class="row">
				<div class="col-md-12">
					<table id="pricing-list-container" style="width:100%;">
          <?php 
          if(isset($imagenes)):
            foreach($imagenes as $key => $value): ?>
            <tr class="pricing-list-item">
							<td>
								<div class="row">
									<div class="col-md-3">
										<img width="250" src="<?=$value["url"]?>">
									</div>
									<div class="col-md-5">
                      <textarea class="form-control" rows="1"><?=$value["desc"]?></textarea>
									</div>
                  
									<div class="col-md-4">
                    <div style="margin-top: 10px;">
                      <a href="#" class="btn_1 gray" data-toggle="modal" data-target="#ModalHabitacion"><i class="fa fa-fw fa-edit"></i>Editar</a>
                      <a href="#" class="btn_1 gray" data-toggle="modal" data-target="#ModalHabitacion"><i class="fa fa-fw fa-times"></i>Eliminar</a>
                    </div>
									</div>

								</div>
							</td>
						</tr>
          <?php 
            endforeach;
          endif;
          ?>
            <tr class="pricing-list-item">
							<td>
								<div class="row">
									<div class="col-md-3">
										<img width="250" src="<?=$value["url"]?>">
									</div>
									<div class="col-md-5">
                      <textarea class="form-control" rows="1"><?=$value["desc"]?></textarea>
									</div>
                  
									<div class="col-md-4">
                    <div style="margin-top: 10px;">
                      <a href="#" class="btn_1 gray" data-toggle="modal" data-target="#ModalHabitacion"><i class="fa fa-fw fa-edit"></i>Editar</a>
                      <a href="#" class="btn_1 gray" data-toggle="modal" data-target="#ModalHabitacion"><i class="fa fa-fw fa-times"></i>Eliminar</a>
                    </div>
									</div>

								</div>
							</td>
						</tr>
					</table>
					
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
                  <br>
                  <img style="width: 400px;" src="<?=$resLugar["logo"]?>"><br><br>
                  <input type="file" name="fileImagen" required="">
    
                  <div class="modal-footer" style="padding-left: 400px;">
                    <input type="submit" class="btn btn-secondary" data-dismiss="modal" name="btnCancelar" value="Cancelar">
                    <input type="submit" class="btn btn-primary" name="btnAceptar" value="Aceptar" >
                  </div>
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
            <a class="btn btn-primary" href="app/requestAJAX/cerrarSesion.request.php">Aceptar</a>
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
	<script>

      var marker;
      function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: {lat: <?=$resLugar["latitud_gps"]?>, lng: <?=$resLugar["longitud_gps"]?>}
          });
          marker = new google.maps.Marker({
          map: map,
          draggable: true,
          animation: google.maps.Animation.DROP,
          position: {lat: <?=$resLugar["latitud_gps"]?>, lng: <?=$resLugar["longitud_gps"]?>}
          });
          marker.addListener('click', toggleBounce);
          marker.addListener( 'dragend', function (event)
          {
              //escribimos las coordenadas de la posicion actual del marcador dentro del input #coords
              // document.getElementById("coordenadasEquipo").value = this.getPosition().lat()+","+ this.getPosition().lng();
              $('#latitud').val(this.getPosition().lat());
              $('#longitud').val(this.getPosition().lng());
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

      google.maps.event.addListener( map, "click", function(ele) {
          // codigo que crea el marcador
          new google.maps.Marker({
              map: map
          })
      });

    </script>
	
</body>
</html>
