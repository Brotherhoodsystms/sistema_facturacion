<?php
include dirname(dirname(__FILE__)) . "../../Helpers/Helpers.php";
include dirname(dirname(__FILE__)) . "../../models/factura.php";
session_start();
$id_bodega = $_SESSION['bodega_id'];
$datos_factura = Factura::ObterFacturaID($_POST['id']);
$datos_detalleFactura = Factura::ObtenerDetalleFactura($datos_factura['factura_id']);
$datosEstaBod = Factura::obtenerBodegaEsta($id_bodega);
$datos_correo = array(
  'email' => $datos_factura['cliente_email'],
  'asunto' => $_POST["asunto"],
  'id' => $_POST['id'],
  'emailCopia' => CORREO_REENVIO
);
$datos = array(
  'factura' => $datos_factura,
  'envio_correo' => $datos_correo,
  'detalle_factura' => $datos_detalleFactura,
  'nombreFactura' => 'FAC-'.$datosEstaBod['codigo'].'-'.$datosEstaBod['codPtemi'].'-'.(str_pad($datos_factura['factura_serie'], 9, "0", STR_PAD_LEFT)),

);

echo json_encode(sendEmail($datos, $_POST["name"]));
//echo json_encode($datos);
