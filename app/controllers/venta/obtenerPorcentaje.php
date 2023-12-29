<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::buscarImpuestoProducto(strtoupper($_POST["producto_id"]));
echo json_encode($data);
