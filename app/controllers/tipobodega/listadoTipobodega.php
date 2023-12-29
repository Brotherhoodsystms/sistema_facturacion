<?php
include dirname(dirname(__FILE__)) . "../../models/tipobodega.php";
$data = Tipobodega::obtenerTipoBodegas();
echo json_encode($data);
