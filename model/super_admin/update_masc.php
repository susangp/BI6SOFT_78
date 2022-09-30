<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM mascota, tipo_mascotas, persona WHERE mascota.id_tipo_masc = tipo_mascotas.id_tipo_masc AND mascota.identificacion = persona.identificacion AND  persona.identificacion = '" . $_GET['id'] . "'";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_assoc($query)
?>

<?php
if (isset($_POST["update"])) {
    $id_mascota = $_POST['id_mascota'];
    $nom_mas = $_POST['nom_mas'];
    $color = $_POST['color_mas'];
    $raza = $_POST['raza'];
    $identificacion = $_POST['identificacion'];
    $id_tip_masc = $_POST['id_tipo_masc'];
    $sql_update = "UPDATE mascota SET nom_mas = '$nom_mas', color_mas = '$color', raza = '$raza', identificacion = '$identificacion', id_tipo_masc = '$id_tip_masc', id_mascota = '$id_mascota' WHERE id_mascota = '" . $_GET['id'] . "'";
    $cs = mysqli_query($mysqli, $sql_update);
    echo '<script>alert (" Actualización Exitosa ");</script>';
} elseif (isset($_POST["delete"])) {

    $sqldelete = "DELETE FROM mascota WHERE id_mascota ='" . $_GET['id'] . "'";
    $cs = mysqli_query($mysqli, $sqldelete);
    echo '<script>alert ("Registro eliminado Exitosamente ");</script>';
}

?>
<!DOCTYPE html>
<html lang="es">
<script>
    function centrar() {
        iz = (screen.width - document.body.clientWidth) / 2;
        de = (screen.height - document.body.clientHeight) / 2;
        moveTo(iz, de);
    }
</script>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Actualizar</title>
</head>

<body onload="centrar();">
    <table class="tabl">
        <form name="consult" method="POST" autocomplete="off">

            <tr>
                <td> Id Mascota </td>
                <td> <input name='id_mascota' value="<?php echo $result['id_mascota'] ?>"> </td>
            </tr>

            <tr>
                <td> Nombre mascota </td>
                <td> <input name='nom_mas' value="<?php echo $result['nom_mas'] ?>" readonly> </td>
            </tr>

            <tr>
                <td> Color mascota </td>
                <td> <input name='color_mas' value="<?php echo $result['color_mas'] ?>"> </td>
            </tr>

            <tr>
                <td> Raza</td>
                <td> <input name='raza' value="<?php echo $result['raza'] ?>"> </td>
            </tr>

            <tr>
            <tr>
                <td>Identificacion</td>
                <td> <select name="identificacion">
                        <option value="<?php echo $result['identificacion'] ?>"> <?php echo $result['nombres'] ?> </option>
                        <?php
                        $sql2 = "SELECT * FROM persona where identificacion = 3";
                        $usuarios2 = mysqli_query($mysqli, $sql2);
                        $usua2 = mysqli_fetch_assoc($usuarios2);
                        do {
                        ?>

                        <?php
                        } while ($usua2 = mysqli_fetch_assoc($usuarios2));
                        ?>
                    </select></td>
            </tr>



            <tr>
                <td>Tipo mascota</td>
                <td> <select name="id_tipo_masc">
                        <option value="<?php echo $result['id_tipo_masc'] ?>"> <?php echo $result['tipo_masc'] ?> </option>
                        <?php
                        $sql1 = "SELECT * FROM tipo_mascotas";
                        $usuarios1 = mysqli_query($mysqli, $sql1);
                        $usua1 = mysqli_fetch_assoc($usuarios1);
                        do {
                        ?>

                        <?php
                        } while ($usua1 = mysqli_fetch_assoc($usuarios1));
                        ?>
                    </select></td>
            </tr>

            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <td><input type="submit" name="update" value="Actualizar"></td>
            <td><input type="submit" name="delete" value="Eliminar"></td>
            </tr>
        </form>

    </table>
</body>

</html>