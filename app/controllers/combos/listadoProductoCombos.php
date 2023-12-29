<?php
include dirname(dirname(__FILE__)) . "../../models/combos.php";

$data = Combos::obtenerDetalleCombos($_POST["idProducto"]);
echo json_encode($data);