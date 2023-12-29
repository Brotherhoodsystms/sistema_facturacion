<?php
include dirname(dirname(__FILE__)) . "../../models/combos.php";
session_start();
$id_usuario = $_SESSION['idUser'];
$data = Combos::obtenerDetalleTempCombos($id_usuario);
echo json_encode($data);