<?php
if($_GET) {
    
    $idReserva = $_GET["id"];

    include('../../helpers/class.Conexion.php');
    $db = new Conexion();

    $reservapent = $db->query("UPDATE reserva SET estado = 'Pendiente' WHERE id_reserva = '$idReserva'");
    if($reservapent) {
        echo 1;
    } else {
        echo "Ocurrio un problema al aceptar la reserva, intente nuevamente";
    }
}
?>