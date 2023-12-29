<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerClienteId(($_POST["cliente_ruc"]));//no se esta buscando por cliente_id se cambio la funcion
echo json_encode($data);
