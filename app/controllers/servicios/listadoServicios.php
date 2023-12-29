<?php
include dirname(dirname(__FILE__)) . "../../models/servicios.php";
$data = Servicios::obtenerServicios();
echo json_encode($data);
