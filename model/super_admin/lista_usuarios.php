<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>



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
    <link rel="stylesheet" href="../../controller/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../controller/image/logo y slogan.png">
    <link rel=" stylesheet" href="../../controller/css/style.css">
    <link rel=" stylesheet" href="estilos.css">
    <title>taller</title>
</head>

<body onload="frmadd.tip_usu.focus()">
    <header class="header">
        <nav class="navbar navbar-inverse" role="banner">
            <br>
            <label for="" class="brand" href="i../super_admin/index.php">
                <a href="../super_admin/index.php"> <img src="../../controller/image/logo y slogan.png" alt=""></a>


            </label>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">


                    <form method="POST">

                        <tr>
                            <td colspan='2' align="center"><?php echo $usua['nombres'] ?></td>
                        </tr>




                        <tr>

                            <td colspan='2' align="center">


                                <input class="btn btn-outline-primary" type="submit" value="Cerrar sesión" name="btncerrar" />
                            </td>
                            <input type="submit" formaction="../super_admin/index.php" value="Regresar" />

                        </tr>
                    </form>




                </ul>
            </div>


        </nav>

    </header>
    <br>
    <br>
    <br>
    <br>


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
            //$sql = "SELECT * FROM persona, tipo_usuario, estado WHERE persona.id_tip_usuario = tipo_usuario.id_tip_usuario AND persona.id_estado = estado.id_estado";
            $i = 0;
            $query = mysqli_query($mysqli, $sql);
            while ($result = mysqli_fetch_assoc($query)) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result['identificacion'] ?></td>
                    <td><?php echo $result['nombres'] ?></td>
                    <td><?php echo $result['apellidos'] ?></td>
                    <td><?php echo $result['direccion'] ?></td>
                    <td><?php echo $result['tipo_usuario'] ?></td>
                    <td><?php echo $result['tipo_estado'] ?></td>
                    <td><a href="?id=<?php echo $result['identificacion'] ?>" onclick="window.open('update.php?id=<?php echo $result['identificacion'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                    <td>&nbsp;</td>
                </tr>

            <?php } ?>

        </form>

    </table>
</body>

</html>