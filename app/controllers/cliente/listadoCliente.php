<?php
include dirname(dirname(__FILE__)) . "../../models/cliente.php";
session_start();
$data = Cliente::obtenerClientes();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
