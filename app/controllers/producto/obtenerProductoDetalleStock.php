<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerProductoStockDetalleId($_POST["id"]);
echo json_encode($data);