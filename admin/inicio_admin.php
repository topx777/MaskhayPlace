<?php
session_start();

if(!isset($_SESSION["admin"])) {
    header('Location: login_admin.php');
}

include('../helpers/class.Conexion.php');
$db = new Conexion();
$db->charset();

$obtenerLugares = $db->query("SELECT * FROM lugar");
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
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMylistings" data-parent="#mylistings">
            <i class="fa fa-fw fa-list"></i>
            <span class="nav-link-text">Publicaciones Lugar</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMylistings">
            <li>
              <a href="listings.html">Todos <span class="badge badge-pill badge-primary">6</span></a>
            </li>
            <li>
              <a href="listings.html">Pendientes <span class="badge badge-pill badge-warning">6</span></a>
            </li>
            <li>
              <a href="listings.html">Activos <span class="badge badge-pill badge-success">6</span></a>
            </li>
			      <li>
              <a href="listings.html">Rechazados <span class="badge badge-pill badge-danger">6</span></a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bookings">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-calendar-check-o"></i>
            <span class="nav-link-text">Mis revisiones <span class="badge badge-pill badge-primary">6 New</span></span>
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
        foreach ($lugares as $key => $lugar) {
        ?>
          <li>
            <figure><img src="../<?=$lugar["logo"]?>" alt=""></figure>
            <h4><?=$lugar["nombre"]?> <i class="pending"><?=$lugar["estado"]?></i></h4>
            <ul class="booking_list">
              <li><strong>Usuario</strong> <?=$lugar["usuario"]?></li>
              <li><strong>Categoria</strong> <?=$lugar["categoria"]?></li>
            </ul>
            <p><a href="#0" class="btn_1 gray"><i class="fa fa-fw fa-envelope"></i> Enviar Mensaje</a></p>
            <ul class="buttons">
              <li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Aceptar</a></li>
              <li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar</a></li>
            </ul>
          </li>
        <?php
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
		<nav aria-label="...">
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
		</nav>
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
	
</body>
</html>
