<?php
include dirname(dirname(__FILE__)) . "../../models/factura.php";

if ($_POST["valor"] == 1) {
  echo json_encode(Factura::obtenerFacturaProducto($_POST["parametro"]));
} else if ($_POST["valor"] == 2) {

  echo json_encode(Factura::obtenerFacturaCliente($_POST["parametro"]));
} else if ($_POST["valor"] == 3) {
  echo json_encode(Factura::obtenerFacturaVendedor($_POST["parametro"]));
} else if ($_POST["valor"] == 4) {
  echo json_encode(Factura::obtenerFacturaNumero($_POST["parametro"]));
} else if ($_POST["valor"] == 5) {
  echo json_encode(Factura::obtenerFacturaFormaPago($_POST["parametro"]));
} else {
  echo 0;
}

// echo json_encode($_POST);
