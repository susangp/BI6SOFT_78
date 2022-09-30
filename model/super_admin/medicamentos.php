
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$mascota = mysqli_query($mysqli, $sql);
$masc = mysqli_fetch_assoc($mascota);

?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")){
    $tp = $_POST['id_medic'];
    $sqladd = " SELECT * FROM medicamentos WHERE id_medic ='$tp' ";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc ($query);

    if ($fila) {
        echo '<script>alert (" Medicamento ya existe ");</script>';
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
<?php 

if(isset($_POST['btncerrar']))
{
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
    <title>Medicamentos</title>
</head>
    <body onload="frmadd.tip_mascota.focus()">
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

        <table class="centrar" >
            <form method="POST" name="frmadd" autocomplete="off">

            <tr>

                <td colspan="2">Formulario de Medicamentos </td>

            </tr>

            <tr>

                <td>Id Medicamentos</td>
                <td><input type="text" name="id_medic" placeholder="Ingrese código medicamento" style="text-transform: uppercase;"> </td>
            </tr>

            <tr>

                <td>Nombre del Medicamento</td>
                <td><input type="text" name="descripcion" placeholder="Ingrese nombre medicamento" style="text-transform: uppercase;"> </td>
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