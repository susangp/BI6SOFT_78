<?php 
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql="SELECT * FROM persona, tipo_usuario, estado WHERE persona.id_tip_usuario = tipo_usuario.id_tip_usuario AND persona.id_estado = estado.id_estado  AND persona.identificacion = '".$_GET['id']."'";
$query=mysqli_query($mysqli, $sql);
$result=mysqli_fetch_assoc($query)
?>

<?php 
    if (isset ($_POST["update"]))
    {
        $nom = $_POST['nombre'];
        $ape = $_POST['apellido'];
        $dir = $_POST['direccion'];
        $tip_usu = $_POST['tipo_usuario'];
        $tip_est = $_POST['tipo_estado'];
        echo $nom, $ape, $dir, $tip_usu, $tip_est;

        $sql_update = "UPDATE persona SET nombres = '$nom', apellidos = '$ape', direccion = '$dir', id_tip_usuario = '$tip_usu', id_estado = '$tip_est' WHERE identificacion = '".$_GET ['id']."'";
        $cs=mysqli_query($mysqli, $sql_update);
        echo '<script>alert (" Actualización Exitosa ");</script>';
    }
    elseif (isset ($_POST["delete"]))
    {
        $sqldelete="DELETE FROM persona WHERE identificacion ='".$_GET['id']."'";
        $cs=mysqli_query($mysqli, $sqldelete);  
       echo '<script>alert ("Registro eliminado Exitosamente ");</script>';
    }

?>
<!DOCTYPE html>
<html lang="es">
<script> 
function centrar() { 
    iz=(screen.width-document.body.clientWidth) / 2; 
    de=(screen.height-document.body.clientHeight) / 2; 
    moveTo(iz,de); 
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
<table> 
    <form name ="consult"method="POST" autocomplete="off">
        <tr> 
            <td> Identificación </td>
            <td> <input name = 'doc' value = "<?php echo $result ['identificacion']?>" readonly> </td>
        </tr>

        <tr> 
            <td> Nombres </td>
            <td> <input name = 'nombre' value = "<?php echo $result ['nombres']?>"> </td>
        </tr>

        <tr> 
            <td> Apellidos  </td>
            <td> <input name = 'apellido' value = "<?php echo $result ['apellidos']?>" > </td>
        </tr>

        <tr> 
            <td> Dirección  </td>
            <td> <input name = 'direccion' value = "<?php echo $result ['direccion']?>" > </td>
        </tr>       
        
        <tr>
            <td>Tipo Usuario</td>
                <td> <select name="tipo_usuario">
                    <option value= "<?php echo $result['id_tip_usuario']?>"> <?php echo $result['tipo_usuario']?> </option>
                    <?php
                    $sql1 = "SELECT * FROM tipo_usuario";
                    $usuarios1 = mysqli_query($mysqli, $sql1);
                    $usua1 = mysqli_fetch_assoc($usuarios1);                  
                    do {
                        ?>
                            <option value="<?php echo ($usua1['id_tip_usuario']) ?>"> <?php echo ($usua1['tipo_usuario']) ?>
                            <?php
                        } while ($usua1 = mysqli_fetch_assoc($usuarios1));
                        ?>
                    </select></td>
        </tr>
        <tr>
            <td>Estado Usuario</td>
                <td>
                    <select name="tipo_estado">
                    <option value= "<?php echo $result['id_estado']?>"><?php echo $result['tipo_estado']?></option>
                                    <?php
                                    $sql2 = "SELECT * FROM estado where id_estado < 3";
                                    $usuarios2 = mysqli_query($mysqli, $sql2);
                                    $usua2 = mysqli_fetch_assoc($usuarios2);
                                    do {
                                        ?>
                                            <option value="<?php echo ($usua2['id_estado']) ?>"> <?php echo ($usua2['tipo_estado']) ?>
                                            <?php
                                        } while ($usua2 = mysqli_fetch_assoc($usuarios2));
                                        ?>
                                </select>
                            </td>
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