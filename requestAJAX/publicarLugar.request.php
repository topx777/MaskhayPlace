<?php
if($_POST) {
	session_start();
	include('../helpers/class.Conexion.php');

	$db = new Conexion();
	$db->charset();

	$idUsuario = $_SESSION["usuario"]["id"];

	$nombre_lugar = $_POST["nombre_lugar"];
	$direccion_lugar = $_POST["direccion_lugar"];
	$categoria = $_POST["categoria"];
	$latitud_gps = $_POST["latitud_gps"];
	$longitud_gps = $_POST["longitud_gps"];
	$descripcion_lugar = $_POST["descripcion_lugar"];

	$logo = $_FILES["logo"];
	
	for ($i=1; $i <= $_POST["cantContactos"]; $i++) { 
		$contactos[] = array(
			'tipo' => $_POST["cont_tipo".$i],
			'numero' => $_POST["cont_num".$i]
		);
	}

	for ($j=1; $j <= $_POST["cantImagenes"]; $j++) {
		$imagenes[] = array(
			'img' => $_FILES["imagen_url".$j],
			'desc' => $_POST["imagen_desc".$j],
			'destino' => ''
		);
	}

	$fecha_actual = new DateTime();
	
	$origenLogo = $logo["tmp_name"];
	$extLogo = explode(".", $logo["name"]);
	$destinoLogo = "assets/public/img/logos/".rand(1,9999).$fecha_actual->getTimestamp().rand(1,9999).".".$extLogo[1];

	move_uploaded_file($origenLogo, "../".$destinoLogo);

	foreach($imagenes as $key => $value) {

		$origenImagen = $value["img"]["tmp_name"];
		$extImagen = explode(".", $value["img"]["name"]);
		$destinoImagen = "assets/public/img/imagenes/".rand(1,9999).$fecha_actual->getTimestamp().rand(1,9999).".".$extImagen[1];
		move_uploaded_file($origenImagen, "../".$destinoImagen);
		$imagenes[$key]["destino"] = $destinoImagen;
	}
	// var_dump($imagenes);

	if($categoria == "Farmacia") {
		
		$horario = $_POST["farmacia_horario1"]." - ".$_POST["farmacia_horario2"];
		$turno = $_POST["farmacia_turno"] == "true" ? 1 : 0;
		$vacunas = $_POST["farmacia_vacunas"] == "true" ? 1 : 0;
		$servicio = $_POST["farmacia_servicio"] == "true" ? 1 : 0;
		$entrega = $_POST["farmacia_entrega"] == "true" ? 1 : 0;
		
		// var_dump($horario, $turno, $vacunas, $servicio, $entrega);
		$agregarLugar = $db->query("INSERT INTO lugar(nombre_lugar, direccion, latitud_gps, longitud_gps, usuario, descripcion, logo, categoria) VALUES('$nombre_lugar', '$direccion_lugar', $latitud_gps, $longitud_gps, $idUsuario, '$descripcion_lugar', '$destinoLogo', '$categoria')");
		if($agregarLugar) {

			$idLugar = $db->ultimaId();
			
			$agregarFarmacia = $db->query("INSERT INTO farmacia(horario, turno, vacunas, servicio_enfermeria, entrega_domicilio, lugar) VALUES('$horario', $turno, $vacunas, $servicio, $entrega, $idLugar)");
			if($agregarFarmacia) {
				foreach($contactos as $key => $value) {
					$ctipo = $value["tipo"];
					$cnumero = $value["numero"];
					$agregarContacto = $db->query("INSERT INTO contacto(tipo, numero, lugar) VALUES('$ctipo', '$cnumero', $idLugar)");
				}						
	
				foreach ($imagenes as $key => $value) {
					$idesc = $value["desc"];
					$idestino = $value["destino"];
					$agregarImagen = $db->query("INSERT INTO imagen(descripcion, url, lugar) VALUES('$idesc', '$idestino', $idLugar)");
				}
				echo 1;
			} else {
				$eliminarLugar = $db->query("DELETE FROM lugar WHERE id_lugar = $idLugar");
				echo 'No se pudo agregar la farmacia relacionado al lugar, intentelo nuevamente';
			}

		} else {
			unlink('../'.$destinoLogo);
			foreach($imagenes as $key => $value) {
				unlink('../'.$value["destino"]);
			}
			echo 'no se pudo agregar el Lugar, intetelo mas tarde';
		}
	} else if($categoria == "Hotel") {

		$hotel_categoria = $_POST["hotel_categoria"];
		$hotel_nivel = $_POST["hotel_nivel"];

		$parqueo = $_POST["hotel_parqueo"] == "true" ? 1 : 0;
		$piscina = $_POST["hotel_piscina"] == "true" ? 1 : 0;
		$recreativa = $_POST["hotel_recreativa"] == "true" ? 1 : 0;
		$bar = $_POST["hotel_bar"] == "true" ? 1 : 0;
		$cable = $_POST["hotel_cable"] == "true" ? 1 : 0;
		$internet = $_POST["hotel_internet"] == "true" ? 1 : 0;
		$acondicionado = $_POST["hotel_acondicionado"] == "true" ? 1 : 0;
		$desayuno = $_POST["hotel_desayuno"] == "true" ? 1 : 0;
		$gimnasio = $_POST["hotel_gimnasio"] == "true" ? 1 : 0;
		$mascota = $_POST["hotel_mascota"] == "true" ? 1 : 0;
		$spa = $_POST["hotel_spa"] == "true" ? 1 : 0;
		$comedor = $_POST["hotel_comedor"] == "true" ? 1 : 0;
		$servicio = $_POST["hotel_servicio"] == "true" ? 1 : 0;
		
		// var_dump($horario, $turno, $vacunas, $servicio, $entrega);
		$agregarLugar = $db->query("INSERT INTO lugar(nombre_lugar, direccion, latitud_gps, longitud_gps, usuario, descripcion, logo, categoria) VALUES('$nombre_lugar', '$direccion_lugar', $latitud_gps, $longitud_gps, $idUsuario, '$descripcion_lugar', '$destinoLogo', '$categoria')");
		if($agregarLugar) {

			$idLugar = $db->ultimaId();

			
			$agregarHotel = $db->query("INSERT INTO hotel(categoria, nivel, parqueo, piscina, area_recreativa, bar, cable, internet, aire_acondicionado, desayuno, gimnasio, mascota, spa, comedor, servicio_habitacion, lugar) VALUES('$hotel_categoria', $hotel_nivel, $parqueo, $piscina, $recreativa, $bar, $cable, $internet, $acondicionado, $desayuno, $gimnasio, $mascota, $spa, $comedor, $servicio, $idLugar)");
			if($agregarHotel) {
				foreach($contactos as $key => $value) {
					$ctipo = $value["tipo"];
					$cnumero = $value["numero"];
					$agregarContacto = $db->query("INSERT INTO contacto(tipo, numero, lugar) VALUES('$ctipo', '$cnumero', $idLugar)");
				}						
	
				foreach ($imagenes as $key => $value) {
					$idesc = $value["desc"];
					$idestino = $value["destino"];
					$agregarImagen = $db->query("INSERT INTO imagen(descripcion, url, lugar) VALUES('$idesc', '$idestino', $idLugar)");
				}

				$updateUsuario = $db->query("UPDATE usuarioregistrado SET negocio = 1 WHERE id_usuarioregistrado = $idUsuario");

				echo 1;
			} else {
				$error = $db->error;
				$eliminarLugar = $db->query("DELETE FROM lugar WHERE id_lugar = $idLugar");
				echo 'No se pudo agregar el hotel relacionado al lugar, intentelo nuevamente'.$error;
			}

		} else {
			unlink('../'.$destinoLogo);
			foreach($imagenes as $key => $value) {
				unlink('../'.$value["destino"]);
			}
			echo 'no se pudo agregar el Lugar, intetelo mas tarde';
		}
	} else if($categoria == "Restaurante") {
		$resto_categoria = $_POST["resto_categoria"];

		$parqueo = $_POST["resto_parqueo"] == "true" ? 1 : 0;
		$recreativo = $_POST["resto_recreativo"] == "true" ? 1 : 0;
		$fumadores = $_POST["resto_fumadores"] == "true" ? 1 : 0;
		$servicio = $_POST["resto_servicio"] == "true" ? 1 : 0;
		$internet = $_POST["resto_internet"] == "true" ? 1 : 0;
		$reserva = $_POST["resto_reserva"] == "true" ? 1 : 0;
		
		// var_dump($horario, $turno, $vacunas, $servicio, $entrega);
		$agregarLugar = $db->query("INSERT INTO lugar(nombre_lugar, direccion, latitud_gps, longitud_gps, usuario, descripcion, logo, categoria) VALUES('$nombre_lugar', '$direccion_lugar', $latitud_gps, $longitud_gps, $idUsuario, '$descripcion_lugar', '$destinoLogo', '$categoria')");
		if($agregarLugar) {

			$idLugar = $db->ultimaId();

			
			$agregarResto = $db->query("INSERT INTO restaurante(categoria, parqueo, recreativo, area_fumadores, auto_servicio, internet, reserva_mesa, lugar) VALUES('$resto_categoria', $parqueo, $recreativo, $fumadores, $servicio, $internet, $reserva, $idLugar)");
			if($agregarResto) {
				foreach($contactos as $key => $value) {
					$ctipo = $value["tipo"];
					$cnumero = $value["numero"];
					$agregarContacto = $db->query("INSERT INTO contacto(tipo, numero, lugar) VALUES('$ctipo', '$cnumero', $idLugar)");
				}						
	
				foreach ($imagenes as $key => $value) {
					$idesc = $value["desc"];
					$idestino = $value["destino"];
					$agregarImagen = $db->query("INSERT INTO imagen(descripcion, url, lugar) VALUES('$idesc', '$idestino', $idLugar)");
				}
				echo 1;
			} else {
				$error = $db->error;
				$eliminarLugar = $db->query("DELETE FROM lugar WHERE id_lugar = $idLugar");
				echo 'No se pudo agregar el restaurante relacionado al lugar, intentelo nuevamente'.$error;
			}

		} else {
			unlink('../'.$destinoLogo);
			foreach($imagenes as $key => $value) {
				unlink('../'.$value["destino"]);
			}
			echo 'no se pudo agregar el Lugar, intetelo mas tarde';
		}
	}
}
?>