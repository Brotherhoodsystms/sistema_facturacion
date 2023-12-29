<?php
include dirname(dirname(__FILE__)) . "../../models/gastos.php";
$data = Gastos::EliminarGasto($_POST['id']);
echo json_encode($data);