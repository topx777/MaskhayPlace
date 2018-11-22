<?php
session_start();
if($_POST) {

    include('../../helpers/class.Conexion.php');
    $db = new Conexion();

    $idLugar = $_POST["id"];
    $idUsuario = $_SESSION["admin"]["id"];
    $obs = $_POST["observaciones"];

    $agregarObs = $db->query("UPDATE lugar SET revisado = 1, observaciones = '$obs', encargado_rev = $idUsuario WHERE id_lugar = $idLugar");
    if($agregarObs) {
        echo 1;
    } else {
        echo 'No se pudo guardar la observacion';
    }
}
?>