<?php
session_start();
if($_GET) {

    $idLugar = $_GET["id"];
    include('../../helpers/class.Conexion.php');
    $db = new Conexion();
    $id_admin = $_SESSION["admin"]["id"];

    $rechazarLugar = $db->query("UPDATE lugar SET activo = 0, revisado = 1, encargado_rev = $id_admin, estado = 'Rechazado' WHERE id_lugar = $idLugar");
    if($rechazarLugar) {
        echo 1;
    } else {
        echo "no se pudo aprobar el lugar, intentelo nuevamente";
    }
}
?>