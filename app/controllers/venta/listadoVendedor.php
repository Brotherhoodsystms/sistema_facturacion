<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerListaVendedores();
echo json_encode($data);
