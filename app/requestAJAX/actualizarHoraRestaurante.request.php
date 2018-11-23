<?php
if($_GET){
    $idLugar=$_GET["id"];
    $semanal=$_GET["Horasem"]
    $sabado=$_GET["Horasab"];
    $domingo=$_GET["Horadom"]
    $db= new Conexion();

    $RevisionBD=$db->query("SELECT * FROM horario WHERE $idLugar=restaurante");


    if exists($RevisionBD)
    {
        $modificarHorarios=$db->query("UPDATE horario SET lun_vier="$semanal",sabado="$sabado",domingo="$domingo"");
    }
    else{
        $modificarHorarios=$db->query("INSERT INTO horario (sabado,domingo,lun_vier,restaurante) VALUES ($sabado,$domingo,$semanal,$idLugar)");
    }
    
    if($modificarHorarios) {
        echo 1;
    } else {
        echo "Ocurrio un problema al rechazar la reserva, intente nuevamente";
    }


?>