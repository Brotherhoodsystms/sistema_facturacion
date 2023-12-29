<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/categoria.php";

$data = Categoria::obtenerCategorias();

$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
