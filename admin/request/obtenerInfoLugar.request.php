<?php
if($_GET) {

    $idLugar = $_GET['id'];

    include('../../helpers/class.Conexion.php');

    $db = new Conexion();
    $db->charset();

    $obtenerInfo = $db->query("SELECT * FROM lugar WHERE id_lugar = $idLugar");
    if($db->rows($obtenerInfo) > 0) {

        $resLugar = $db->fetchAll($obtenerInfo);
        
        $idUsuario = $resLugar[0]["usuario"];
        
        // var_dump($idUsuario);
        $usuario = $db->query("SELECT usuario, nombre, apellidos, correo FROM usuarioregistrado WHERE id_usuarioregistrado = $idUsuario");
        $resUsuario = $db->fetchAll($usuario);
        
        $contactos = $db->query("SELECT numero FROM contacto WHERE lugar = $idLugar");
        $resContacto = $db->fetchAll($contactos);

        $lugar = array(
            'data' => $resLugar,
            'usuario' => $resUsuario,
            'contacto' => $resContacto
        );
        
        echo json_encode($lugar);

    } else {
        echo 0;
    }
}
?>