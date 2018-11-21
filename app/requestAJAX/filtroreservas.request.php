<?php
if($_GET) {
    session_start();

    include('../../helpers/class.Conexion.php');
    $db = new Conexion();

    $filter = $_GET["filtro"];

    // $filtro=$db->query("SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
    // FROM restaurante
    // INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
    // INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante");

    if ($filter=="Aceptado")
    {
        $filtro= "SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
        FROM restaurante
        INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
        INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante WHERE reserva.estado='Aceptado'";
    }
    elseif ($filter=="Rechazado"){


        $filtro= "SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
        FROM restaurante
        INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
        INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante WHERE reserva.estado='Rechazado'";

    }elseif ($filter=="Pendiente") {

        $filtro= "SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
        FROM restaurante
        INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
        INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante WHERE reserva.estado='Pendiente'";
    }

    else{
        $filtro= "SELECT reserva.estado AS estado_reserva, restaurante.*, reserva.*, lugar.*  
        FROM restaurante
        INNER JOIN reserva ON restaurante.id_restaurante=reserva.restaurante
        INNER JOIN lugar on lugar.id_lugar=restaurante.id_restaurante";
    }

    if($db->query($filtro)) {
        $_SESSION["filtro"] = $filtro;
        echo 1;
    } else {
        echo "Ocurrio un problema, intente nuevamente" . $db->error;
    }
}
?>