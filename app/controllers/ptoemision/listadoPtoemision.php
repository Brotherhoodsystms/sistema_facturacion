<?php
include dirname(dirname(__FILE__)) . "../../models/ptoemision.php";
$data = Ptoemision::obtenerPtolistado();

echo json_encode($data);
