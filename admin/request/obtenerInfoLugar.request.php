<?php
if($_GET) {

    $idLugar = $_GET['id'];

    include('../../helpers/class.Conexion.php');

    $db = new Conexion();
    $db->charset();

    $obtenerInfo = $db->query("SELECT * FROM lugar WHERE id_lugar = $idLugar");
    if($db->rows($obtenerInfo) > 0) {

        $resLugar = $db->fetchAll($obtenerInfo);
        
        $lugar = array(
            'data' => $resLugar
        );
        
        // if($resLugar["categoria"] == "Farmacia") {
            // $obtenerFarmacia =
        // } else if ($resLugar["categoria"] == "Hotel") {

        // } else if ($resLugar["categoria"] == "Restaurante") {

        // }
    
        echo json_encode($lugar);

    } else {
        echo 0;
    }
}
?>