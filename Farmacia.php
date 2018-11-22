<?php
    include('helpers/class.Conexion.php');

    // $_SESSION["usuario"] =array(
    //     'id' => 3, 'nombre' => "Carlos Rodrigo"
    // );
    $_SESSION["lugar"] =array(
        'id_lugar' => 1, 'nombre_lugar' => "Pollos Lopez"
    );
    $db = new Conexion();
    $db ->charset();
    // OBTENER datos LUGAR
    $idlugar = $_SESSION["lugar"]["id_lugar"];
    $obtenerlugar = $db->query("SELECT nombre_lugar FROM lugar  WHERE id_lugar = $idlugar");
    if($db->rows($obtenerlugar)>0){
        $reslugar = $db->recorrer($obtenerlugar);
    }

    // else{
    //     header('Location: FarmaciaVacia.html');
    // }
    // $obtenerdireccion = $db->query("SELECT direccion FROM lugar WHERE id_lugar = $idlugar LIMIT 1");
    $obtenerdireccion = $db->query("SELECT direccion FROM lugar WHERE id_lugar = $idlugar");
    if($db->rows($obtenerdireccion) > 0) {
        $resdireccion = $db->recorrer($obtenerdireccion);
    } 
    // else {
    //     header('Location: FarmaciaVacia.html');
    // }
    $obtenerdescripcion = $db->query("SELECT descripcion FROM lugar WHERE id_lugar = $idlugar");
    if($db->rows($obtenerdescripcion) > 0) {
        $resdescripcion = $db->recorrer($obtenerdescripcion);
    }
    // OBTENER LA LATITUD Y LONGITUD
    $obtenerlongitud = $db->query("SELECT longitud_gps FROM lugar WHERE id_lugar = $idlugar ");
    if($db->rows($obtenerlongitud) > 0) {
        $reslongitud = $db->recorrer($obtenerlongitud);
    }
    $obtenerlatitud = $db->query("SELECT latitud_gps FROM lugar  WHERE id_lugar = $idlugar ");
    if($db->rows($obtenerlatitud) > 0) {
        $reslatitud = $db->recorrer($obtenerlatitud);
    }
    // OBTENER HORARIO
    $obtenerhoraini = $db->query("SELECT SUBSTRING_INDEX (`horario`,'-',1) as horaini FROM farmacia WHERE lugar = $idlugar");
    if($db->rows($obtenerhoraini) > 0){
        $reshoraini = $db->recorrer($obtenerhoraini);
    }
    $obtenerhorafinal = $db->query("SELECT SUBSTRING_INDEX (`horario`,'-',-1) as horafinal FROM farmacia WHERE lugar = $idlugar");
    if($db->rows($obtenerhorafinal) > 0){
        $reshorafinal = $db->recorrer($obtenerhorafinal);
    }

    // OBTENER SERVICIOS OFRECIDOS
    $obtenervacunacion = $db->query("SELECT vacunas FROM farmacia WHERE lugar = $idlugar");
    if($db->rows($obtenervacunacion)>0){
        $resvacunacion = $db->recorrer($obtenervacunacion);
    }
    $obtenerturno = $db->query("SELECT turno FROM farmacia WHERE lugar = $idlugar");
    if($db->rows($obtenerturno)>0){
        $resturno = $db->recorrer($obtenerturno);
    }
    $obtenerenfermera = $db->query("SELECT servicio_enfermeria FROM farmacia WHERE lugar = $idlugar");
    if($db->rows($obtenerenfermera)>0){
        $resenfermera = $db->recorrer($obtenerenfermera);
    }
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
    <link rel="stylesheet" href="mis css/mis estilos/estilo.css">
    <link rel="stylesheet" href="mis js/timepicki/timepicki.css">
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
    <script src="mis js/google/google-api.js"></script>
    <!-- google maps script -->
    <script type="text/javascript">
        window.onload = function(){
        var pos_original = new google.maps.LatLng( -17.3895000, -66.1568000);
        var options = {
            zoom: 13,
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
            lng: resultado.latLng.lng()
        };

        marcador.setPosition(newPos);
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
    
    
    </script>
    <!-- google maps script final-->
    <!-- <script src="http://maps.google.com/maps?file=api&v=2&key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE"
    type="text/javascript"></script> -->

</head>
<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.html"><img src="../assets/admin/img/logo.png" data-retina="true" alt="" width="165" height="36"></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
                    <a  class="nav-link" href="user-profile.html">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Mi Perfil</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
                    <a  class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistings" data-parent="#mylistings">
                        <i class="fa fa-fw fa-list"></i>
                        <span class="nav-link-text">Categorias</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseMylistings">
                        <li>
                            <a href="Hoteleria.html">Hoteleria <span class="badge badge-pill badge-primary"></span></a>
                        </li>
                        <li>
                            <a href="Restaurante.html">Restaurante<span class="badge badge-pill badge-success"></span></a>
                        </li>
                        <li>
                            <a href="Farmacia.html">Farmacia<span class="badge badge-pill badge-danger"></span></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul  class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <!-- CERRAR SEcION -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Cerrar Secion</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navegacion -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Area para personalizacion -->
            <!-- -------------------------------------Lugar------------------------------------->
            <div class="box_general padding_bottom">
                <div class="header_box version_2">
                   <h2><i class="fa fa-ambulance"></i>Farmacia</h2>
                </div>
                <div class="row">
                    <div class="col-md-4" style="padding-top: 30px;">
                        <div class="form-group">
                            <center><label>Logo</label></center>
                            <form action="/file-upload" class="dropzone"></form>
                        </div>
                    </div>
                    <div class="col-md-8 add_top_30">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" class="form-control" style="width:200%" value="<?=$reslugar["nombre_lugar"]?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Direccion</label>
                            <input type="text" class="form-control" style="width:200%" value="<?=$resdireccion["direccion"]?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label>Descripcion</label>
                        <textarea style="height:100px;" class="form-control" placeholder="Personal info"><?=$resdescripcion["descripcion"]?></textarea>
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
                                                <?php if($resvacunacion["vacunas"]==0){?>
                                                    <input type="checkbox">
                                                <?php }
                                                else {?>
                                                    <input type="checkbox" checked>
                                                <?php } ?>                        
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
                                                <?php if($resturno["turno"]==0){?>
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
                                                <?php if($resturno["0"]==0){?>
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
                                                <input type="checkbox">
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
                        <input type="text" class="form-control" value="<?=$reslongitud["longitud_gps"]?>" id="longitud" required="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                        <label>Latitud</label>
                        <input type="text" class="form-control" value="<?=$reslatitud["latitud_gps"]?>" id="longitud" required="">
                        </div>
                    </div>
                    <div  id="map" style="width:8000px; height:500px; float: left"></div>
                    <button type="button" id="botonBorrar">Elimina marcadores</button> 
                </div>
                <div class="modal-footer modal-lg">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Guardar</button>
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
    <script src="mis js/timepicki/timepicki.js"></script>
    <script>
	    $('#timepicker1').timepicki();
        $('#timepicker2').timepicki();
    </script>
    <script src="assets/admin/vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>