<?php

require_once("../../db/connection.php");

?>


<?php
$control = "SELECT * From tipo_usuario WHERE id_tip_usuario >= 2";
$query = mysqli_query($mysqli, $control);
$fila = mysqli_fetch_assoc($query);
?>



<?php
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "formreg")) {
    $identificacion =    $_POST['identificacion'];
    $nombres =          $_POST['nombres'];
    $apellidos =        $_POST['apellidos'];
    $direccion =        $_POST['direccion'];
    $telefono =         $_POST['telefono'];
    $correo =           $_POST['correo'];
    $num_tarjeta =      $_POST['num_tarjeta'];
    $contrasena =       $_POST['contrasena'];
    $id_tip_usuario =   $_POST['id_tip_usuario'];
    $id_estado =        1;



    $validar = "SELECT * FROM persona WHERE identificacion='$identificacion'";
    $queryi = mysqli_query($mysqli, $validar);
    $fila1 = mysqli_fetch_assoc($queryi);

    if ($fila1) {
        echo '<script>alert ("DOCUMENTO O USUARIO EXISTEN //CAMBIELOS//");</script>';
        echo '<script>windows.location="registrousu.php"</script>';
    } else if ($identificacion == "" || $nombres == "" || $apellidos == "" || $direccion == "" || $telefono == "" || $correo == "" || $num_tarjeta == "" || $contrasena == "" || $id_tip_usuario == "" || $id_estado == "") {
        echo '<script>alert ("EXISTEN DATOS VACIOS");</script>';
        echo '<script>windows.location="registrousu.php"</script>';
    } else {

        $insertsql = "INSERT INTO persona(identificacion,nombres,apellidos,direccion,telefono,correo,num_tarjeta,contrasena,id_tip_usuario,id_estado) VALUES('$identificacion','$nombres','$apellidos','$direccion','$telefono','$correo',$num_tarjeta,'$contrasena',$id_tip_usuario,$id_estado)";
        mysqli_query($mysqli, $insertsql) or die(mysqli_error());
        echo '<script>alert (" Registro Exitoso, Gracias");</script>';
        echo '<script>window.location="index2.html"</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>PetPalace</title>
</head>

<body>



    <header class="header">
        <nav class="navbar navbar-inverse" role="banner">
            <br>
            <label for="" class="brand" href="index1.php">
                <a href="index1.php"> <img src="image/logo y slogan.png" alt=""></a>


            </label>

            <div class="collapse navbar-collapse navbar-right">
                <ul class="nav navbar-nav">


                    <li class="btn btn-info"><a href="index.php">Perfil</a></li>



                </ul>
            </div>


        </nav>

    </header>











    <div class="login-box">
        <img src="image/logo-pet-1.png" class="avatar" alt="Imagen Avar">

        <form method="POST" name="formreg" autocomplete="off">
            <label for="usuario"> REGISTRO DE USUARIOS </label>
            <input type="text" name="identificacion" placeholder="Ingrese Documento Identidad">
            <input type="text" name="nombres" placeholder="Ingrese Nombres Completos">
            <input type="text" name="apellidos" placeholder="Ingrese apellidos">
            <input type="text" name="direccion" placeholder="Ingrese direccion">
            <input type="text" name="telefono" placeholder="Ingrese telefono">
            <input type="text" name="correo" placeholder="Ingrese un correo">
            <input type="text" name="num_tarjeta" placeholder="numero de tarjeta">
            <input type="password" name="contrasena" placeholder="contraseña">


            <!--select-->



            <select name="id_tip_usuario">
                <option value="">Seleccione uno...</option>


                <?php
                do {

                ?>
                    <option value="<?php echo ($fila['id_tip_usuario']) ?>"> <?php echo ($fila['tipo_usuario']) ?>

                    <?php
                } while ($fila = mysqli_fetch_assoc($query));

                    ?>
            </select>


            <input type="submit" name="validar" value="Registrarme">
            <input type="hidden" name="MM_insert" value="formreg">
        </form>



    </div>
</body>

</html>