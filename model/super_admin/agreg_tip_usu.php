<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $tp = $_POST['tip_usu'];
    $sqladd = " SELECT * FROM tipo_usuario WHERE tipo_usuario ='$tp' ";
    $query = mysqli_query($mysqli, $sqladd);
    $fila = mysqli_fetch_assoc($query);

    if ($fila) {
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="agreg_usu.php"</script>';
    } elseif ($_POST['tip_usu'] == "") {

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="agreg_usu.php"</script>';
    } else {

        $tp = $_POST['tip_usu'];
        $sqladd = " INSERT INTO tipo_usuario(tipo_usuario)VALUES ('$tp') ";
        $query = mysqli_query($mysqli, $sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="agreg_usu.php"</script>';
    }
}


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


    header('location: ../../index2.html');
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
    <link rel="stylesheet" href="estilos.css">
    <title>taller</title>
</head>

<body onload="frmadd.tip_usu.focus()">
    <section class="title">

        <h1>Formulario de creacion tipo usuarios <?php echo $usua['tipo_usuario'] ?></h1>
    </section>

    <table class="centrar">
        <form method="POST" name="frmadd" autocomplete="off">

            <tr>

                <td colspan="2">Tipos de Usuarios </td>


            </tr>

            <tr>

                <td>Idientificador</td>
                <td><input type="text" readonly> </td>


            </tr>


            <tr>

                <td>Tipo Usuario</td>
                <td><input type="text" name="tip_usu" placeholder="Ingrese tipo usuario" style="text-transform: uppercase;"> </td>


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