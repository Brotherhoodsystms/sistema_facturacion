<?php
include dirname(dirname(__FILE__)) . "../../models/ptoEmision.php";
$data = Ptoemision::obtenerPtoemision($_POST["id"]);
echo json_encode($data);
