<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$datos = $_SESSION['idUser'];
$data = Producto::sumarDetalleProducto($datos);
echo json_encode($data);