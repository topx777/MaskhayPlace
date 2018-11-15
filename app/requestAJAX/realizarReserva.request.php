<?php
if($_POST) {
	if(!empty($_POST["nombre"]) and !empty($_POST["fecha"]) and !empty($_POST["cant"]) and !empty($_POST["hora"]) and !empty("id_resto")) {
		
		$nombre = $_POST["nombre"];
		$fecha = $_POST["fecha"];
		$cant = $_POST["cant"];
		$hora = $_POST["hora"];
		
		$idUsuario = 3;
		$idResto = $_POST["id_resto"];
		
		include('../../helpers/class.Conexion.php');
		$db = new Conexion();
		

		$realizarReserva = $db->query("INSERT INTO reserva(restaurante, usuario, nombre_reserva, fecha, hora, cantidad_personas, estado) VALUES($idResto, $idUsuario, '$nombre', '$fecha', '$hora', $cant, 'Pendiente')");
		if($realizarReserva) {
			echo 1;
		} else {
			'No se pudo realizar la reserva, intentelo nuevamente';
		}

	} else {
		echo 'Datos Vacios, todos los campos son requeridos';
	}
} else {
	echo 'no entro';
}
?>