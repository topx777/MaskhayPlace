<?php
if (isset($_POST['enviarfarmacia'])) 
{
$tipod = $_POST['desde'];
$tipoh = $_POST['hasta'];

if (isset($_POST['turno']) && $_POST['parqueo'] = '1')      
$turno = 1;
else
$turno = 0;

if (isset($_POST['vacunas']) && $_POST['piscina'] = '1')      
$vacunas = 1;
else
$vacunas = 0;

if (isset($_POST['enfermeria']) && $_POST['area'] = '1')      
$enfermeria = 1;
else
$enfermeria = 0;

if (isset($_POST['domicilio']) && $_POST['bar'] = '1')      
$domicilio = 1;
else
$domicilio = 0;
} 

$horario = "$tipod a $tipoh";

echo "insert into Farmacia (horario,turno,vacunas,servicio_enfermeria,entrega_domicilio) values ($horario,$turno,$vacunas,$enfermeria,$domicilio)";



?>