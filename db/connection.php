<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "pet_palace3";

$mysqli = new mysqli($hostname, $username, $password, $database);

if ($mysqli->connect_errno) {
    die("fallo la conexion" . mysqli_connect_errno());
}
