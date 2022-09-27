<?php
session_start();
require_once("../../db/connection.php");
include("../../controller/validarSesion.php");
$sql = "SELECT * FROM persona, tipo_usuario WHERE identificacion = '" . $_SESSION['identificacion'] . "' AND persona.id_tip_usuario = tipo_usuario.id_tip_usuario";
$usuarios = mysqli_query($mysqli, $sql);
$usua = mysqli_fetch_assoc($usuarios);


?>


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
    <link rel="stylesheet" href="../../controller/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../controller/image/logo-pet-1.png"">
    <link rel=" stylesheet" href="../../controller/css/style.css">
    <link rel=" stylesheet" href="estilos.css">
    <title>PetPalace</title>
</head>

<body>




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
                            <td colspan='2' align="center"><?php echo $usua['nombres'] ?></td>
                        </tr>
                        <tr>

                            <td colspan='2' align="center">


                                <input class="btn btn-outline-primary" type="submit" value="Cerrar sesión" name="btncerrar" />
                            </td>

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
                    <img src="img/persona.PNG" alt="" class="imagen">
                    <span class="text-item">Crear Persona</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="esta2.php">
                    <img src="img/implementar.jpg" alt="" class="imagen">
                    <span class="text-item">Estado</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="mascota.php">
                    <img src="img/crear_mascota.png" alt="" class="imagen">
                    <span class="text-item">Mascota</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="tipo_mascota.php">
                    <img src="img/gatos-perros.png" alt="" class="imagen">
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
                <a href="lista_mascota.php">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">lista de mascotas</span>
                    <span class="down-item"></span>
                </a>
            </li>

            <li>
                <a href="visita.php">
                    <img src="" alt="" class="imagen">
                    <span class="text-item">Visitas</span>
                    <span class="down-item"></span>
                </a>
            </li>

        </ul>

    </nav>
</body>

</html>