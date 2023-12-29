<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::obtenerUbicacion();
echo json_encode($data);
