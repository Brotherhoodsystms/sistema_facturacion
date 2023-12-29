<?php
include dirname(dirname(__FILE__)) . "../../models/gastos.php";
$data = Gastos::obtenerGastoId($_POST['id']);
echo json_encode($data);
