<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
session_start();
$data = Producto::obtenerProductoskardex2();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);

//echo json_encode($data);
