<?php
include dirname(dirname(__FILE__)) . "../../models/mercaderia.php";
$data = Mercaderia::eliminarMercaderia($_POST['id']);
echo json_encode($data);
