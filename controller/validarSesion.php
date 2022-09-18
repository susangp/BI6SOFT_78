<?php
//Archivo que permite validar la sesi�n

if (!isset($_SESSION['identificacion']) || !isset($_SESSION['id_tip_usuario'])) {
	header("Location: ../index.html");
	exit;
}
