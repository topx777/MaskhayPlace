<?php
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$mPieza=new mPieza;
$data=[];
$data['nombre_pieza']=(isset($_POST['nombre_pieza']))?$_POST['nombre_pieza']:'nombre Prueba';
$data['descripcion_pieza']=(isset($_POST['descripcion_pieza']))?$_POST['descripcion_pieza']:'';
$data['precio_noche']=(isset($_POST['precio_noche']))?$_POST['precio_noche']:'';
$data['sanitario_privado']=(isset($_POST['sanitario_privado']))?'1':'0';
$data['frigobar']=(isset($_POST['frigobar']))?'1':'0';
$data['hotel']=(isset($_POST['hotel']))?$_POST['hotel']:'';
$data['imagen_pieza']=(isset($_FILES['imagen_pieza']))?"assets/public/img/piezas/{$_FILES['imagen_pieza']['name']}":'';
move_uploaded_file($_FILES['imagen_pieza']['tmp_name'], "../../assets/public/img/piezas/{$_FILES['imagen_pieza']['name']}");
echo $mPieza->registrar($data);
?>