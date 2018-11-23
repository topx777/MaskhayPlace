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

  $obtenerFarmacia = $db->query("SELECT * FROM farmacia WHERE lugar = $idLugar LIMIT 1");
  $resFarmacia = $db->recorrer($obtenerFarmacia);

   // OBTENER HORARIO
   $obtenerhoraini = $db->query("SELECT SUBSTRING_INDEX (`horario`,'-',1) as horaini FROM farmacia WHERE lugar = $idLugar LIMIT 1");
   if($db->rows($obtenerhoraini) > 0){
       $reshoraini = $db->recorrer($obtenerhoraini);
   }
   $obtenerhorafinal = $db->query("SELECT SUBSTRING_INDEX (`horario`,'-',-1) as horafinal FROM farmacia WHERE lugar = $idLugar LIMIT 1");
   if($db->rows($obtenerhorafinal) > 0){
       $reshorafinal = $db->recorrer($obtenerhorafinal);
   }
  
  // var_dump($idLugar);

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Equipo A">
    <title>Administrador Farmacia</title>

    <!-- Favicons -->
    <link rel="shortcut icon" href="assets/admin/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/admin/img/apple-touch-icon-57x57-precomposed.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/admin/img/apple-touch-icon-72x72-precomposed.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/admin/img/apple-touch-icon-114x114-precomposed.png" type="image/x-icon">
    <link rel="apple-touch-icon" href="assets/admin/img/apple-touch-icon-144x144-precomposed.png" type="image/x-icon">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/admin/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Main styles -->
    <link rel="stylesheet" href="assets/admin/css/admin.css">
    <!-- Icon fonts -->
    <link rel="stylesheet" href="assets/admin/vendor/font-awesome/css/font-awesome.min.css" type="text/css">
    <!-- Plugin styles -->
    <link rel="stylesheet" href="assets/admin/vendor/datatables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/admin/vendor/dropzone.css">
    <link rel="stylesheet" href="assets/admin/css/date_picker.css">
    <!-- Your custom styles -->
    <link rel="stylesheet" href="assets/admin/css/custom.css">
    <!-- WYSIWYG Editor -->
    <link rel="stylesheet" href="assets/admin/js/editor/summernote-bs4.css">
    <!-- Estilos propios -->
    <link rel="stylesheet" href="assets/admin/vendor/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/admin/css/estilo.css">
    <link rel="stylesheet" href="assets/admin/css/timepicki.css">
    <style> 
  	  #map {
        height: 100%;
      }
     
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
	</style> 
    <!-- scripts previos -->
    <!-- Agregar la librería de Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE&callback=initMap" async defer></script>
    <!-- <script src="mis js/google/google-api.js"></script> -->
    <!-- google maps script -->
    <script type="text/javascript">
        window.onload = function(){
        var pos_original = new google.maps.LatLng(<?=$resLugar["latitud_gps"]?>, <?=$resLugar["longitud_gps"]?>);
        var options = {
            zoom: 16,
            center: pos_original,
            mapTypeId: google.maps.MapTypeId.Mapa,
            panControl: false,
              zoomControl: false,
              mapTypeControl: true,
              scaleControl: false,
              streetViewControl: true,
              overviewMapControl: false
        };
        
        var map = new google.maps.Map(document.getElementById('map'), options);
    
    var contador = 0;
    var listo = false;
    var marcador = new google.maps.Marker({
        position: pos_original,
        map: map,
        draggable:true,
        animation: google.maps.Animation.DROP,
    });
    google.maps.event.addListener(map, 'click', function(resultado) 
    {
        contador++;
        var cadena = "Marcador :" + contador;
        console.log("click "+contador+" en lat:"+resultado.latLng.lat()+" , lng:"+resultado.latLng.lng());
        // 
        var newPos = {
            lat: resultado.latLng.lat(),
            lng: resultado.latLng.lng(),
        };

        marcador.setPosition(newPos);
        $('#latitud').val(resultado.latLng.lat());
        $('#longitud').val(resultado.latLng.lng());
        // map.setCenter(newPos);
        // gernera_marcador(resultado.latLng.lat(),resultado.latLng.lng(),contador);
        // contador++;
    });
    var array_marcadores = new Array();

        function gernera_marcador(lat,lng,numero)
        {  
            var cadena="soy el marcador nº ";
            cadena+=numero;
            var marcador = new google.maps.Marker({
                position: new google.maps.LatLng(lat,lng),
                map: map,
                draggable:true,
                title: cadena,
                animation: google.maps.Animation.DROP,
                identificador: numero
            });
            //apilamos marcador
            array_marcadores = new Array;
            array_marcadores.push(marcador);
    
    
            //añadimos evento click en el marcador
            google.maps.event.addListener(marcador, 'click', function()
            {
        
                for(var a=0;a<array_marcadores.length;a++)
                    {
                        if(array_marcadores[a]['identificador'] == this.identificador)
                        {
                            array_marcadores[a].setMap(null);  //borramos el marcador del mapa
                            array_marcadores.splice(a, 1);	   //borramos el marcador de nuestro array	
                        }
                    }
            });
            listo = true;
        }
    
    //para comprovar que se van guardando pondremos un evento 'rightclick' en el mapa que nos 
    //muestre los valores del array
    google.maps.event.addListener(map, 'rightclick', function() 
    {
    console.log('----------------------------------');
    for(var a=0;a<array_marcadores.length;a++)
        {
            console.log(
                "posición array : "+a+", identificador :"+ array_marcadores[a]['identificador']+", lat:"+array_marcadores[a].position.lat()+", lon :"+array_marcadores[a].position.lng()
                );
        }
    });
    
    //montamos evento click en el boton para que borre todos los marcadores
    //funcion para limpiar todos los marcadores del mapa
        function eliminaMarcadores()
        {	
            console.log('Borrando todos los marcadores');
            for(a in array_marcadores)
            {
                array_marcadores[a].setMap(null);
            }
            array_marcadores = [];
        }
        //añadimos la función al boton con hooo... un evento en el boton
        document.getElementById('botonBorrar').addEventListener('click',eliminaMarcadores,false); //*******************************************************************************************
    
    };
    
    // evento click para cambiode de datos latlng
    </script>
    <!-- google maps script final-->
    <!-- <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE"
    type="text/javascript"></script> -->

</head>
<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation -->
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
            <span class="nav-link-text">Datos Farmacia</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link"  href="imagenes_farmacia.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-image"></i>
            <span class="nav-link-text">Imagenes Farmacia</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="contactos_farmacia.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-phone"></i>
            <span class="nav-link-text">Contactos Farmacia</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="calificaciones_farmacia.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-star"></i>
            <span class="nav-link-text">Ver Calificaciones</span>
          </a>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="Productos.php?id=<?=$idLugar?>">
            <i class="fa fa-fw fa-bed"></i>
            <span class="nav-link-text">Productos Farmacia</span>
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
    <!-- Navegacion -->
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
            <!-- Area para personalizacion -->
            <!-- -------------------------------------Lugar------------------------------------->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                   <h2><i class="fa fa-ambulance"></i>Farmacia</h2>
                </div>
                <div class="row">
                <!-- LOGO -->
                <center>
                <div class="row">
                    <div class="col-md-4" style="padding-top: 30px;">
                    <div class="form-group">
                        <form>
                        <img src="<?=$resLugar["logo"]?>" style="width: 100%;">
                        <input type="file" name="fileImagen" id="logo">
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#ModificarImg">Cambiar Imagen</button>
                        </form>
                    </div>
                </div>
                </center>
                    <div class="col-md-8 add_top_30">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" style="width:200%" value="<?=$resLugar["nombre_lugar"]?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" class="form-control" style="width:200%" value="<?=$resLugar["direccion"]?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Descripcion</label>
                        <textarea style="height:100px;" class="form-control" placeholder="Personal info"><?=$resLugar["descripcion"]?></textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">          
                            <label>Horario</label><br>
                            <label style="margin-right: 300px">De las</label><label>A las</label>
                            <div class="input-group" style="width:800px">
                                <input id="timepicker1" type="text" name="timepicker1" style="margin-right: 180px" value="<?=$reshoraini["horaini"]?>"/>
                                <input id="timepicker2" type="text" name="timepicker2" style="margin-right: 180px" value="<?=$reshorafinal["horafinal"]?>"/>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /row -->
            </div>
            <!-- final de lugar -->
            <!-- servicios panel -->
             <div class="box_general padding_bottom">
                <div class="row">                            
                    <div class="col-md-12 add_top_30">
                        <div class="header_box version_2">
                            <h2><i class="fa fa-file"></i>Sevicios Ofrecidos</h2>
                        </div>
                        <div class="tablaSwich" style="width: 60%">
                            <li class="list-group-item">
                                <table class="sw">
                                    <tr>
                                        <td>
                                            <label id="lb">Vacunacion</label>
                                        </td>
                                        <td class="btnswich">
                                            <label class="switch">
                                            <input type="checkbox" id="vacunas" name="ChBParqueo" <?=$resFarmacia["vacunas"] == 1 ? "checked" : ""?>>                     
                                                <!-- <input type="checkbox" checked> -->
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
                                            <label id="lb">Turno</label>
                                        </td>
                                        <td class="btnswich">
                                            <label class="switch">
                                                <?php if($resFarmacia["turno"]==0){?>
                                                    <input type="checkbox">
                                                <?php }
                                                else {?>
                                                    <input type="checkbox" checked>
                                                <?php } ?>    
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
                                            <label id="lb">Servicio de enfermeria</label>
                                        </td>
                                        <td class="btnswich">
                                            <label class="switch">
                                                <?php if($resFarmacia["servicio_enfermeria"]==0){?>
                                                    <input type="checkbox">
                                                <?php }
                                                else {?>
                                                    <input type="checkbox" checked>
                                                <?php } ?>
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
                                            <label id="lb">Entrega a domicilio</label>
                                        </td>
                                        <td class="btnswich">
                                            <label class="switch">
                                                <?php if($resFarmacia["entrega_domicilio"]==0){?>
                                                    <input type="checkbox">
                                                <?php }
                                                else {?>
                                                    <input type="checkbox" checked>
                                                <?php } ?>
                                                <div class="slider round"></div>
                                            </label>
                                        </td>
                                    </tr>
                                </table>
                            </li>
                        </div>
                    </div>  
                </div>  
            <!-- /pading buton     -->
            </div>
            <!-- sevicios panel fin -->
            
            <!-- panel mapa de google -->
            <div class="box_general padding_bottom">
                <div class="header_box version_2" style="width:300px;">
                    <h2>
                        <label>Geolocalizacion:</label><br>
                    </h2>                
                </div>
                <div class="row">
                    <!-- Mapa de GOOGLE -->
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Longitud</label>
                        <input type="text" class="form-control" value="<?=$resLugar["longitud_gps"]?>" id="longitud" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Latitud</label>
                        <input type="text" class="form-control" value="<?=$resLugar["latitud_gps"]?>" id="latitud" required="">
                        </div>
                    </div>
                    <div  id="map" style="width:8000px; height:500px; float: left"></div> 
                </div>
                <!-- /box_general-->
                <div class="modal-footer modal-lg">
                    <input type="hidden" id="idLugar" value="<?=$idLugar?>">
                    <p><button id="updateLugar" class="btn_1 medium">Guardar</button></p>
                </div>
            </div>
            <!-- fin panel mapa de google  -->
            
        <!-- /container-fluid -->
        </div>
    <!-- container-wrapper -->
    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © SPARKER 2018</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!------------------------------fin modal farmacia------------------------------>
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
    <!-- MODAL PARA CERRAR CESION -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JaveScript -->
    <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript -->
    <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript -->
    <script src="assets/admin/vendor/chart.js/Chart.min.js"></script>
    <script src="assets/admin/vendor/datatables/jquery.dataTables.js"></script>
    <script src="assets/admin/vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="assets/admin/vendor/jquery.selectbox-0.2.js"></script>
    <script src="assets/admin/vendor/retina-replace.min.js"></script>
    <script src="assets/admin/vendor/jquery.magnific-popup.min.js"></script>
    <!-- Custom scripts for all pages -->
    <script src="assets/admin/js/admin.js"></script>
    <!-- Custom scripts for this page -->
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
    <!-- Mis propios scripts -->
    <script src="assets/admin/js/timepicki.js"></script>
    <script>
	    $('#timepicker1').timepicki();
        $('#timepicker2').timepicki();
    </script>
    <script src="assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- mis peticiones -->
    <script>
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
       
        form.append('vacunas', $('#vacunas').val());
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
                setTimeout(() => {
                  location.href = "administrar_lugar.php";
                }, 3000);
              });
            } else {
					  	$('#AJAXresponse').html('<div class="alert alert-danger" role="alert">ERROR: '+response+'</div>');
            }

            // console.log(response);
          }
        });

      });
    </script>
    <!-- fin de mis peticiones -->
</body>
</html>