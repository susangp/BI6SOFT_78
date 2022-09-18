
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
$sql1 = "SELECT * FROM tipo_usuario";
$usuarios1 = mysqli_query($mysqli, $sql1);
$usua1= mysqli_fetch_assoc($usuarios1);

//Consulta para los tipos de estados
$sql2 = "SELECT * FROM estado where id_estado < 3";
$usuarios2 = mysqli_query($mysqli, $sql2);
$usua2= mysqli_fetch_assoc($usuarios2);


?>

<?php
if ((isset($_POST["btnguardar"])) && ($_POST["btnguardar"] == "frmadd")){
    $tp = $_POST['docu'];
    $sqladd = " SELECT * FROM persona WHERE identificacion ='$tp' ";
    $query = mysqli_query($mysqli,$sqladd);
    $fila = mysqli_fetch_assoc ($query);

    if ($fila) {
        echo '<script>alert (" El usuario ya existe ");</script>';
        echo '<script>window.location="personas.php"</script>';

        
    }elseif ($_POST['docu'] == "" || $_POST['nombre'] == "" || $_POST['apellido'] == "" || $_POST['direccion'] == "" || $_POST['telefono'] == "" || $_POST['email'] == "" || $_POST['contrasena'] == "" || $_POST['tp'] == "" || $_POST['id_tip'] == "" || $_POST['id_estado'] == ""){

        echo '<script>alert (" Existen campos vacios ");</script>';
        echo '<script>window.location="personas.php"</script>';

    }else{

        $docu = $_POST['docu'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dir = $_POST['direccion'];
        $tel = $_POST['telefono'];
        $email = $_POST['email'];
        $contra = $_POST['contrasena'];
        $tp = $_POST['tp'];
        $tipo_usu = $_POST['id_tip'];
        $tipo_estado = $_POST['id_estado'];

        $sqladd = " INSERT INTO persona (identificacion, nombres, apellidos, direccion, telefono, correo, num_tarjeta, contrasena, id_tip_usuario, id_estado) VALUES ('$docu', '$nombre', '$apellido', ' $dir', '$tel', '$email','$tp', '$contra',   '$tipo_usu', '$tipo_estado') ";
        $query = mysqli_query($mysqli,$sqladd);
        echo '<script>alert (" Ingreso Exitoso! ");</script>';
        echo '<script>window.location="personas.php"</script>';

    }
  
}


?>
<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombres']?></td>
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
    <body onload="frmadd.tip_usu.focus()">
        <section class="title" >

            <h1>Formulario de Creacion Personas   <?php echo $usua['tipo_usuario'] ?></h1>
        </section>

        <table class="centrar" >
            <form method="POST" name="frmadd" autocomplete="off">

                <tr>

                    <td colspan="2">Crear Personas </td>


                </tr>

                <tr>

                    <td >Documento de Identidad</td>
                    <td><input type="text" name="docu" placeholder="Ingrese su Documento"> </td>


                </tr>


                <tr>

                    <td >Nombres</td>
                    <td><input type="text" name="nombre" placeholder="Ingrese sus Nombre" style="text-transform: uppercase;"> </td>


                </tr>

                
                <tr>

                    <td >Apellidos</td>
                    <td><input type="text" name="apellido" placeholder="Ingrese sus Apellidos" style="text-transform: uppercase;"> </td>


                </tr>

                <tr>

                    <td >Direccion</td>
                    <td><input type="text" name="direccion" placeholder="Ingrese su Dirección de Residencia" style="text-transform: uppercase;"> </td>


                </tr>

                
                <tr>

                    <td >Telefono</td>
                    <td><input type="text" name="telefono" placeholder="Ingrese su Teléfono" style="text-transform: uppercase;"> </td>


                </tr>

                <tr>

                    <td >Correo</td>
                    <td><input type="text" name="email" placeholder="Ingrese su Correo" > </td>


                </tr>

                
                <tr>

                    <td >Contraseña</td>
                    <td><input type="password" name="contrasena" placeholder="Ingrese su Contraseña" > </td>


                </tr>

                
                <tr>

                    <td >Tarjeta Profesional</td>
                    <td><input type="number" name="tp" placeholder="Ingrese su Número de Tarjeta" value=0 > </td>


                </tr>

                 <tr>

                    <td >Tipo Usuario</td>
                    <td>
                        <select name ="id_tip">
                        <option value = ""> Seleccione una opción </option>
                        <?php 
                        do {                        
                        ?>
                        <option value = "<?php echo ($usua1['id_tip_usuario']) ?>"> <?php echo ($usua1['tipo_usuario']) ?> 
                        <?php 
                        }while ($usua1= mysqli_fetch_assoc($usuarios1));
                    
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
                        do {                        
                        ?>
                        <option value = "<?php echo ($usua2['id_estado']) ?>"> <?php echo ($usua2['tipo_estado']) ?> 
                        <?php 
                        }while ($usua2= mysqli_fetch_assoc($usuarios2));
                    
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