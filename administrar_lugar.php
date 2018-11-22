<?php
session_start();
$idUsuario = $_SESSION["usuario"]["id"];

include('helpers/class.Conexion.php');

$db = new Conexion();
$db->charset();

$obtenerLugar = $db->query("SELECT * FROM lugar WHERE usuario = $idUsuario");
$resLugar = $db->fetchAll($obtenerLugar);

$idLugar = $resLugar[0]["id_lugar"];

switch ($resLugar[0]["categoria"]) {
	case 'Hotel':
		header("Location: Hoteleria.php?id=$idLugar");
		# code...
		break;
	case 'Restaurante':
		header("Location: Restaurante.php?id=$idLugar");		
	# code...
		break;
	case 'Farmacia':
		header("Location: Farmacia.php?id=$idLugar");
	# code...
		break;
	default:
		header('Location: index-2.php');
		break;
}

?>