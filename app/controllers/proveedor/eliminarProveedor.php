<?php
include dirname(dirname(__FILE__)) . "../../models/proveedor.php";
$idProveedor = $_POST["id"];
//echo $idProducto;
echo json_encode(Proveedor::eliminarProveedor($idProveedor));