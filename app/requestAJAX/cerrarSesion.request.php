<?php
session_start();

if(isset($_SESSION["usuario"]))
{
    unset($_SESSION["usuario"]);
}

session_destroy();

header('Location: ../../restaurante_detalle.php?id=1');
?>