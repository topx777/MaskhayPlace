<?php
// establecer conexion con la base de datos
include('helpers/class.Conexion.php');

$_SESSION["usuario"] = array(
    'id' => 1,
    'nombre' => "Abel"
  );

  $db = new Conexion();
  $db->charset();
?>