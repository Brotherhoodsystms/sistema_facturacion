<?php
include dirname(dirname(__FILE__)) . "../../models/emisor.php";
$data = Emisor::obtenerEmisorId($_POST['id']);
echo json_encode($data);
