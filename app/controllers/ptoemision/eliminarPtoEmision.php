<?php
include dirname(dirname(__FILE__)) . "../../models/ptoemision.php";
$data = Ptoemision::eliminarPtoEmision($_POST['id']);
echo json_encode($data);
