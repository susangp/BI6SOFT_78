<?php
require_once("../db/connection.php");
session_start();
if ($_POST["inicio"]) {
	// inicia sesion para los usuarios
	$usuario = $_POST["identificacion"];
	$clave = $_POST["contrasena"];


	/// consultamos el usuario segun el usuario y la clave
	$con = "select * from persona where identificacion = '$usuario' and contrasena = '$clave' and id_estado = 1";
	$query = mysqli_query($mysqli, $con);
	$fila = mysqli_fetch_assoc($query);

	if ($fila) {
		/// si el usario y la clave son correctas, creamo las sessiones 

		$_SESSION['identificacion'] = $fila['identificacion'];
		$_SESSION['nombres'] = $fila['nombres'];
		$_SESSION['apellidos'] = $fila['apellidos'];

		$_SESSION['direccion'] = $fila['direccion'];
		$_SESSION['telefono'] = $fila['telefono'];
		$_SESSION['correo'] = $fila['correo'];
		$_SESSION['num_tarjeta'] = $fila['num_tarjeta'];
		$_SESSION['id_tip_usuario'] = $fila['id_tip_usuario'];
		$_SESSION['id_estado'] = $fila['id_estado'];
		//$_SESSION['usuario'] = $fila['usuario'];


		/// dependiendo del tipo de usuario lo redireccinamos a una pagina
		/// si es un client
		if ($_SESSION['id_tip_usuario'] == 1) {
			header("Location: ../model/super_admin/index.php");
			exit();
		}
		/// si es un vendedor
		elseif ($_SESSION['id_tip_usuario'] == 2) {
			header("Location: ../model/administrador/index.php");
			exit();
		} elseif ($_SESSION['id_tip_usuario'] == 3) {
			header("Location: ../model/propietario/index1.php");
			exit();
		} elseif ($_SESSION['id_tip_usuario'] == 4) {
			header("Location: ../model/veterinario/index1.php");
			exit();
		}
	} else {
		/// si el usuario y la clave son incorrectas lo lleva a la pagina de inio y se muestra un mensaje
		header("Location: ../errorlog.html");
		exit();
	}
}
