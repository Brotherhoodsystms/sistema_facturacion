<?php
include dirname(dirname(__FILE__)) . "../../models/proforma.php";

$datos_factura = Proforma::ObterProformaID($_POST["id"]);
$secuencial = str_pad($datos_factura["factura_serie"], 9, "0", STR_PAD_LEFT);

$codigos = Proforma::obtenerCodigoFactura($datos_factura['proforma_emisor_id']);
$ruta = substr($codigos['dirDocPdf'], 5, -1);//todo::en este modulo no necesitamos la  ruta de los pdf
//$Factura = '../../app' . $ruta . '/prueba5898.pdf';
$Factura = '../../app/facturas/proformas/Proforma_'. $codigos['ruc'].'_'.$codigos['cod_esta'].'_'.$codigos['cod_pto'].'_'.$datos_factura['proforma_serie']. '.pdf';
//todo::descomentar la anterior para poder realizarlo dinamicamente una vez terminado el tema
//todo::envio  del correo electronico se modificara en cuanto a los parametros mensionados
//todo::nombre del archivo en la ruta especifica
//var_dump($ruta);
echo json_encode($Factura);
