<?php
if($_GET) {

	$idReserva = $_GET["id"];

	include('../../helpers/class.Conexion.php');
	$db = new Conexion();
	$db->charset();

	$obtenerReserva = $db->query("SELECT nombre_reserva, fecha, hora, cantidad_personas FROM reserva WHERE id_reserva = $idReserva");
	$resReserva = $db->fetchAll($obtenerReserva);

	$resultado = array(
		'data' => $resReserva
	);

	echo json_encode($resultado);

}
?>