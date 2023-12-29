<?php
include dirname(dirname(__FILE__)) . "../../models/reportes.php";
$data = Reportes::obtenerVentaProducto($_POST["fecha_i"], $_POST["fecha_f"],$_POST["valor"]);
echo json_encode($data);