<?php
if (isset($_POST['enviarrestaurante'])) 
{
if (isset($_POST['parqueo']) && $_POST['parqueo'] = '1')      
$parqueo = 1;
else
$parqueo = 0;

if (isset($_POST['recreativo']) && $_POST['recreativo'] = '1')      
$recreativo = 1;
else
$recreativo = 0;

if (isset($_POST['fumadores']) && $_POST['fumadores'] = '1')      
$fumadores = 1;
else
$fumadores = 0;

if (isset($_POST['servicio']) && $_POST['servicio'] = '1')      
$servicio = 1;
else
$servicio = 0;

if (isset($_POST['internet']) && $_POST['internet'] = '1')      
$internet = 1;
else
$internet = 0;
 
if (isset($_POST['reserva']) && $_POST['reserva'] = '1')      
$reserva = 1;
else
$reserva = 0;
} 

echo "insert into restaurante (parqueo,recreativo,area_fumadores,auto_servicio,internet,reserva_mesa) values ($parqueo,$recreativo,$fumadores,$servicio,$internet,$reserva)";



?>