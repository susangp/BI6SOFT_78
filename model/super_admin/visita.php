
<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, estado, mascota,visitas 
WHERE id_visita = '" . $_SESSION['identificacion'] . "' 
AND persona.identificacion = visitas.identificacion 
AND visitas.id_mascota = mascota.id_mascota 
AND visitas.id_estado = estado.id_estado" ;
$visita = mysqli_query($mysqli, $sql);
$visit = mysqli_fetch_assoc($visita);
?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")){
    $id_vis = $_POST['id_visita'];
    $sqladd = " SELECT * FROM visitas WHERE id_visita ='$id_vis' ";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc ($query);

    if ($fila) {
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="visita.php"</script>';

        
    }elseif ($_POST['id_visita'] == "" 
             || $_POST['fecha_visita'] == "" 
             || $_POST['hora_visita'] ==  "" 
             || $_POST['temperatura'] == ""
             || $_POST['frec_cardiaca'] == ""
             || $_POST['frec_respira'] == ""
             || $_POST['peso'] == ""
             || $_POST['recomendaciones'] == ""
             || $_POST['valor_total'] == ""
             || $_POST['identificacion'] == ""
             || $_POST['id_mascota'] == ""
             || $_POST['id_estado'] ==  ""){

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="visita.php"</script>';

    }else{
        $id_visita = $_POST['id_visita'];
        $fecha_visita = $_POST['fecha_visita'];
        $hora_visita = $_POST['hora_visita'];
        $temperatura = $_POST['temperatura'];
        $frec_cardiaca = $_POST['frec_cardiaca'];
        $frec_respira = $_POST['frec_respira'];
        $peso = $_POST['peso'];
        $recomendaciones = $_POST['recomendaciones'];
        $valor_total = $_POST['valor_total'];
        $identificacion = $_POST['identificacion'];
        $id_mascota = $_POST['id_mascota'];
        $id_estado = $_POST['id_estado'];     
        
        $sqladd = " INSERT INTO 
        visita (id_visita, 
                fecha_visita,
                hora_visita,
                temperatura,
                frec_cardiaca,
                frec_respira,
                peso,
                recomendaciones, 
                valor_total,
                identificacion, 
                id_mascota, 
                id_estado) 
        VALUES ('$id_visita', 
                '$fecha_visita',  
                '$hora_visita',
                '$temperatura',  
                '$frec_cardiaca', 
                '$frec_respira',
                '$peso',
                '$recomendaciones', 
                '$valor_total',
                '$identificacion',
                '$id_mascota',
                '$id_estado') ";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="visita.php"</script>';
    }
  
}

?>
<form method="POST">

    <tr>
        
    </tr>
<tr><br>
    <td colspan='2' align="center">    
    
        <input type="submit" value="Cerrar sesión" name="btncerrar" /></td>
        <input type="submit" formaction="../administrador/index.php" value="Regresar" />
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
    <title>Personas</title>
</head>
    <body onload="frmadd.visit.focus()">
        <section class="title" >
            
            <h1>Formulario de Creacion visitas</h1>
        </section>

        <table class="centrar" >
            <form method="POST" name="frmadd" autocomplete="off">

                <tr>
                    <td colspan="2">Crear visita </td>
                </tr>

                <tr>
                    <td >Id visita</td>
                    <td><input type="text" name="id_visita" placeholder="Ingrese visita" > </td>
                </tr>

                <tr>
                    <td >Fecha visita</td>
                    <td><input type="date" name="fecha_visita" placeholder="Fecha visita" style="text-transform: uppercase;"> </td>
                </tr>

                <tr>
                    <td >Hora visita</td>
                    <td><input type="time" name="hora_visita" placeholder="Hora visita" style="text-transform: uppercase;"> </td>
                </tr>
                <tr>
                    <td >Temperatura</td>
                    <td><input type="text" name="temperatura" placeholder="Temperatura" style="text-transform: uppercase;"> </td>
                </tr>
                <tr>
                    <td >Frecuencia cardiaca</td>
                    <td><input type="text" name="frec_cardiaca" placeholder="frecuencia cardiaca" style="text-transform: uppercase;"> </td>
                </tr>
                <tr>
                    <td >Frecuencia respiratoria</td>
                    <td><input type="text" name="frec_respira" placeholder="frecuencia respiratoria" style="text-transform: uppercase;"> </td>
                </tr>
                <tr>
                    <td >Peso</td>
                    <td><input type="text" name="peso" placeholder="Peso" style="text-transform: uppercase;"> </td>
                </tr>
                <tr>
                    <td >Recomendaciones</td>
                    <td><input type="text" name="recomendaciones" placeholder="Recomendaciones" style="text-transform: uppercase;"> </td>
                </tr>
                <tr>
                    <td >Valor Total</td>
                    <td><input type="double" name="valor_total" placeholder="Valor_total" style="text-transform: uppercase;"> </td>
                </tr>
                 <tr>
                    <td >Veterinario</td>
                    <td>
                        <select name ="identificacion">
                          <option value = ""> Seleccione una opción </option>
                          <?php 
                          //Consulta identificacion
                                $sql1 = "SELECT * FROM persona WHERE id_tip_usuario=3 ";
                                $ident = mysqli_query($mysqli, $sql1);
                                $ident_persona= mysqli_fetch_assoc($ident);
                              do {                        
                          ?>

                          <option value = "<?php echo ($ident_persona['identificacion']) ?>"> <?php echo ($ident_persona['nombres']) ?> <?php echo ($ident_persona['apellidos']) ?>
                           <?php 
                               }while ($ident_persona= mysqli_fetch_assoc($ident));                    
                           ?>
                        </select>                 
                    </td>                           
                </tr>
                <tr>
                    <td >Tipo Mascota</td>
                    <td>
                        <select name ="id_mascota">
                        <option value = ""> Seleccione una opción </option>
                        <?php 
                        //Consulta para identificacion mascota
                        $sql2 = "SELECT * FROM tipo_mascotas";
                        $mascota = mysqli_query($mysqli, $sql2);
                        $iden_mascota= mysqli_fetch_assoc($mascota);
                        do {                        
                        ?>
                        <option value = "<?php echo ($iden_mascota['id_tipo_masc']) ?>"> <?php echo ($iden_mascota['tipo_masc']) ?> 
                        <?php 
                        }while ($iden_mascota= mysqli_fetch_assoc($mascota));                    
                        ?>
                        </select>                   
                   </td>                            
                </tr>
                <tr>
                    <td >Tipo Estado</td>
                    <td>
                        <select name ="id_estado">
                        <option value = ""> Seleccione una opción </option>
                        <?php 
                        //Consulta para los tipos de estados
                        $sql3 = "SELECT * FROM estado where id_estado < 3";
                        $estado = mysqli_query($mysqli, $sql3);
                        $iden_estado= mysqli_fetch_assoc($estado);
                        do {                        
                        ?>
                        <option value = "<?php echo ($iden_estado['id_estado']) ?>"> <?php echo ($iden_estado['tipo_estado']) ?> 
                        <?php 
                        }while ($iden_estado= mysqli_fetch_assoc($estado));                    
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