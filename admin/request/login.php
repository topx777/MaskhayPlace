<?php
session_start();
if($_POST) {

    if(!empty($_POST["usuario"]) and !empty($_POST["password"])) {

        $usuario = $_POST["usuario"];
        $password = $_POST["password"];

        include('../../helpers/class.Conexion.php');

        $db = new Conexion();
        
        $sqlVerificar = $db->query("SELECT * FROM superusuario WHERE usuario = '$usuario' AND password = '$password'");
        if($db->rows($sqlVerificar) > 0) {
            $resAdmin = $db->recorrer($sqlVerificar);
            $_SESSION["admin"] = array(
                'id' => $resAdmin["id_superusuario"],
                'usuario' => $resAdmin["usuario"],
                'nombre' => $resAdmin["nombre"],
                'apellidos' => $resAdmin["apellidos"],
            );
            echo 1; jjjj
        } else {
            echo 'Credenciales incorrectos';
        }

    } else {
        echo "Campos de Nombre de Usuario y Password necesarios";
    }

}

?>