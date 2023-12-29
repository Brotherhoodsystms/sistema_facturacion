<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";

session_start();
//$datos = 1;
$datos = $_SESSION['idUser'];
$data = Ubicacion::obtenerUbicacionTemporal($datos);
echo json_encode($data);
