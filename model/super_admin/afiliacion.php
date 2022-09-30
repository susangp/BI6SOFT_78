<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);
?>

<?php

//Consulta para los tipos de usuarios
$sql1 = "SELECT * FROM mascota";
$usuarios1 = mysqli_query($mysqli, $sql1);
$usua1 = mysqli_fetch_assoc($usuarios1);




?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $tp = $_POST['id_afiliacion'];
    $sqladd = " SELECT * FROM afiliacion WHERE id_afilia ='$tp' ";
    $query = mysqli_query($mysqli, $sqladd);
    $fila = mysqli_fetch_assoc($query);

    if ($fila) {
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="afiliacion.php"</script>';
    } elseif ($_POST['fecha'] == "" || $_POST['id_masc'] == "") {

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="afiliacion.php"</script>';
    } else {

        $id_afilia = $_POST['id_afiliacion'];
        $fecha_afilia = $_POST['fecha'];
        $id_mascota = $_POST['id_masc'];


        $sqladd = " INSERT INTO afiliacion (id_afilia, fecha_afilia, id_mascota) VALUES ('$id_afilia ', '$fecha_afilia', '$id_mascota') ";
        $query = mysqli_query($mysqli, $sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="afiliacion.php"</script>';
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
    <title>Afiliación</title>
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

    <table class="centrar">
        <form method="POST" name="frmadd" autocomplete="off">

            <tr>

                <td colspan="2">Crear Afiliacion</td>


            </tr>

            <tr>

                <td>fecha afiliacion</td>
                <td><input type="date" name="fecha" placeholder="Ingrese su fecha" style="text-transform: uppercase;"> </td>


            </tr>


            <tr>

                <td>Id Mascota</td>
                <td>
                    <select name="id_masc">
                        <option value=""> Seleccione una opción </option>
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($usua1['id_mascota']) ?>"> <?php echo ($usua1['id_mascota']) ?>
                            <?php

                        } while ($usua1 = mysqli_fetch_assoc($usuarios1));

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