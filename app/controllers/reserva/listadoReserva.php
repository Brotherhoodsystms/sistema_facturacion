<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
session_start();
$emisor_id=$_SESSION['emisor_id'];
$data = Reserva::obtenerReserva($emisor_id);
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);
//echo json_encode($data);
