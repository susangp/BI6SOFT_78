<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql) or die(mysqli_error());
$usua = mysqli_fetch_assoc($usuarios);
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Estados</title>
	<link rel="stylesheet" type="text/css" href="css/estilos.css">
	<link rel="stylesheet" href="css/font-awesome.css">

	<script src="js/jquery-3.2.1.js"></script>
	<script src="js/main.js"></script>
</head>

<style>
	body {
		background-image: linear-gradient(rgba(179, 181, 187, 0.9), rgba(179, 181, 187, 0.9)), url("img/doctorperrito.jpg");
		background-size: 100% 100%;
		background-repeat: no-repeat;
		background-attachment: fixed;
		overflow: hidden;
	}

	form {
		padding: 70px 50px;
		background-color: #ededed;
		background-image: linear-gradient(rgba(213, 217, 228, 0.80), rgba(213, 217, 228, 0.80)), url("img/descarga.jfif");
		background-repeat: no-repeat;
		background-size: 100% 100%;
		margin: calc(25% + 20px);
		margin-top: 70px;
		padding-top: 70px;
		margin-bottom: 70px
	}

	.avatar {
		padding: 100px;
		margin: auto0;
		margin-top: -225px;
		float: center;
		width: 250px;
		height: 250px;
	}

	h1 {
		text-align: center;
		font-family: century gothic;
		padding: 2px;
		margin-top: -110px;
		color: #ff3a5f
	}

	input {
		width: calc(100% - 100px);
		padding: 7px;
		margin: auto0;
		margin-top: 12px;
		font-size: 12px;
		border-color: #ff3a5f;
		border-radius: 7px;
		color: rgb(71, 67, 67);
	}

	.parent {
		display: flex;
		justify-content: center;
	}

	label {
		text-align: center;
		font-family: Lucida Sans;
		padding: 2px;
		color: #3c62a9;
		margin-top: 50px;
		font-size: 16px;
		font-weight: bold;
	}

	input[type='submit'] {
		background-color: #ff3a5f;
		color: #fff;
		width: calc(40% - 10px);
		margin: 0 30%;
		margin-top: 50px;
		border-color: white;
		border-width: 4px;
		border-style: solid;
		border-radius: 20px;
		text-align: center;
		font-size: 20px;
		font-weight: bold;

	}

	.ok {
		text-align: center;
		width: 100%;
		padding: 12px;
		background-color: #1e6;
		color: #fff
	}

	.bad {
		text-align: center;
		width: 100%;
		padding: 12px;
		background-color: #a22;
		color: #fff
	}

	nav {
		text-align: left;
		font-family: century gothic;
		width: calc(40% - 10px);
		padding: -50px;
		color: #3c62a9;
		margin-top: 50px;
		font-size: 10px;
		font-weight: bold;
	}
</style>
<form method="POST">

	<tr>
		<td colspan='2' align="left"><?php echo $usua['nombres'] ?></td>
	</tr>
	<tr><br>
		<td colspan='2' align="center">


			<input type="submit" value="Cerrar sesión" name="btncerrar" />
		</td>
		<input type="submit" formaction="../super_admin/index.php" value="Regresar" />
	</tr>
</form>

<?php

if (isset($_POST['btncerrar'])) {
	session_destroy();


	header('location: ../../index2.html');
}

?>

</div>

</div>




<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="estilos.css">
	<title>taller</title>
</head>

<body>
	<section class="title">
		<h1>INTERFAZ <?php echo $usua['tipo_usuario'] ?></h1>
	</section>
	<!--    -->
	<form method="post">
		<img src="super_admin/img/logoslogan.png" class="avatar" alt="Avatar Image">
		<!--<img src="../super_admin/image/logoslogan" class="avatar" alt="Avatar Image">-->
		<br>
		<h1>Estados</h1></br>
		<label for="usuario">Seleccione el Tipo Estado </label>
		<input type="text" name="tipo_estado" placeholder="Tipo de Estado">
		<input type="submit" name="register" value="Registrar">
	</form>
	<?php
	include("../../db/connection.php");

	if (isset($_POST['register'])) {
		if (strlen($_POST['tipo_estado']) >= 1) {
			$tipo = trim($_POST['tipo_estado']);
			// $email = trim($_POST['email']);
			// $fechareg = date("d/m/y");
			$consulta = "INSERT INTO estado (tipo_estado) VALUES ('$tipo')";
			$resultado = mysqli_query($mysqli, $consulta);
			if ($resultado) {
	?>
				<h3 class="ok">¡Te has inscripto correctamente!</h3>
			<?php
			} else {
			?>
				<h3 class="bad">¡Ups ha ocurrido un error!</h3>
			<?php
			}
		} else {
			?>
			<h3 class="bad">¡Por favor complete los campos!</h3>
	<?php
		}
	}
	?>
</body>

</html>