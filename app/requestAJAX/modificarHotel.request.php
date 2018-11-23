<?php
if($_POST) {
	session_start();
	include('../../helpers/class.Conexion.php');

	$db = new Conexion();
	$db->charset();

	$idUsuario = $_SESSION["usuario"]["id"];

	$id_lugar  = $_POST["id_lugar"];
	$nombre_lugar = $_POST["nombre_lugar"];
	$direccion_lugar = $_POST["direccion_lugar"];
	$latitud_gps = $_POST["latitud_gps"];
	$longitud_gps = $_POST["longitud_gps"];
	$descripcion_lugar = $_POST["descripcion_lugar"];

	if(isset($_FILES["logo"])) {

		$logo = $_FILES["logo"];
		$fecha_actual = new DateTime();
		
		$origenLogo = $logo["tmp_name"];
		$extLogo = explode(".", $logo["name"]);
		$destinoLogo = "assets/public/img/logos/".rand(1,9999).$fecha_actual->getTimestamp().rand(1,9999).".".$extLogo[1];
	
		move_uploaded_file($origenLogo, "../../".$destinoLogo);
	
	}
	
	$hotel_categoria = $_POST["hotel_categoria"];
	$hotel_nivel = $_POST["hotel_nivel"];

	$parqueo = $_POST["hotel_parqueo"] == "true" ? 1 : 0;
	$piscina = $_POST["hotel_piscina"] == "true" ? 1 : 0;
	$recreativa = $_POST["hotel_recreativa"] == "true" ? 1 : 0;
	$bar = $_POST["hotel_bar"] == "true" ? 1 : 0;
	$cable = $_POST["hotel_cable"] == "true" ? 1 : 0;
	$internet = $_POST["hotel_internet"] == "true" ? 1 : 0;
	$acondicionado = $_POST["hotel_acondicionado"] == "true" ? 1 : 0;
	$desayuno = $_POST["hotel_desayuno"] == "true" ? 1 : 0;
	$gimnasio = $_POST["hotel_gimnasio"] == "true" ? 1 : 0;
	$mascota = $_POST["hotel_mascota"] == "true" ? 1 : 0;
	$spa = $_POST["hotel_spa"] == "true" ? 1 : 0;
	$comedor = $_POST["hotel_comedor"] == "true" ? 1 : 0;
	$servicio = $_POST["hotel_servicio"] == "true" ? 1 : 0;
	
	// var_dump($horario, $turno, $vacunas, $servicio, $entrega);
	$verificar = $db->query("SELECT * FROM lugar WHERE nombre_lugar = '$nombre_lugar' AND id_lugar != $id_lugar");
	if($db->rows($verificar) == 0) {

		if(isset($logo)) {
			$obtenerLogoAnterior = $db->query("SELECT logo FROM lugar WHERE id_lugar = $id_lugar");
			$resLogoAnt = $db->recorrer($obtenerLogoAnterior);

			if($resLogoAnt["logo"] != NULL && $resLogoAnt["logo"] != ' ' && $resLogoAnt["logo"] != '') {
				unlink('../../'.$resLogoAnt["logo"]);
			} 

			$updateLugar = $db->query("UPDATE lugar SET nombre_lugar = '$nombre_lugar', direccion = '$direccion_lugar', latitud_gps = $latitud_gps, longitud_gps = $longitud_gps, usuario = $idUsuario, descripcion = '$descripcion_lugar', logo = '$destinoLogo'  WHERE id_lugar = $id_lugar");

		} else {
			$updateLugar = $db->query("UPDATE lugar SET nombre_lugar = '$nombre_lugar', direccion = '$direccion_lugar', latitud_gps = $latitud_gps, longitud_gps = $longitud_gps, usuario = $idUsuario, descripcion = '$descripcion_lugar' WHERE id_lugar = $id_lugar");
		}

		if($updateLugar) {
	
			$updateHotel = $db->query("UPDATE hotel SET categoria = '$hotel_categoria', nivel = $hotel_nivel, parqueo = $parqueo, piscina = $piscina, area_recreativa = $recreativa, bar = $bar, cable = $cable, internet = $internet, aire_acondicionado = $acondicionado, desayuno = $desayuno, gimnasio = $gimnasio, mascota = $mascota, spa = $spa, comedor = $comedor, servicio_habitacion = $servicio WHERE lugar = $id_lugar");
			if($updateHotel) {
				echo 1;
			} else {
				$error = $db->error;
				echo 'No se pudo modificar el hotel relacionado al lugar, intentelo nuevamente'.$error;
			}
	
		} else {
			unlink('../../'.$destinoLogo);
			echo 'no se pudo modificar el Lugar, intetelo mas tarde';
		}
	} else {

	}
}
?>