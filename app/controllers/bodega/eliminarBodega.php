<?php
include dirname(dirname(__FILE__)) . "../../models/bodega.php";
$idBodega = $_POST["id"];
//echo $idProducto;
echo json_encode(Bodega::eliminarBodega($idBodega));