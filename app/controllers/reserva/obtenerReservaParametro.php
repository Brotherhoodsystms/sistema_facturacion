<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";


if ($_POST["valor"] == 1) {
  echo json_encode(Reserva::obtenerReservaProducto($_POST["parametro"]));
} else if ($_POST["valor"] == 2) {
  var_dump($_POST['parametro']);
exit();
  echo json_encode(Reserva::obtenerReservaCliente($_POST["parametro"]));
} else if ($_POST["valor"] == 3) {
  echo json_encode(Reserva::obtenerReservaVendedor($_POST["parametro"]));
} else if ($_POST["valor"] == 4) {
  echo json_encode(Reserva::obtenerReservaNumero($_POST["parametro"]));
} else if ($_POST["valor"] == 5) {
  echo json_encode(Reserva::obtenerReservaFormaPago($_POST["parametro"]));
} else {
  echo 0;
}

// echo json_encode($_POST);
