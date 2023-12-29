<?php
include dirname(dirname(__FILE__)) . "../../models/bodega.php";
$data = Bodega::obtenerBodegaId($_POST['id']);
echo json_encode($data);
