<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
session_start();
$data = Producto::obtenerProductosKardexID($_POST['id']);
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);