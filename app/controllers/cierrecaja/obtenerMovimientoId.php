<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
echo json_encode(Cierrecaja::obtenerMovimientoId($_POST["id"]));