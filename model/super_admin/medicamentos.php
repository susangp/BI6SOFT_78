
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM medicamentos WHERE id_medic = '" . $_SESSION['identificacion'] . "' ";
$mascota = mysqli_query($mysqli, $sql);
$masc = mysqli_fetch_assoc($mascota);

//Consulta para personas
$sql3 = "SELECT * FROM persona" ;
$usuarios3 = mysqli_query($mysqli, $sql3);
$usua3 = mysqli_fetch_assoc($usuarios3);
?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")){
    $tp = $_POST['id_medic'];
    $sqladd = " SELECT * FROM medicamentos WHERE id_medic ='$tp' ";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc ($query);

    if ($fila) {
        echo '<script>alert (" Mascota ya existe ");</script>';
        echo '<script>window.location="medicamentos.php"</script>';

        
    }elseif ($_POST['id_medic'] == "" || $_POST['descripcion'] == ""){

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="medicamentos.php"</script>';

    }else{

        $tp = $_POST['id_medic'];
        $desc = $_POST['descripcion'];
        $sqladd = " INSERT INTO medicamentos (id_medic,descrip_medic)VALUES ('$tp','$desc') ";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="medicamentos.php"</script>';

    }
  
}


?>
<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua3['nombres']?></td>
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
    <title>medicamentos</title>
</head>
    <body onload="frmadd.tip_mascota.focus()">
        <section class="title" >

            <h1>Formulario de Medicamentos </h1>
        </section>

        <table class="centrar" >
            <form method="POST" name="frmadd" autocomplete="off">

                <tr>

                    <td colspan="2">Medicamentos </td>


                </tr>

                <tr>

                    <td >Id Medicamentos</td>
                    <td><input type="text" name="id_medic" placeholder="Ingrese el código" style="text-transform: uppercase;"> </td>

                </tr>


                 <tr>

                    <td >Descripción</td>
                    <td><input type="text" name="descripcion" placeholder="Ingrese una descripcion" style="text-transform: uppercase;"> </td>


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