<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
$arrayName = array(
  'reserva_id' => $_POST["reserva_id"],
  'valor_abonar' => $_POST["valor_abonar"],
  'saldo_pendiente' => $_POST["saldo_pendiente"]
);
echo json_encode(Reserva::actualizarReservaAbono($arrayName));
