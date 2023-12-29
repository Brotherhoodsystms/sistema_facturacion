<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
$data = Cierrecaja::obtenerCajas();
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
//echo json_encode($data);