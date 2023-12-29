<?php
include dirname(dirname(__FILE__)) . "../../models/productos.php";
$idProducto = $_POST["id"];
//echo $idProducto;
echo json_encode(Productos::eliminarProductos($idProducto));