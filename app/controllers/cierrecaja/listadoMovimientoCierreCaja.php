<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";

$data = Cierrecaja::obtenerMovimientoCajaUsuario($_SESSION['idUser']);

$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);