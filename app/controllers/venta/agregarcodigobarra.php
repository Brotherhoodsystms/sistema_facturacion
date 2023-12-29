<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerProductoCodigo($_POST["producto_codigo"]);
echo json_encode($data);