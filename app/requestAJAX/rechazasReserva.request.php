<?php

if($_GET)
{
    $idReserva=$_GET["id"];

    include('../../helpers/class.Conexion.php');

    $db=New Conexion();

    $rechazarReserva=$db->query("UPDATE reserva SET estado='Rechazado' WHERE id_reserva=$idReserva");

    if($rechazarReserva) {
        echo 1;
    } else {
        echo "Ocurrio un problema al rechazar la reserva, intente nuevamente";
    }
}

?>