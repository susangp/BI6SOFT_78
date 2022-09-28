<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php
//Consulta para los tipos de mascotas
$sql1 = "SELECT * FROM persona WHERE id_tip_usuario  = 3";
$usuarios1 = mysqli_query($mysqli, $sql1);
$usua1 = mysqli_fetch_assoc($usuarios1);

$sql2 = "SELECT * FROM tipo_mascotas";
$usuarios2 = mysqli_query($mysqli, $sql2);
$usua2 = mysqli_fetch_assoc($usuarios2);


?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $tp = $_POST['id_mascota'];
    $sqladd = " SELECT * FROM mascota WHERE id_mascota ='$tp' ";
    $query = mysqli_query($mysqli, $sqladd);
    $fila = mysqli_fetch_assoc($query);

    if ($fila) {
        echo '<script>alert (" La Mascota ya existe ");</script>';
        echo '<script>window.location="mascota.php"</script>';
    } elseif ($_POST['id_mascota'] == "" || $_POST['nombre_mas'] == "" || $_POST['color'] == "" || $_POST['raza'] == "" || $_POST['docu'] == "" || $_POST['id_tip_masc'] == "") {

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="mascota.php"</script>';
    } else {

        $id_mascota = $_POST['id_mascota'];
        $nombremas = $_POST['nombre_mas'];
        $color = $_POST['color'];
        $raza = $_POST['raza'];
        $docu = $_POST['docu'];
        $tipo_mascota = $_POST['id_tip_masc'];

        $sqladd = " INSERT INTO mascota (id_mascota, nom_mas, color_mas, raza, identificacion, id_tipo_masc) VALUES ('$id_mascota', '$nombremas', '$color', ' $raza', '$docu', '$tipo_mascota') ";
        $query = mysqli_query($mysqli, $sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="mascota.php"</script>';
    }
}


?>

<?php

if (isset($_POST['btncerrar'])) {
    session_destroy();


    header('location: ../../index.html');
}

?>

</div>

</div>


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

<body onload="frmadd.id_mascota.focus()">
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

    <table class="centrar">
        <form method="POST" name="frmadd" autocomplete="off">

            <tr>

                <td colspan="2">Crear Mascotas </td>


            </tr>

            <tr>

                <td>Identiicación Mascota</td>
                <td><input type="text" name="id_mascota" placeholder="Ingrese la identificación de la mascota"> </td>


            </tr>

            <tr>

                <td>Nombre Mascota</td>
                <td><input type="text" name="nombre_mas" placeholder="Ingrese el nombre de la mascota" style="text-transform: uppercase;"> </td>


            </tr>


            <tr>

                <td>Color</td>
                <td><input type="text" name="color" placeholder="Ingrese el color" style="text-transform: uppercase;"> </td>


            </tr>

            <tr>

                <td>Raza</td>
                <td><input type="text" name="raza" placeholder="Ingrese la raza" style="text-transform: uppercase;"> </td>


            </tr>

            <tr>

                <td>Identificación</td>
                <td>
                    <select name="docu">
                        <option value=""> Seleccione una opción </option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($usua1['identificacion']) ?>"> <?php echo ($usua1['nombres']) ?> <?php echo ($usua1['apellidos']) ?>
                            <?php
                        } while ($usua1 = mysqli_fetch_assoc($usuarios1));

                            ?>

                    </select>


                </td>

            </tr>

            <tr>

                <td>Tipo Mascotas</td>
                <td>
                    <select name="id_tip_masc">
                        <option value=""> Seleccione una opción </option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($usua2['id_tipo_masc']) ?>"> <?php echo ($usua2['tipo_masc']) ?>
                            <?php
                        } while ($usua2 = mysqli_fetch_assoc($usuarios2));

                            ?>

                    </select>


                </td>

            </tr>



            <tr>

                <td colspan="2">&nbsp; </td>


            </tr>

            <tr>

                <td colspan="2"><input type="submit" name="btnadd" value="Guardar"> </td>
                <input type="hidden" name="btnguardar" value="frmadd">


            </tr>

        </form>

    </table>

</body>

</html>