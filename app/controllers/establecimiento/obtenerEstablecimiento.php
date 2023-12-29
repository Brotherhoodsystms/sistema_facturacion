<?php
include dirname(dirname(__FILE__)) . "../../models/establecimiento.php";
$data = Establecimiento::obtenerEstablecimientoId($_POST['id']);
echo json_encode($data);
