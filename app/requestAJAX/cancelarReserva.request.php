<?php
if($_POST) {

	$idReserva = $_POST["id"];

	include('../../helpers/class.Conexion.php');
	$db = new Conexion();

	$eliminarReserva = $db->query("DELETE FROM reserva WHERE id_reserva = $idReserva");
	if($eliminarReserva) {
		echo 1;
	} else {
		echo 'No se pudo cancelar la reserva';
	}
}
?>