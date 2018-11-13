<?php
// inportar modelos 
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
// instancias de de modelo para acceso a datos
$mhotel=new mHotel;
$mFarmacia=new mFarmacia;
$mRestaurante=new mRestaurante;


$data=[ 'hoteles'=>$mhotel->masPuntuados(4),
        'farmacias'=>$mFarmacia->masPuntuados(4),
        'restaurantes'=>$mRestaurante->masPuntuados(4)];
        
echo json_encode($data);
?>
