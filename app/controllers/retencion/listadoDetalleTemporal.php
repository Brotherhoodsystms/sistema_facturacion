<?php
include dirname(dirname(__FILE__)) . "../../models/retencion.php";
session_start();
$id_usuario = $_SESSION['idUser'];
$data = Retencion::obtenerDetalleTemp($id_usuario);
echo json_encode($data);
