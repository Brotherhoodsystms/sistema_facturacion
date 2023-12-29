<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::obtenerUbicacionIdParaProduCantidad($_POST['id']);
echo json_encode($data);