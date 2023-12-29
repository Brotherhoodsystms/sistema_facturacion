<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerUltimoCodigoAuto();
//$obtenerCodigo=Producto::obtenerCodigoSerial($data['ultimo']);
$nuevo_codigo=$data['ultimo']+1;
//echo $nuevo_codigo=$data['ultimo']+1;
echo json_encode($nuevo_codigo);