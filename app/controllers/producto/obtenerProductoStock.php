<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerProductoStockId($_POST["id"]);
echo json_encode($data['ubicacion_cantidad']);
