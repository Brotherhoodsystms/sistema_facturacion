<?php
include dirname(dirname(__FILE__)) . "../../models/usuario.php";
session_start();
// echo json_encode(Usuario::obtenerUsuarios());
$data = Usuario::obtenerUsuarios();

$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);

//echo json_encode($data);
