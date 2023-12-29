<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::obtenerUbicacionId($_POST['id']);
echo json_encode($data);
