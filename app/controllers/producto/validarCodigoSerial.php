<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerProductoSerialUl($_POST['serie']);

echo json_encode($data);
