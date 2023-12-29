<?php
include dirname(dirname(__FILE__)) . "../../models/factura.php";

$datos_factura = Factura::ObterFacturaID($_POST["id"]);
$secuencial = str_pad($datos_factura["factura_serie"], 9, "0", STR_PAD_LEFT);

$codigos = Factura::obtenerCodigoFactura($datos_factura['emisor_id']);
$ruta = substr($codigos['dirDocPdf'], 5, -1);
//$Factura = '../../app' . $ruta . '/prueba5898.pdf';
$Factura = '../../app' . $ruta . '/FAC-' . $codigos['cod_esta'] . '-' . $codigos['cod_pto'] . '-' . $secuencial . '.pdf';
//todo::descomentar la anterior para poder realizarlo dinamicamente una vez terminado el tema
//todo::envio  del correo electronico

echo json_encode($Factura);
