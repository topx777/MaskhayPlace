<?php
session_start();
if($_POST) {
	if(!empty($_POST["usuario"]) and !empty($_POST["password"]) and !empty($_POST["respassword"]) and !empty($_POST["nombre"]) and !empty($_POST["apellidos"]) and !empty($_POST["correo"]) and !empty($_POST["celular"])) {

		include('../../helpers/class.Conexion.php');
		$db = new Conexion();
		$db->charset();

		$usuario = $_POST["usuario"];
		$password = $_POST["password"];
		$respassword = $_POST["respassword"];
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		$correo = $_POST["correo"];
		$celular = $_POST["celular"];

		$verificarUsuario = $db->query("SELECT * FROM usuarioregistrado WHERE usuario = '$usuario' OR correo = '$correo' LIMIT 1");
		if($db->rows($verificarUsuario) == 0) {

			if($password == $respassword) {

				$registrarUsuario = $db->query("INSERT INTO usuarioregistrado(usuario, password, nombre, apellidos, correo, celular) VALUES('$usuario', '$password', '$nombre', '$apellidos', '$correo', '$celular')");
				if($registrarUsuario) {
					
					$_SESSION["usuario"] = array(
						'id' => $db->ultimaId(),
						'usuario' => $usuario,
						'nombre' => $nombre,
						'apellidos' => $apellidos,
						'negocio' => 0,
						'correo' => $correo,
						'celular' => $celular
					);
	
					echo 1;

				} else {
					echo 'No se puede registrar el usuario' . $db->error;
				}

			} else {
				echo 'Las passwords no coinciden';
			}

		} else {
			echo 'Error el usuario ya existe';
		}

	} else {
		echo "Todos los campos son requeridos";
	}
}
?>