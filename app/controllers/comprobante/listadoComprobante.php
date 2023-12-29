<?php
include dirname(dirname(__FILE__)) . "../../models/comprobante.php";
$data = Comprobante::obtenerComprobante();
echo json_encode($data);
