<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
session_start();
$productos_temporales = Venta::obtenerDetalleTemp($_SESSION['idUser']);
$sumaImpuesto = 0;
foreach ($productos_temporales as $product) {
  $producto = Venta::obtenerProductoById($product['temp_idproducto']);
  if ($producto['tarifaiva_porcentaje'] == 0) {
    $sumaImpuesto = $product['temp_total'] + $sumaImpuesto;
  } else {
    $sumaImpuesto = (($product['temp_total'] * $producto['tarifaiva_porcentaje']) / 100) + $sumaImpuesto + $product['temp_total'];
  }
}
$data = Venta::sumarDetalleTemp($_SESSION['idUser']);
$subtotales = array(
  'sin_impuesto' => round($data['total'],2),
  'com_impuesto' => round($sumaImpuesto,2)
);
echo json_encode($subtotales);
