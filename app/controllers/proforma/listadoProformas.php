<?php
include dirname(dirname(__FILE__)) . "../../models/proforma.php";
//$data = Factura::obtenerFacturasActivas();
session_start();
$data = Proforma::obtenerFacturasActivas($_SESSION['emisor_id']);
$datos = array(
  'data' => $data,
  'permisosMod' => $_SESSION['permisosMod'],
  'nombre_apellido'=> $_SESSION['nomb_apelido']
);

echo json_encode($datos);
