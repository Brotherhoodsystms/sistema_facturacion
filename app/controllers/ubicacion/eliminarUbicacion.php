<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::eliminarUbicacion($_POST['id']);
echo json_encode($data);
