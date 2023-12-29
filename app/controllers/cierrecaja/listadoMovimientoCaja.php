<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/cierrecaja.php";
if($_SESSION['id_rol'] === '1'){
    $data = Cierrecaja::obtenerMovimientoCaja();
}else{
    $data = Cierrecaja::obtenerMovimientoCajaUsuario($_SESSION['idUser']);
}
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);