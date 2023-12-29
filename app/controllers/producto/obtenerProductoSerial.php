<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerProductoSerial(strtoupper($_POST["producto_codigoserial"]));
echo json_encode($data);
