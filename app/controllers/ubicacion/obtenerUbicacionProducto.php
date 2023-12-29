<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
$data = Ubicacion::obtenerUbicacionIdproducto($_POST['producto_codigoserial']);
echo json_encode($data);
