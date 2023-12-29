<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerClientesVenta();
echo json_encode($data);