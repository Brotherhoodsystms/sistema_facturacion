<?php
include dirname(dirname(__FILE__)) . "../../models/sucursal.php";
$data = Sucursal::obtenerSucursal();
echo json_encode($data);
