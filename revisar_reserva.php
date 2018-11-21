<?php
session_start();
include('helpers/class.Conexion.php');


$database=new Conexion;

if(isset($_SESSION["filtro"])) {
  $filtro = $_SESSION["filtro"];
  $consulta=$database->query($filtro);
} else {
  $consulta=$database->query("SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
  FROM restaurante
  INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
  INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante");
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
  <title>SPARKER - Admin dashboard</title>
	
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
  <!-- Your custom styles -->
  <link href="assets/admin/css/custom.css" rel="stylesheet">


  <!-- Message Alert -->
  
  <link rel="stylesheet"type="text/css"href="css/alertify.css">
    <link rel="stylesheet"type="text/css"href="css/themes/default.css">

    <script src="jquery-3.3.1.min.js"></script>
    <script src="alertify.js"></script>
	
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
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My listings">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistings" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">My listings</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMylistings">
            <li>
              <a href="listings.html">Pending <span class="badge badge-pill badge-primary">6</span></a>
            </li>
			<li>
              <a href="listings.html">Active <span class="badge badge-pill badge-success">6</span></a>
            </li>
			<li>
              <a href="listings.html">Expired <span class="badge badge-pill badge-danger">6</span></a>
            </li>
          </ul>
        </li>
    </div>
  </nav>
  <!-- /Navigation-->
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Bookings list</li>
      </ol>
		<div class="box_general">
			<div class="header_box">
				<h2 class="d-inline-block">Bookings list</h2>
				<div class="filter">
					<select name="orderby" class="selectbox" id="reservefilters" onchange="getvalue(this)">
						<option value="Any status">Cualquier Estado</option>
						<option value="Aceptado">Aceptado</option>
						<option value="Pendiente">Pendiente</option>
						<option value="Rechazado">Rechazado</option>
					</select>
				</div>
			</div>
      <?php
      
      // $consulta=$database->query("SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
      // FROM restaurante
      // INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
      // INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante");
      
      
      ?>
      <script type="text/javascript">
      function getvalue(filtro){
        var seleccionado = $(filtro).val();
        console.log(seleccionado);
        $.ajax({
          type: "GET",
          url: "app/requestAJAX/filtroreservas.request.php",
          data: { filtro : seleccionado },
          success: function(response) {
            console.log(response);
            if(response == 1) {
              $("#lista_reservas").load(location.href + " #lista_reservas"); 
              // location.reload();    
            } else {
              alertify.error("ERROR: " + response);
            }
          }
        });
      };

      </script>
			<div class="list_general" id="lista_reservas">
				<ul>
<!--Informacion de la Base de Datos-->
<?php while($resDatos = $database->recorrer($consulta)):?>
					<li>
						<figure><img src="<?= $resDatos["logo"]?>" alt=""></figure>
						<h4><?= $resDatos["nombre_lugar"];?><i class="pending"><?= $resDatos["estado_reserva"];?></i></h4>
						<ul class="booking_list">
							<li><strong>Fecha de Reserva</strong> <?= $resDatos["fecha"];?></li>
							<li><strong>Cantidad de Personas</strong> <?= $resDatos["cantidad_personas"];?></li>
              <li><strong>Cliente</strong> <?= $resDatos["nombre_reserva"];?></li>
              <li><strong>Hora</strong><?= $resDatos["hora"];?></li>
              <li><strong>ID Reserva</strong><?= $resDatos["id_reserva"];?></li>
              
            </ul>
						<ul class="buttons">
							<li><button onclick="aceptarReserva(<?=$resDatos["id_reserva"]?>);" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Aprobar</button></li>
							<li><button onclick="rechazarReserva(<?=$resDatos["id_reserva"]?>);" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar</button></li>
              <li><button onclick="reservapendiente(<?=$resDatos["id_reserva"]?>);" class="btn_1 gray medium"><i class="fa fa-fw fa-times-circle-o"></i> Pendiente</button></li>
						</ul>
          </li>
<?php endwhile;?>
				</ul>
			</div>
		</div>
		<!-- /box_general-->
		<nav aria-label="...">
			<ul class="pagination pagination-sm add_bottom_30">
				<li class="page-item disabled">
					<a class="page-link" href="#" tabindex="-1">Previous</a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
					<a class="page-link" href="#">Next</a>
				</li>
			</ul>
		</nav>
		<!-- /pagination-->
	  </div>
	  <!-- /container-fluid-->
   	</div>
    <!-- /container-wrapper-->
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
    <script type="text/javascript">

/*  Aceptar, Rechazar Reservas  */
  function aceptarReserva(id){
    $.ajax({
      type: "GET",
      url: "app/requestAJAX/aceptarReserva.request.php",
      data: { id: id },
      success: function(response) {
        if(response == 1) {
          alertify.success("Reserva Aceptada");
          location.reload();    
        } else {
          alertify.error("ERROR: " + response);
        }
      }
    });
  }
  function rechazarReserva(id){
    $.ajax({
      type: "GET",
      url: "app/requestAJAX/rechazasReserva.request.php",
      data: { id: id },
      success: function(response) {
        if(response == 1) {
          alertify.success("Reserva Rechazada");
          location.reload();    
        } else {
          alertify.error("ERROR: " + response);
        }
      }
    });
  }
  function reservapendiente(id){
    $.ajax({
      type: "GET",
      url: "app/requestAJAX/reservapendiente.request.php",
      data: { id: id },
      success: function(response) {
        if(response == 1) {
          alertify.success("Reserva Rechazada");
          location.reload();    
        } else {
          alertify.error("ERROR: " + response);
        }
      }
    });
  }
  </script>
</body>
</html>