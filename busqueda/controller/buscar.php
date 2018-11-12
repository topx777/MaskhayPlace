<?php
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$hotel=new mHotel;
$hoteles=$hotel->getHoteles();
$numHoteles=$hotel->numHoteles();
print_r("Numero de Hoteles: {$numHoteles} <br>");
print_r($hoteles);
?>