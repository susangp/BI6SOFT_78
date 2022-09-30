<?php
session_start(); //conexion a la base de datos
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM mascota, tipo_mascotas WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND mascota.id_tipo_masc = tipo_mascotas.id_tipo_masc";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>



<?php

if (isset($_POST['btncerrar'])) { //para cerrar sesion
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
    <title>Lista de Mascotas</title>
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

                <!--para deja espacio-->

                <td>Nombres mascota</td>
                <td>Color mascota</td>
                <td>Raza</td>
                <td>Identificacion</td>
                <td>id tipo mascota</td>
                <td> tipo mascota</td>
                <td>Accción</td>
            </tr>

            <?php
            //consulta a la base de datos
            $sql = "SELECT * FROM mascota, tipo_mascotas, persona WHERE mascota.id_tipo_masc = tipo_mascotas.id_tipo_masc AND mascota.identificacion = persona.identificacion"; //consulta a las tablas y enlazamos las tablas por los valores puentes
            $i = 0; //contador
            $query = mysqli_query($mysqli, $sql); //llamamos la variable que tiene la conexion
            while ($result = mysqli_fetch_assoc($query)) {
                $i++; //incrementamos la i de 1 a 1 
            ?>
                <tr>
                    <td><?php echo $result['nom_mas'] ?></td>
                    <td><?php echo $result['color_mas'] ?></td>
                    <td><?php echo $result['raza'] ?></td>
                    <td><?php echo $result['identificacion'] ?></td>
                    <td><?php echo $result['id_tipo_masc'] ?></td>
                    <td><?php echo $result['tipo_masc'] ?></td>

                    <td><a href="?id=<?php echo $result['id_mascota'] ?>" onclick="window.open('update_masc.php?id=<?php echo $result['id_mascota'] ?>','','width= 600,height=500, toolbar=NO');void(null);">Update/Delete</a></td>
                    <td>&nbsp;</td>
                </tr>

            <?php } ?>

        </form>

    </table>
</body>

</html>