<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
if ($_POST["valor"] == 6) {
  echo json_encode(Reserva::obtenerReservaFecha($_POST["fecha_i"], $_POST["fecha_f"]));
} else {
  echo 0;
}
