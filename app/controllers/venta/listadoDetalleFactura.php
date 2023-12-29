<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerDetalleFactura(($_POST["id_factura"]));

echo json_encode($data);
