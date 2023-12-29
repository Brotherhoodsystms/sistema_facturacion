<?php
include dirname(dirname(__FILE__)) . "../../models/sucursal.php";
$data = Sucursal::eliminarSucursal($_POST['id']);
echo json_encode($data);
