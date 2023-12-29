<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
session_start();
$id_usuario = $_SESSION['idUser'];
$data = Venta::obtenerDetalleTemp($id_usuario);
echo json_encode($data);
