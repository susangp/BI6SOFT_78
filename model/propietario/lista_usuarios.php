<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<form method="POST">

<tr>
    <td colspan='2' align="center"><?php echo $usua['nombres'] ?></td>
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


header('location: ../../index.html');
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Personas</title>
</head>

<body onload="frmadd.tip_usu.focus()">
    <section class="title">

        <h1>Formulario Lista de Usuarios <?php echo $usua['tipo_usuario'] ?></h1>
    </section>

    <table class="centrar" border=1>
        <form method="GET" name="frmconsulta" autocomplete="off">
            <tr>
                <td>&nbsp;</td>
                <td>Identificacion</td>
                <td>Nombres</td>
                <td>Apellidos</td>
                <td>Dirección</td>
                <td>Tipo de Usuario</td>
                <td>Estado</td>
                <td>Accción</td>
                <td>&nbsp;</td>
            </tr>
            <?php 
                $sql = "SELECT * FROM persona, tipo_usuario, estado WHERE persona.id_tip_usuario = tipo_usuario.id_tip_usuario AND persona.id_estado = estado.id_estado";
                $i = 0;
                $query = mysqli_query ($mysqli, $sql);
                while ($result = mysqli_fetch_assoc($query)){
                    $i++;            
            ?>
            <tr>
                <td><?php echo $i?></td>
                <td><?php echo $result ['identificacion']?></td>
                <td><?php echo $result ['nombres']?></td>
                <td><?php echo $result ['apellidos']?></td>
                <td><?php echo $result ['direccion']?></td>
                <td><?php echo $result ['tipo_usuario']?></td>
                <td><?php echo $result ['tipo_estado']?></td>
                <td><a href="?id=<?php echo $result['identificacion'] ?>" onclick="window.open('update.php?id=<?php echo $result['identificacion'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                <td>&nbsp;</td>
            </tr>

            <?php } ?>

        </form>

    </table>
</body>

</html>