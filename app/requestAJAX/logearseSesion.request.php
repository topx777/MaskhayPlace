<?php
session_start();
if($_POST) {
	if(!empty($_POST["usuario"]) and !empty($_POST["password"])) {

		include('../../helpers/class.Conexion.php');
		$db = new Conexion();
		$db->charset();

		$usuario = $_POST["usuario"];
		$password = $_POST["password"];

		$verificarUsuario = $db->query("SELECT * FROM usuarioregistrado WHERE usuario = '$usuario' AND password = '$password' LIMIT 1");
		if($db->rows($verificarUsuario) > 0) {

			$usuarioRes = $db->recorrer($verificarUsuario);

			$_SESSION["usuario"] = array(
				'id' => $usuarioRes["id_usuarioregistrado"],
				'usuario' => $usuarioRes["usuario"],
				'nombre' => $usuarioRes["nombre"],
				'apellidos' => $usuarioRes["apellidos"],
				'negocio' => $usuarioRes["negocio"],
				'correo' => $usuarioRes["correo"],
				'celular' => $usuarioRes["celular"]
			);

			echo 1;

		} else {
			echo 'Credenciales Incorrectas';
		}

	} else {
		echo "Todos los campos son requeridos";
	}
}
?>