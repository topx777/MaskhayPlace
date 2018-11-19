<?php
if($_POST) {
	if(!empty($_POST["id"]) and !empty($_POST["nombre"]) and !empty($_POST["fecha"]) and !empty($_POST["cant"]) and !empty($_POST["hora"])) {

		$id = $_POST["id"];
		$nombre = $_POST["nombre"];
		$fecha = $_POST["fecha"];
		$cant = $_POST["cant"];
		$hora = $_POST["hora"];
				
		include('../../helpers/class.Conexion.php');
		$db = new Conexion();
		

		$modificarReserva = $db->query("UPDATE reserva SET nombre_reserva = '$nombre', fecha = '$fecha', hora = '$hora', cantidad_personas = '$cant' WHERE id_reserva = $id");
		if($modificarReserva) {
			echo 1;
		} else {
			'No se pudo modificar la reserva, intentelo nuevamente';
		}

	} else {
		echo 'Datos Vacios, todos los campos son requeridos';
	}
} else {
	echo 'no entro';
}
?>