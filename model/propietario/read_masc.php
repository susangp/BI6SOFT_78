<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");

$sql = "SELECT * FROM mascota, tipo_mascotas, persona WHERE mascota.id_tipo_masc = tipo_mascotas.id_tipo_masc AND mascota.identificacion = persona.identificacion AND persona.identificacion = '" . $_GET['id'] . "'"; //mascota.id_mascota = '" . $_GET['id'] . "'";
$query = mysqli_query($mysqli, $sql);
$result = mysqli_fetch_assoc($query)
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
    <title>Historia clínica</title>
</head>

<body onload="centrar();">
    <!-- -->
    <table class="centrar" border=1>
        <form method="GET" name="frmconsulta" autocomplete="off">
            <tr>
                <td>&nbsp;</td>
                <!--para deja espacio-->
                <td>Id</td> <!-- id id_med_visi de tabla historia_clinica --> 
                <td>Fecha visita</td>
                <td>Temperatura</td>
                <td>Peso</td>
                <td>Recomendaciones</td>
                <td>Medicamentos</td>
                <td>Veterinario/a</td>
                                 
                
            </tr>

            <?php
            //consulta a la base de datos
            
            $sql = "SELECT * FROM historia_clinica, visitas, medicamentos, persona, mascota WHERE historia_clinica.id_visita = visitas.id_visita AND medicamentos.id_medic = historia_clinica.id_medic AND persona.identificacion = visitas.identificacion and mascota.id_mascota = visitas.id_mascota and mascota.id_mascota = '" . $_GET['id'] . "' "; 
            $i = 0; //contador
            $query = mysqli_query($mysqli, $sql); //llamamos la variable que tiene la conexion
            while ($result = mysqli_fetch_assoc($query)) {
                $i++; //incrementamos la i de 1 a 1 
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $result['id_visita'] ?></td>
                    <td><?php echo $result['fecha_visita'] ?></td>
                    <td><?php echo $result['temperatura'] ?></td>
                    <td><?php echo $result['peso'] ?></td>
                    <td><?php echo $result['recomendaciones'] ?></td>
                    <td><?php echo $result['descrip_medic'] ?></td>
                    <td><?php echo $result['nombres']?><?php echo (" ")?><?php echo $result['apellidos']?></td>
                    
                    
                    
                </tr>

            <?php } ?>

        </form>

    </table>
</body>

</html>