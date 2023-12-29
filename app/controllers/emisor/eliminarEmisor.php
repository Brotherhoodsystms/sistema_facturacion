<?php
include dirname(dirname(__FILE__)) . "../../models/emisor.php";
$data = Emisor::eliminarEmisor($_POST['id']);
echo json_encode($data);
