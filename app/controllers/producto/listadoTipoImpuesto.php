<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerImpuesto();
echo json_encode($data);
