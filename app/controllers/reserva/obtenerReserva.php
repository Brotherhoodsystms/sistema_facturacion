<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";

echo json_encode(Reserva::obtenerReservaProductoId($_POST["id"]));


// echo json_encode($_POST);
