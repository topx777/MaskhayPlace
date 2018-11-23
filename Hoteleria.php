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

  $obtenerHotel = $db->query("SELECT * FROM hotel WHERE lugar = $idLugar LIMIT 1");
  $resHotel = $db->recorrer($obtenerHotel);
  
  // var_dump($idLugar);

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
  
	<!-- JavaScript -->
	<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>

  <link rel="stylesheet" href="estilo.css">

  <!-- Agregar la librería de Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE"></script>
	
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
                      Su pagina se encuentra activa
                    </div>" ;
            }else{
              echo "<div class='alert alert-danger' role='alert'>
                      Su pagina no encuentra activa
                    </div>" ;
            }
         ?>
      <!-- -------------------------------------Lugar------------------------------------>
      <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-user"></i>Lugar</h2>
      </div>
            
      <div class="AJAXresponse"></div>

      <div class="row">
        <div class="col-md-4" style="padding-top: 30px;">
          <div class="form-group">
              <img src="<?=$resLugar["logo"]?>" style="width: 100%;">
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModificarImg">Cambiar Imagen</button>
            </div>
        </div>
        
        <div class="col-md-12 add_top_30">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nombre del Negocio</label>
                <input type="text" class="form-control" name="nombreNegocio" value="<?=$resLugar["nombre_lugar"]?>" id="lugar_nombre">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Direccion</label>
                <input type="text" class="form-control" value="<?=$resLugar["direccion"]?>" id="lugar_direccion">
              </div>
            </div>
          </div>
          <!-- /row-->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Descripcion</label>
                <textarea id="lugar_descripcion" style="height:100px;"  class="form-control" placeholder="Descripcion Lugar"><?=$resLugar["descripcion"]?></textarea>
              </div>
            </div>
          </div>
          <!-- /row-->
       
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Latitud</label>
                <input type="text" class="form-control" value="<?=$resLugar["latitud_gps"]?>" id="latitud" required="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Longitud</label>
                <input type="text" class="form-control" value="<?=$resLugar["longitud_gps"]?>" id="longitud" required="">
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
      
    </div>

    <!-- Categoria y Nivel -->
    <div class="box_general padding_bottom">
      <div class="header_box version_2">
        <h2><i class="fa fa-cog"></i>Caracteristicas HOTEL</h2>
      </div>
          
      <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="hotel_categoria">Categoria</label>
              <select id="hotel_categoria" class="form-control">
                <option <?=$resHotel["categoria"] == 'Hotel' ? "selected" : ""?>>Hotel</option>
                <option <?=$resHotel["categoria"] == 'Hostal' ? "selected" : ""?>>Hostal</option>
                <option <?=$resHotel["categoria"] == 'Residencial' ? "selected" : ""?>>Residencial</option>
                <option <?=$resHotel["categoria"] == 'Alojamiento' ? "selected" : ""?>>Alojamiento</option>
              </select>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="hotel_nivel">Nivel</label>
              <select id="hotel_nivel" class="form-control">
                <option <?=$resHotel["nivel"] == 0 ? "selected" : ""?>>0</option>
                <option <?=$resHotel["nivel"] == 1 ? "selected" : ""?>>1</option>
                <option <?=$resHotel["nivel"] == 2 ? "selected" : ""?>>2</option>
                <option <?=$resHotel["nivel"] == 3 ? "selected" : ""?>>3</option>
                <option <?=$resHotel["nivel"] == 4 ? "selected" : ""?>>4</option>
                <option <?=$resHotel["nivel"] == 5 ? "selected" : ""?>>5</option>
              </select>
            </div>
          </div>
      </div>

    </div>
		<!-- /box_general-->

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
                <input type="checkbox" id="parqueo" name="ChBParqueo" <?=$resHotel["parqueo"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="piscina" <?=$resHotel["piscina"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="recreativa" <?=$resHotel["area_recreativa"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="bar" <?=$resHotel["bar"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="gimnasio" <?=$resHotel["gimnasio"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="spa" <?=$resHotel["spa"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="comedor" <?=$resHotel["comedor"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="cable" <?=$resHotel["cable"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="internet" <?=$resHotel["internet"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="desayuno" <?=$resHotel["desayuno"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="servicio" <?=$resHotel["servicio_habitacion"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="acondicionado" <?=$resHotel["aire_acondicionado"] == 1 ? "checked" : ""?>>
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
                <input type="checkbox" id="mascota" <?=$resHotel["mascota"] == 1 ? "checked" : ""?>>
                <div class="slider round"></div>
             </label>
              </td>
            </tr>
          </table>
         </li>

      </div>
    </div>
		<!-- /box_general-->
    <input type="text" id="idLugar" value="<?=$idLugar?>">
		<p><button id="updateLugar" class="btn_1 medium">Guardar</button></p>
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
                    <input type="file" name="fileImagen" id="logo">
      
                    <div class="modal-footer" style="padding-left: 400px;">
                      <button class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
  window.onload = function() {
    initMap();
  }

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

      // google.maps.event.addListener( map, "click", function(ele) {
      //     // codigo que crea el marcador
      //     new google.maps.Marker({
      //         map: map
      //     })
      // });

      $(document).on('click', '#updateLugar', function() {
        form = new FormData();
        
        // console.log($('#logo').prop('files')[0]);
        form.append('id_lugar', $('#idLugar').val());
        form.append('nombre_lugar', $('#lugar_nombre').val());
        form.append('direccion_lugar', $('#lugar_direccion').val());
        form.append('descripcion_lugar', $('#lugar_descripcion').val());
        form.append('latitud_gps', $('#latitud').val());
        form.append('longitud_gps', $('#longitud').val());
        if($('#logo').prop('files')[0] != undefined) {
          form.append('logo', $('#logo').prop('files')[0]);
        }
        form.append('hotel_categoria', $('#hotel_categoria').val());
        form.append('hotel_nivel', $('#hotel_nivel').val());
        form.append('hotel_parqueo', $('#parqueo').val());
        form.append('hotel_piscina', $('#piscina').val());
        form.append('hotel_recreativa', $('#recreativa').val());
        form.append('hotel_bar', $('#bar').val());
        form.append('hotel_gimnasio', $('#gimnasio').val());
        form.append('hotel_spa', $('#spa').val());
        form.append('hotel_comedor', $('#comedor').val());
        form.append('hotel_cable', $('#cable').val());
        form.append('hotel_internet', $('#piscina').val());
        form.append('hotel_desayuno', $('#desayuno').val());
        form.append('hotel_servicio', $('#servicio').val());
        form.append('hotel_acondicionado', $('#acondicionado').val());
        form.append('hotel_mascota', $('#mascota').val());

        $.ajax({
          type: "POST",
          url: "app/requestAJAX/modificarHotel.request.php",
          data: form,
          cache: false,
          contentType: false,
          processData: false,
          success: function (response) {

            if(response == 1) {
              $('#AJAXresponse').html('<div class="alert alert-success" role="alert">Lugar Modificado con exito!</div>');
              alertify
              .alert("Correcto", "Lugar Modificado con exito.", function(){
                alertify.success('Redirigiendo...');
                location.href = "administrar_lugar.php";
              });
            } else {
					  	$('#AJAXresponse').html('<div class="alert alert-error" role="alert">ERROR: '+response+'</div>');
            }

            // console.log(response);
          }
        });

      });

    </script>
	
</body>
</html>
