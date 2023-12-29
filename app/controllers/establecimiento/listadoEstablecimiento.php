<?php
include dirname(dirname(__FILE__)) . "../../models/establecimiento.php";
$data = Establecimiento::obtenerEstablecimientos();
//var_dump($data);
echo json_encode($data);
