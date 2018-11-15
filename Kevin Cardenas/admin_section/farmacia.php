<?php

if (isset($_POST['enviarfarmacia'])) 
{

//recibimos el nombre 
$nombre = $_POST['nombre'];

//recibimos la direccion 
$direccion = $_POST['direccion'];

//recibimos la descripcion
$descripcion = $_POST['descripcion'];

//recibimos horario desde ; hasta 
$tipod = $_POST['desde'];
$tipoh = $_POST['hasta'];

//consulta para tabla lugar * falta logo, mapa, etc
echo "insert into lugar (nombre_lugar,direccion,descripcion) values ($nombre,$direccion,$descripcion)";


//recibimos valores 1 o 0 de los checkbox
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

//consulta para tabla farmacia
echo "insert into Farmacia (horario,turno,vacunas,servicio_enfermeria,entrega_domicilio) values ($horario,$turno,$vacunas,$enfermeria,$domicilio)";



?>