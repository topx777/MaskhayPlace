<?php
session_start();

if(!isset($_SESSION["admin"])) {
    header('Location: login_admin.php');
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.html">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Messages">
          <a class="nav-link" href="messages.html">
            <i class="fa fa-fw fa-envelope-open"></i>
            <span class="nav-link-text">Messages</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="" data-original-title="Bookings">
          <a class="nav-link" href="bookings.html">
            <i class="fa fa-fw fa-calendar-check-o"></i>
            <span class="nav-link-text">Bookings <span class="badge badge-pill badge-primary">6 New</span></span>
          </a>
        </li>
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
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
          <a class="nav-link" href="reviews.html">
            <i class="fa fa-fw fa-star"></i>
            <span class="nav-link-text">Reviews</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Bookmarks">
          <a class="nav-link" href="bookmarks.html">
            <i class="fa fa-fw fa-heart"></i>
            <span class="nav-link-text">Bookmarks</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Add listing">
          <a class="nav-link" href="add-listing.html">
            <i class="fa fa-fw fa-plus-circle"></i>
            <span class="nav-link-text">Add listing</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="My profile">
          <a class="nav-link" href="user-profile.html">
            <i class="fa fa-fw fa-user"></i>
            <span class="nav-link-text">My Profile</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#Components">
            <i class="fa fa-fw fa-gear"></i>
            <span class="nav-link-text">Components</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="charts.html">Charts</a>
            </li>
			<li>
              <a href="tables.html">Tables</a>
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
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-envelope"></i>
            <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
            <span class="indicator text-primary d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="messagesDropdown">
            <h6 class="dropdown-header">Nuevos mensajes:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>David Miller</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">¡Hola! Esta nueva versión de SB Admin es bastante impresionante! ¡Estos mensajes se cortan cuando llegan al final del cuadro para que no se desborden a los lados!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>Jane Smith</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Me preguntaba si podría reunirse para una cita a las 3:00 en lugar de las 4:00. ¡Gracias!</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <strong>John Doe</strong>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">He enviado los archivos finales a usted para su revisión. Cuando puedas darte de baja, avísame y podemos discutir la distribución.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todos los mensajes</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-fw fa-bell"></i>
            <span class="d-lg-none">Alerts
              <span class="badge badge-pill badge-warning">6 New</span>
            </span>
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          </a>
          <div class="dropdown-menu" aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">Nuevas alertas:</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Actualizacion de estados</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Este es un mensaje de respuesta del servidor automatizado. Todos los sistemas están en línea.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-danger">
                <strong>
                  <i class="fa fa-long-arrow-down fa-fw"></i>Actualizacion de estados</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Este es un mensaje de respuesta del servidor automatizado. Todos los sistemas están en línea.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <span class="text-success">
                <strong>
                  <i class="fa fa-long-arrow-up fa-fw"></i>Actualizacion de estado</strong>
              </span>
              <span class="small float-right text-muted">11:21 AM</span>
              <div class="dropdown-message small">Este es un mensaje de respuesta del servidor automatizado. Todos los sistemas están en línea.</div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item small" href="#">Ver todas las alertas</a>
          </div>
        </li>
        <li class="nav-item">
          <form class="form-inline my-2 my-lg-0 mr-lg-2">
            <div class="input-group">
              <input class="form-control search-top" type="text" placeholder="Buscar. . .">
              <span class="input-group-btn">
                <button class="btn btn-primary" type="button">
                  <i class="fa fa-search"></i>
                </button>
              </span>
            </div>
          </form>
        </li>
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
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Tablero</a>
        </li>
        <li class="breadcrumb-item active">Lista de negocios</li>
      </ol>
		<div class="box_general">
			<div class="header_box">
				<h2 class="d-inline-block">Lista de negocios</h2>
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
					<li>
						<figure><img src="../assets/admin/img/item_1.jpg" alt=""></figure>
						<h4>Brandon triveño <i class="pending">Pendiente</i></h4>
						<ul class="booking_list">
							<li><strong>Start date</strong> 11 November 2017</li>
							<li><strong>End date</strong> 11 April 2018</li>
							<li><strong>Booking details</strong> 2 People</li>
							<li><strong>Client</strong> Mark Twain</li>
						</ul>
						<p><a href="#0" class="btn_1 gray"><i class="fa fa-fw fa-envelope"></i> Enviar Mensaje</a></p>
						<ul class="buttons">
							<li><a href="#0" class="btn_1 gray approve"><i class="fa fa-fw fa-check-circle-o"></i> Aceptar</a></li>
							<li><a href="#0" class="btn_1 gray delete"><i class="fa fa-fw fa-times-circle-o"></i> Cancelar</a></li>
						</ul>
					</li>
					<li>
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
					</li>
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
