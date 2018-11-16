<?php
// inportar modelos 
spl_autoload_register(function($nombreClase)
{
    require_once '../model/' . $nombreClase . '.php';
});
$mHotel=new mHotel;
$mRestaurante=new mRestaurante;
$mFarmacia= new mFarmacia;
$mGeneral=new mGeneral;
$data;
$buscar=(isset($_GET['buscar']))?$_GET['buscar']:'';
//lat long
$lugar=(isset($_GET['lugar']))?$_GET['lugar']:'';
$categoria=(isset($_GET['categoria']))?$_GET['categoria']:'';
$distanciaRad=(isset($_GET['distanciaRad']))?$_GET['distanciaRad']:'';
$orden=(isset($_GET['orden']))?$_GET['orden']:'';
$puntaje=(isset($_GET['puntaje']))?$_GET['puntaje']:'';

//coincidencias
if($buscar!='')
{
  
}



//Categorias
switch ($categoria) {
    case '':
    {

    }
    break;
    case 'hoteles':
    {

    }
    break;
    case 'restaurantes':
    {

    }
    break;
    case 'farmacias':
    {

    }
    break;
}
//Orden
switch ($orden) {
    case 'all':
    {

    }
    break;
    case 'pop':
    {

    }
    break;
    case 'ult':
    {

    }
    break;
}
//Numero de Sitios Por Tipo
$numeroSitios=['farmacias'=>$mFarmacia->numFarmacias(),'restaurantes'=>$mFarmacia->numFarmacias(),'hoteles'=>$mHotel->numHoteles()];
//NUmero de Stios por Puntaje
//02
$num02=$mGeneral->numeroSitiosPorPuntaje(0)+$mGeneral->numeroSitiosPorPuntaje(1)+$mGeneral->numeroSitiosPorPuntaje(2);
$num34=$mGeneral->numeroSitiosPorPuntaje(3)+$mGeneral->numeroSitiosPorPuntaje(4);
$num5=$mGeneral->numeroSitiosPorPuntaje(5);
$sitiosPuntaje=['pts5'=>$num5, 'pts34'=>$num34, 'pts02'=>$num02];


$data=['numSitios'=>$numeroSitios,'sitiosPuntaje'=>$sitiosPuntaje];



echo json_encode($data)


//echo json_encode($_GET);

?>