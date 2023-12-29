<?php
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
echo json_encode(Cierrecaja::eliminarCaja($_POST["id"]));