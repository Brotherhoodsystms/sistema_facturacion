<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerProductos();
echo json_encode($data);
