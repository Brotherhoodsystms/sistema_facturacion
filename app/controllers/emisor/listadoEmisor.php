<?php
include dirname(dirname(__FILE__)) . "../../models/emisor.php";
$data = Emisor::obtenerEmisor();
echo json_encode($data);
