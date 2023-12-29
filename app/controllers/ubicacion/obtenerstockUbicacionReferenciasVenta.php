<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = array(
  'producto_id' => $_POST['id_codigo'],
);
$data = Ubicacion::obtenerUbicacionParametrosIndividualVenta($data);
echo json_encode($data);