<?php
if($_GET) {
    
    $idReserva = $_GET["id"];

    include('../../helpers/class.Conexion.php');
    $db = new Conexion();

    $aceptarReserva = $db->query("UPDATE reserva SET estado = 'Aceptado' WHERE id_reserva = '$idReserva'");
    if($aceptarReserva) {
        echo 1;
    } else {
        echo "Ocurrio un problema al aceptar la reserva, intente nuevamente";
    }
}
?>