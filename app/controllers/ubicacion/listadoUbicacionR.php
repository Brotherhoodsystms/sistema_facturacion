<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::obtenerUbicacionR();
echo json_encode($data);
