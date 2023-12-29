<?php
include dirname(dirname(__FILE__)) . "../../models/vendedor.php";
$idVendedor = $_POST["id"];
//echo $idProducto;
echo json_encode(Vendedor::eliminarVendedor($idVendedor));