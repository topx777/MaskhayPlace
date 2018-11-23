<?php
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$mPieza=new mPieza;
$data=[];
$data['nombre_pieza']=(isset($_POST['nombre_pieza']))?$_POST['nombre_pieza']:'nombre Prueba';
$data['descripcion_pieza']=(isset($_POST['descripcion_pieza']))?$_POST['descripcion_pieza']:'descripcion';
$data['precio_noche']=(isset($_POST['precio_noche']))?$_POST['precio_noche']:'400';
$data['sanitario_privado']=(isset($_POST['sanitario_privado']))?$_POST['sanitario_privado']:'1';
$data['frigobar']=(isset($_POST['frigobar']))?$_POST['frigobar']:'1';
$data['hotel']=(isset($_POST['hotel']))?$_POST['hotel']:'1';
$data['imagen_pieza']=(isset($_FILES['imagen_pieza']))?$_FILES['imagen_pieza']['name']:'logo.jpg';

$mPieza->registrar($data);




?>