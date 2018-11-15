<?php
$buscar=(isset($_GET['buscar']))?$_GET['buscar']:'';
//lat long
$lugar=(isset($_GET['lugar']))?$_GET['lugar']:'';
$categoria=(isset($_GET['categoria']))?$_GET['categoria']:'';
$distanciaRad=(isset($_GET['distanciaRad']))?$_GET['distanciaRad']:'';
$orden=(isset($_GET['orden']))?$_GET['orden']:'';
$puntaje=(isset($_GET['puntaje']))?$_GET['puntaje']:'';

if($buscar!='')
{
    $sql= " LIKE {$buscar}";
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

echo json_encode($_GET);

?>