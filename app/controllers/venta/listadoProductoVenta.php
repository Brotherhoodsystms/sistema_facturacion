<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerProductosVenta();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
//echo json_encode($data);