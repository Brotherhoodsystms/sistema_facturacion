<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerProductoId($_POST['id']);
echo json_encode($data);
