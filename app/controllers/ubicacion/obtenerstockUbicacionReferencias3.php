<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = array(
  'bodega_id' => $_POST['id_bodega'],
  'producto_codigo' => $_POST['producto_codigoserial'],
  'description' => $_POST['descripcion']
);
$data = Ubicacion::obtenerUbicacionParametrosIndividual($data);
echo json_encode($data);
