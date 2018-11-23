<?php
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$mPieza=new mPieza;
$id_pieza=(isset($_POST['id_pieza']))?$_POST['id_pieza']:'';
$mPieza->eliminar($id_pieza);
?>