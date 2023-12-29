<?php
include dirname(dirname(__FILE__)) . "../../models/proveedor.php";
$data = Proveedor::obtenerProveedorId($_POST['id']);
echo json_encode($data);
