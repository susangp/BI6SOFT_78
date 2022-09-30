<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>

<?php
//Consulta para los medicamentos
$sql1 = "SELECT * FROM medicamentos";
$usuarios1 = mysqli_query($mysqli, $sql1);
$usua1 = mysqli_fetch_assoc($usuarios1);

//Consulta para las visitas
$sql2 = "SELECT * FROM visitas" ;
$usuarios2 = mysqli_query($mysqli, $sql2);
$usua2 = mysqli_fetch_assoc($usuarios2);


//Consulta para personas
$sql3 = "SELECT * FROM persona" ;
$usuarios3 = mysqli_query($mysqli, $sql3);
$usua3 = mysqli_fetch_assoc($usuarios3);


?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")) {
    $idMed = $_POST['id_med_visi'];
    //$idVisita = $_POST['id_visitaPOST']; 
    $sqladd = " SELECT * FROM historia_clinica WHERE id_med_visi ='$idMed' ";
    //$sqladd = " SELECT * FROM historia_clinica WHERE id_visitaPOST ='$idVisita' ";
    $query = mysqli_query($mysqli, $sqladd);
    $fila = mysqli_fetch_assoc($query);

    if ($fila) {
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="historia_clinica.php"</script>';
    } elseif ($_POST['id_visitaPOST'] == "" || $_POST['id_medicPOST'] == "" ) {

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="historia_clinica.php"</script>';
    } else {
        $idVisita = $_POST['id_visitaPOST']; 
        $idMedic = $_POST['id_medicPOST']; 
        $sqladd = " INSERT INTO historia_clinica (id_visita,id_medic) VALUES ('$idVisita','$idMedic') ";
        $query = mysqli_query($mysqli, $sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="historia_clinica.php"</script>';
    }
}


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

<body onload="frmadd.id_med_visi.focus()">

    <header class="header">
        <nav class="navbar navbar-inverse" role="banner">
            <br>
            <label for="" class="brand" href="../super_admin/index.php">
                <a href="../super_admin/index.php"> <img src="../../controller/image/logo y slogan.png" alt=""></a>


            </label>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">


                    <form method="POST">

                        <tr>
                            <td colspan='2' align="center"><?php echo $usua3['nombres'] ?></td>
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


    <table class="centrar">
        <form method="POST" name="frmadd" autocomplete="off">

            <tr>

                <td colspan="2">Crear historia clínica</td>


            </tr>
           
            <!-- INGRESO CAMPO id_visita VARCHAR (15) -->
            <tr>

                <td>Id visita</td>
                <td>
                    <select name="id_visitaPOST">
                        <option value=""> Seleccione una opción:</option>
                        
                        <?php
                        do {
                        ?>
                            <option value="<?php echo ($usua2['id_visita']) ?>"> <?php echo ($usua2['id_visita']) ?><?php echo ("-") ?><?php echo ($usua2['fecha_visita']) ?>
                            <?php

                        } while ($usua2 = mysqli_fetch_assoc($usuarios2));

                            ?> 

                    </select>


                </td>


            </tr>


            <!-- INGRESO CAMPO id_medic VARCHAR (15) -->
            <tr>

            <td>Id medicamento</td>
            <td>
                <select name="id_medicPOST">
                    <option value=""> Seleccione una opción:</option>
                    
                    <?php
                    do {
                    ?>
                        <option value="<?php echo ($usua1['id_medic']) ?>"> <?php echo ($usua1['descrip_medic']) ?>
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