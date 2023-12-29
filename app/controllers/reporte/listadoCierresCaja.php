<?php
include dirname(dirname(__FILE__)) . "../../models/reportes.php";
session_start();
$data = Reportes::obtenerCierresCaja($_POST['id']);
$datos = array(
    'busqueda' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);