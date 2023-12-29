<?php
include dirname(dirname(__FILE__)) . "../../models/costo.php";
echo json_encode(Costo::obtenerGasto());
