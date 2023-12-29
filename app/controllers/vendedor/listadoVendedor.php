<?php
include dirname(dirname(__FILE__)) . "../../models/vendedor.php";
session_start();
$data = Vendedor::obtenerVendedores();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
//echo json_encode($data);
