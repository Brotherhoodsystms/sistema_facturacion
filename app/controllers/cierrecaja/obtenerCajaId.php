<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
echo json_encode(Cierrecaja::obtenerCajaId($_POST["id"]));