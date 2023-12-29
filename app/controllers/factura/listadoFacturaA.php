<?php
include dirname(dirname(__FILE__)) . "../../models/factura.php";
//$data = Factura::obtenerFacturasActivas();
session_start();
$data = Factura::obtenerFacturasActivas($_SESSION['emisor_id']);
$datos = array(
  'data' => $data,
  'permisosMod' => $_SESSION['permisosMod'],
  'nombre_apellido'=> $_SESSION['nomb_apelido']
);

echo json_encode($datos);
