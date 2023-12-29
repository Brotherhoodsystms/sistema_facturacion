<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/ptoEmision.php";
$sucursal = $_SESSION['sucursal_id'];
$bodega = $_SESSION['bodega_id'];
$data = Ptoemision::obtenerPtoemisionbySucursal($sucursal);
echo json_encode($data);
