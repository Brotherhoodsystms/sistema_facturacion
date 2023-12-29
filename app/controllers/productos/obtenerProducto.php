<?php
include dirname(dirname(__FILE__)) . "../../models/productos.php";
$data = Productos::obtenerProductoId($_POST['id']);
echo json_encode($data);
