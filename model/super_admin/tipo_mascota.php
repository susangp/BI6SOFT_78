
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM mascota, tipo_mascotas WHERE id_mascota = '" . $_SESSION['identificacion'] . "' AND mascota.id_tipo_masc = tipo_mascotas.id_tipo_masc";
$mascota = mysqli_query($mysqli, $sql);
$masc = mysqli_fetch_assoc($mascota);


?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")){
    $tp = $_POST['tip_mascota'];
    $sqladd = " SELECT * FROM tipo_mascotas WHERE tipo_masc ='$tp' ";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc ($query);

    if ($fila) {
        echo '<script>alert (" Mascota ya existe ");</script>';
        echo '<script>window.location="tipo_mascota.php"</script>';

        
    }elseif ($_POST['tip_mascota'] == ""){

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="tipo_mascota.php"</script>';

    }else{

        $tp = $_POST['tip_mascota'];
        $sqladd = " INSERT INTO tipo_mascotas (tipo_masc)VALUES ('$tp') ";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="tipo_mascota.php"</script>';

    }
  
}


?>
<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $masc['nombres']?></td>
    </tr>
<tr><br>
    <td colspan='2' align="center">
    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../super_admin/index.php" value="Regresar" />
    </tr>
</form>

<?php 

if(isset($_POST['btncerrar']))
{
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
    <title>Tipo Mascota</title>
</head>
    <body onload="frmadd.tip_mascota.focus()">
        <section class="title" >

            <h1>Formulario de Creación Tipo de Mascotas  <?php echo $masc['tipo_mascotas'] ?></h1>
        </section>

        <table class="centrar" >
            <form method="POST" name="frmadd" autocomplete="off">

                <tr>

                    <td colspan="2">Tipos de Mascotas </td>


                </tr>

                <tr>

                    <td >Id Tipo</td>
                    <td><input type="text" readonly > </td>


                </tr>


                 <tr>

                    <td >Tipo Mascota</td>
                    <td><input type="text" name="tip_mascota" placeholder="Ingrese tipo mascota" style="text-transform: uppercase;"> </td>


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