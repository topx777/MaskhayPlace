<?php
session_start();

if(!isset($_SESSION["admin"])) {
    header('Location: login_admin.php');
}

include('../helpers/class.Conexion.php');
$db = new Conexion();
$db->charset();

$contarTodos = $db->query("SELECT COUNT(*) FROM lugar");
$cantTodos = $db->recorrer($contarTodos)[0];
$contarPendientes = $db->query("SELECT COUNT(*) FROM lugar WHERE estado IS NULL");
$cantPendientes = $db->recorrer($contarPendientes)[0];
$contarActivos = $db->query("SELECT COUNT(*) FROM lugar WHERE estado = 'Aceptado'");
$cantActivos = $db->recorrer($contarActivos)[0];
$contarRechazados = $db->query("SELECT COUNT(*) FROM lugar WHERE estado = 'Rechazado'");
$cantRechazados = $db->recorrer($contarRechazados)[0];

$obtenerLugares = $db->query("SELECT * FROM lugar WHERE estado = 'Aceptado'");
if($db->rows($obtenerLugares) > 0) {
  while($resLugar = $db->recorrer($obtenerLugares)) {
    $idUsuario = $resLugar["usuario"];
    $obtenerUsu = $db->query("SELECT nombre FROM usuarioregistrado WHERE id_usuarioregistrado = $idUsuario");
    $resUsuario = $db->recorrer($obtenerUsu);
    $lugares[] = array(
      'id' => $resLugar["id_lugar"],
      'nombre' => $resLugar["nombre_lugar"],
      'usuario' => $resUsuario["nombre"],
      'logo' => $resLugar["logo"],
      'categoria' => $resLugar["categoria"],
      'estado' => $resLugar["estado"]
    );
  }
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
  <title>Panel de Administracion</title>
	
  <!-- Favicons-->
  <link rel="shortcut icon" href="../assets/admin/img/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" type="image/x-icon" href="../assets/admin/img/apple-touch-icon-57x57-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="../assets/admin/img/apple-touch-icon-72x72-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="../assets/admin/img/apple-touch-icon-114x114-precomposed.png">
  <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="../assets/admin/img/apple-touch-icon-144x144-precomposed.png">
	
  <!-- Bootstrap core CSS-->
  <link href="../assets/admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Main styles -->
  <link href="../assets/admin/css/admin.css" rel="stylesheet">
  <!-- Icon fonts-->
  <link href="../assets/admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Plugin styles -->
  <link href="../assets/admin/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Your custom styles -->
  <link href="../assets/admin/css/custom.css" rel="stylesheet">
  <!-- JavaScript -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/alertify.min.js"></script>

  <!-- CSS -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/alertify.min.css"/>
  <!-- Default theme -->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.11.2/build/css/themes/default.min.css"/>
	<style>
  #map {
    height: 300px;
  }
  </style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-default fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html"><img src="../assets/admin/img/logo.png" data-retina="true" alt="" width="165" height="36"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse" data-toggle="collapse" href="#collapseMylistings" data-parent="#mylistings" aria-expanded="true">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Publicaciones Lugar</span>
          </a>
          <ul class="sidenav-second-level" id="collapseMylistings">
            <li>
              <a href="inicio_admin.php">Todos <span class="badge badge-pill badge-primary"><?=$cantTodos?></span></a>
            </li>
            <li>
              <a href="pendientes_lugares.php">Pendientes <span class="badge badge-pill badge-warning"><?=$cantPendientes?></span></a>
            </li>
            <li>
              <a href="activos_lugares.php">Activos <span class="badge badge-pill badge-success"><?=$cantActivos?></span></a>
            </li>
			      <li>
              <a href="rechazados_lugares.php">Rechazados <span class="badge badge-pill badge-danger"><?=$cantRechazados?></span></a>
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
      <ul class="navbar-nav ml-auto">

        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Cerrar sesion</a>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
		<div class="box_general">
			<div class="header_box">
				<h2 class="d-inline-block">Lista de negocios: Todos</h2>
				<div class="filter">
					<select name="orderby" class="selectbox">
						<option value="Any status">Cualquier Estatus</option>
						<option value="Approved">Aceptado</option>
						<option value="Pending">Pendiente</option>
						<option value="Cancelled">Cancelado</option>
					</select>
				</div>
			</div>
			<div class="list_general">
				<ul>
        <?php
      if(isset($lugares)) {
        foreach ($lugares as $key => $lugar) {
        ?>
          <li>
            <figure><img src="../<?=$lugar["logo"]?>" alt=""></figure>
            <h4><?=$lugar["nombre"]?> <i class="pending <?php if($lugar["estado"] == 'Rechazado') { echo "bg-danger"; } else if ($lugar["estado"] == 'Aceptado') { echo "bg-success"; } ?>"><?=$lugar["estado"] != null ? $lugar["estado"] : "Pendiente"?></i></h4>
            <ul class="booking_list">
              <li><strong>Usuario</strong> <?=$lugar["usuario"]?></li>
              <li><strong>Categoria</strong> <?=$lugar["categoria"]?></li>
            </ul>
            <p><button data-toggle="modal" data-target="#observacionesNegocio" class="btn_1 gray" data-idl="<?=$lugar["id"]?>"><i class="fa fa-fw fa-envelope"></i> Observaciones</button><button data-toggle="modal" data-target="#infoNegocioModal" class="btn_1 gray" data-idl="<?=$lugar["id"]?>"> <i class="fa fa-fw fa-info"></i> Ver Detalles</button></p>
            <ul class="buttons">
              <li><button onclick="aprobarLugar(<?=$lugar["id"]?>);" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Aprobar</button></li>
              <li><button onclick="rechazarLugar(<?=$lugar["id"]?>);" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Rechazar</button></li>
            </ul>
          </li>
        <?php
        } 
      } else {
        echo '<h2>No hay lugares Activos</h2>';        
      }
        ?>
					<!-- <li>
						<figure><img src="../assets/admin/img/item_2.jpg" alt=""></figure>
						<h4>Abel Lopez <i class="cancel">Cancelado</i></h4>
						<ul class="booking_list">
							<li><strong>Booking date</strong> 11 November 2017</li>
							<li><strong>Booking details</strong> 2 People</li>
							<li><strong>Client</strong> Mark Twain</li>
						</ul>
						<p><a href="#0" class="btn_1 gray"><i class="fa fa-fw fa-envelope"></i> Enviar mensaje</a></p>
						<ul class="buttons">
							<li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Aceptar</a></li>
							<li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar</a></li>
						</ul>
					</li>
					<li>
						<figure><img src="../assets/admin/img/item_3.jpg" alt=""></figure>
						<h4>Grover Mamani <i class="approved">Aceptado</i></h4>
						<ul class="booking_list">
							<li><strong>Booking date</strong> 11 November 2017</li>
							<li><strong>Booking details</strong> 2 People</li>
							<li><strong>Client</strong> Mark Twain</li>
						</ul>
						<p><a href="#0" class="btn_1 gray"><i class="fa fa-fw fa-envelope"></i> Enviar Mensaje</a></p>
						<ul class="buttons">
							<li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Aceptar</a></li>
							<li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar</a></li>
						</ul>
					</li> -->
				</ul>
			</div>
		</div>
		<!-- /box_general-->
		<!-- <nav aria-label="...">
			<ul class="pagination pagination-sm add_bottom_30">
				<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1">Anterior</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#">Siguiente</a>
				</li>
			</ul>
		</nav> -->
		<!-- /pagination-->
	  </div>
	  <!-- /container-fluid-->
   	</div>
    <!-- /container-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Maskayplace 2018</small>
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
            <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual..</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
            <a class="btn btn-primary" href="request/logout.php">Cerrar sesion</a>
          </div>
        </div>
      </div>
    </div>

      <!-- Detalles de Negocio -->
    <div class="modal fade" id="infoNegocioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detalle Negocio</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4">
                <img src="" id="logo_lugar" width="250">
              </div>
              <div class="col-md-6">
                <h5 id="nombre_lugar"></h5>
                <p id="direccion_lugar"></p>
                <p id="descripcion_lugar"></p>
              </div>
            </div>
            <div class="row">
              <div class="col-md-7">
                <h6>Nombre: <span id="usuario_nombre"></span></h6>
              </div>
              <div class="col-md-5">
                <h6>Telefono: <span id="usuario_telefono"></span></h6>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div id="map"></div>
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Obervaciones Negocio -->
    <div class="modal fade" id="observacionesNegocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Observaciones del Negocio</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row" style="padding: 35px;">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">Observaciones</label>
                  <textarea class="form-control" id="observacionesLugar" cols="30" rows="10"></textarea>
                  <input type="hidden" id="idLugar">
                </div>
              </div>
              <div class="col-md-12">
                <button id="guardarObs" class="btn btn-primary btn-block">Guardar Observaciones</button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/admin/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="../assets/admin/vendor/chart.js/Chart.min.js"></script>
    <script src="../assets/admin/vendor/datatables/jquery.dataTables.js"></script>
    <script src="../assets/admin/vendor/datatables/dataTables.bootstrap4.js"></script>
	<script src="../assets/admin/vendor/jquery.selectbox-0.2.js"></script>
	<script src="../assets/admin/vendor/retina-replace.min.js"></script>
	<script src="../assets/admin/vendor/jquery.magnific-popup.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../assets/admin/js/admin.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK-4115IIeoK7i7cFVO6jnjJ5krsxNyZE" async defer></script>
      

    <script>
    
    $(document).on('show.bs.modal', '#infoNegocioModal', function(event) {

      var modal = $(this);

      var button = $(event.relatedTarget);

      var idLugar = button.data('idl');

      $.ajax({
        type: "GET",
        url: "request/obtenerInfoLugar.request.php",
        data: {
          id: idLugar
        },
        cache: false,
        success: function (response) {
          if(response != 0) {
            var jsonData = JSON.parse(response);
            for (var i = 0; i < jsonData.data.length; i++) {
              var lugar = jsonData.data[i];
            }

            for (var j = 0; j < jsonData.usuario.length; j++) {
              var usuario = jsonData.usuario[j];
            }
            
            for (var k = 0; k < jsonData.contacto.length; k++) {
              var contacto = jsonData.contacto[k];
            }
            
            // console.log(lugar, usuario, contacto);

            $('#usuario_nombre').html(usuario.nombre + ' ' + usuario.apellidos);
            $('#usuario_telefono').html(contacto.numero);
            $('#nombre_lugar').html(lugar.nombre_lugar);
            $('#direccion_lugar').html(lugar.direccion);
            $('#descripcion_lugar').html(lugar.descripcion);
            $('#logo_lugar').prop('src', '../'+lugar.logo);

            var pos_original = new google.maps.LatLng( lugar.latitud_gps, lugar.longitud_gps);
            var options = {
                zoom: 15,
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
            
            var marcador = new google.maps.Marker({
                position: pos_original,
                map: map,
                draggable:false,
                animation: google.maps.Animation.DROP,
            });
          }
        }
      });
      // console.log(idLugar);
    });

    $(document).on('show.bs.modal', '#observacionesNegocio', function(event) {
        var modal = $(this);

        var button = $(event.relatedTarget);

        var idLugar = button.data('idl');

        $.ajax({
          type: "GET",
          url: "request/obtenerObservacionesLugar.request.php",
          data: {
            id: idLugar
          },
          cache: false,
          success: function (response) {
            if(response != 0) {
              var jsonData = JSON.parse(response);
              for (var i = 0; i < jsonData.data.length; i++) {
                var observacion = jsonData.data[i];
              }
              $('#observacionesLugar').html(observacion.observaciones);
              $('#idLugar').val(observacion.id_lugar);
            }
          }
        });
    });

    $(document).on('click', '#guardarObs', function() {
      var idLugar = $('#idLugar').val();
      var obs = $('#observacionesLugar').val();
      
      $.ajax({
        type: "POST",
        url: "request/guardarObservaciones.request.php",
        data: {id: idLugar, observaciones: obs},
        success: function(response) {
          if(response == 1) {
            alertify
            .alert("Correcto", "Observacion guardada.", function(){
              alertify.success('Observacion guardada con exito');
              location.reload();
            });
          } else {
            alertify
            .error("ERROR: " + response);
          }
        }
      });
    
    });

    function aprobarLugar(id) {
      $.ajax({
        type: "GET",
        url: "request/aprobarLugar.request.php",
        data: {id:id},
        success: function(response) {
          if(response == 1) {
            alertify
            .alert("Correcto", "Lugar Aprobado.", function(){
              alertify.success('Lugar Aprobado con exito');
              location.reload();
            });
          }else {
            alertify
            .error("ERROR: " + response);
          }
        }
      });
    }

    function rechazarLugar(id) {
      $.ajax({
        type: "GET",
        url: "request/rechazarLugar.request.php",
        data: {id:id},
        success: function(response) {
          if(response == 1) {
            alertify
            .alert("Correcto", "Lugar Rechazado.", function(){
              alertify.success('Lugar Rechazado con exito');
              location.reload();
            });
          }else {
            alertify
            .error("ERROR: " + response);
          }
        }
      });
    }

    
    </script>


</body>
</html>
