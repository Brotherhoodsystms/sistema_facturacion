<?php
include dirname(dirname(__FILE__)) . "../../models/tipobodega.php";
$data = Tipobodega::obtenerTipoBodegaId($_POST['id']);
echo json_encode($data);
