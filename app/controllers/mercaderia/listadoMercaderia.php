<?php
include dirname(dirname(__FILE__)) . "../../models/mercaderia.php";
$data = Mercaderia::obtenerMercaderia();
echo json_encode($data);
