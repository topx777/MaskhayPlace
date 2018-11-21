<?php
if($_GET) {

    $idLugar = $_GET['id'];

    include('../../helpers/class.Conexion.php');

    $db = new Conexion();
    $db->charset();

    $obtenerInfo = $db->query("SELECT observaciones FROM lugar WHERE id_lugar = $idLugar");
    if($db->rows($obtenerInfo) > 0) {

        $resLugar = $db->fetchAll($obtenerInfo);

        $lugar = array(
            'data' => $resLugar
        );
        
        echo json_encode($lugar);

    } else {
        echo 0;
    }
}
?>