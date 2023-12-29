<?php
include dirname(dirname(__FILE__)) . "../../models/factura.php";
$data = Factura::anularFactura($_POST['id']);
echo json_encode($data);
