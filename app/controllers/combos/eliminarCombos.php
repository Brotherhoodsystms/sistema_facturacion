<?php
include dirname(dirname(__FILE__)) . "../../models/combos.php";
$idProducto = $_POST["id"];
//echo $idProducto;
echo json_encode(Combos::eliminarProductos($idProducto));

