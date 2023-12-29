<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$data = Venta::obtenerListaDocumentos();
echo json_encode($data);
