<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
$arrayName = array(
  'reserva_numero' => $_POST["reserva_numero"],
  'reserva_fechainicio' => $_POST["reserva_fechainicio"],
  'reserva_fechafinal' => $_POST["reserva_fechafinal"],
  'reserva_cantidad' => $_POST["reserva_cantidad"],
  'reserva_comision' => $_POST["reserva_comision"],
  'reserva_abono' => $_POST["reserva_abono"],
  'reserva_saldopendiente' => $_POST["reserva_saldopendiente"],
  'reserva_total' => $_POST["reserva_total"],
  'vendedor_id' => $_POST["vendedor_id"],
  'formpago_id' => $_POST["formpago_id"],
  'cliente_id' => $_POST["cliente_id"],
  'producto_id' => $_POST["producto_id"]
);
if (Reserva::actualizarProductoStockId($_POST["producto_id"], ($_POST["producto_stock_r"] - $_POST["reserva_cantidad"]))) {
  echo json_encode(Reserva::guardarReserva($arrayName));
}
