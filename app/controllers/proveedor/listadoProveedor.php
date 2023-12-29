<?php
include dirname(dirname(__FILE__)) . "../../models/proveedor.php";
session_start();
$data = Proveedor::obtenerProveedores();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
