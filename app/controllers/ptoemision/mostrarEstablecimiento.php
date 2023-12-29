<?php
include dirname(dirname(__FILE__)) . "../../models/ptoemision.php";
$data = Ptoemision::mostrarEstablecimientos();
echo json_encode($data);
