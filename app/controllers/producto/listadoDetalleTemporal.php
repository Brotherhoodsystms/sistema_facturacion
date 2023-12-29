<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";

session_start();
//$datos = 1;
$datos = $_SESSION['idUser'];
$data = Producto::obtenerUbicacionTemporal($datos);
echo json_encode($data);
