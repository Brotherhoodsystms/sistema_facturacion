<?php
include dirname(dirname(__FILE__)) . "../../models/combos.php";
session_start();
$productos_temporales = Combos::obtenerDetalleTempCombos($_SESSION['idUser']);
$sumaImpuesto = 0;
foreach ($productos_temporales as $product) {
  $producto = Combos::obtenerProductoById($product['temp_combos_productoid']);
  if ($producto['tarifaiva_porcentaje'] == 0) {
    $sumaImpuesto = $product['temp_combos_total'] + $sumaImpuesto;
  } else {
    $sumaImpuesto = (($product['temp_combos_total'] * $producto['tarifaiva_porcentaje']) / 100) + $sumaImpuesto + $product['temp_combos_total'];
  }
}
$data = Combos::sumarDetalleTempCombos($_SESSION['idUser']);
$subtotales = array(
  'sin_impuesto' => round($data['total'],2),
  'com_impuesto' => round($sumaImpuesto,2)
);
echo json_encode($subtotales);