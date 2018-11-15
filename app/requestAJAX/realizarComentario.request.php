<?php
if($_POST) {
	if(!empty($_POST["puntaje"]) and !empty($_POST["lugar"])) {
		$puntaje = $_POST["puntaje"];
		$comentario = $_POST["comentario"];
		$idUsuario = 3;
		$idLugar = $_POST["lugar"];

		$fecha = date("Y-m-d");

		include('../../helpers/class.Conexion.php');
		$db = new Conexion();

		$verificarCalificacion = $db->query("SELECT * FROM calificacion WHERE usuario = $idUsuario AND lugar = $idLugar");
		if($db->rows($verificarCalificacion) > 0) {
			$agregarCalificacion = $db->query("INSERT INTO calificacion(lugar, usuario, calificacion, comentario, fecha) VALUES($idLugar, $idUsuario, $puntaje, '$comentario', '$fecha')");
			if($agregarCalificacion) {
				echo 1;
			} else {
				'No se pudo calificar el lugar, intentelo nuevamente';
			}
		} else {
			echo 'Ya realizaste una calificacion y comentario';
		}
	} else {
		echo 'Datos Vacios, el puntaje es requerido';
	}
}
?>