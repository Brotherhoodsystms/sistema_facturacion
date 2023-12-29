<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::obtenerUbicacionIdParaProduU($_POST['id']);
echo json_encode($data);