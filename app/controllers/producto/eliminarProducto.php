<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$idProducto = $_POST["id"];
//echo $idProducto;
echo json_encode(Producto::eliminarProductos($idProducto));