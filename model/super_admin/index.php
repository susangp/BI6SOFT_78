<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>
<form method="POST">

    <tr>
        <td colspan='2' align="center"><?php echo $usua['nombres'] ?></td>
    </tr>
    <tr><br>
        <td colspan='2' align="center">


            <input type="submit" value="Cerrar sesión" name="btncerrar" />
        </td>
        <input type="submit" formaction="../administrador/index.php" value="Regresar" />
    </tr>
</form>

<?php

if (isset($_POST['btncerrar'])) {
    session_destroy();


    header('location: ../../index.html');
}

?>

</div>

</div>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>taller</title>
</head>

<body>
    <section class="title">
        <h1>INTERFAZ <?php echo $usua['tipo_usuario'] ?></h1>
    </section>

    <nav class="navegacion">

        <ul class="menu wrapper">

            <li class="first-item">
                <a href="agreg_tip_usu.php">
                    <img src="img/analisis.png" alt="" class="imagen">
                    <span class="text-item">Crear Tipo de Usuario</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="personas.php">
                    <img src="img/ejecucion.png" alt="" class="imagen">
                    <span class="text-item">Crear Persona</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="estado.php">
                    <img src="img/implementar.jpg" alt="" class="imagen">
                    <span class="text-item">Estado</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="mascota.php">
                    <img src="img/planear.png" alt="" class="imagen">
                    <span class="text-item">Mascota</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="tipo_mascota.php">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">Tipo Mascota</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li class="first-item">
                <a href="afiliacion.php">
                    <img src="img/analisis.png" alt="" class="imagen">
                    <span class="text-item">Afiliación</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">OPCION 7</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">OPCION 8</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="lista_usuarios.php">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">Lista de Usuarios</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">OPCION 10</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="#">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">OPCION 11</span>
                    <span class="down-item"></span>
                </a>
            </li>

        </ul>

    </nav>
</body>

</html>