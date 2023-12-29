<?php
include dirname(dirname(__FILE__)) . "../../models/notaventa.php";
session_start();
$data = Notaventa::obtenerMercaderia($_SESSION['emisor_id']);
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
//var_dump($_SESSION['permisosMod']);
// echo json_encode($data);
