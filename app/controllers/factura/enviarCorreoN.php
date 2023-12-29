<?php
include dirname(dirname(__FILE__)) . "../../Helpers/Helpers.php";
include dirname(dirname(__FILE__)) . "../../models/factura.php";
if($_POST['name']=='email_notificacion_notaVenta'){

$datos_notaVenta = Factura::ObterNotaVentaID($_POST['id']);
$datos_detalleFactura = Factura::ObtenerDetalleNotaVenta($datos_notaVenta['notaventa_id']);

$datos_correo = array(
  'email' => $_POST["email"],
  'asunto' => $_POST["asunto"],
  'id' => $_POST['id'],
  'emailCopia' => CORREO_REENVIO
);
$datos = array(
  'notaVenta' => $datos_notaVenta,
  'envio_correo' => $datos_correo,
  'detalle_NotaVenta' => $datos_detalleFactura
);
}else{
$datos_notaVenta = Factura::ObterProformaID($_POST['id']);

$datos_detalleFactura = Factura::ObtenerDetalleProforma($datos_notaVenta['proforma_id']);
$datos_ptoemsion=Factura::obtenerCodigoEsta($datos_notaVenta['proforma_emisor_id']);

$datos_correo = array(
  'email' => $_POST["email"],
  'asunto' => $_POST["asunto"],
  'id' => $_POST['id'],
  'emailCopia' => CORREO_REENVIO
);
$datos = array(
  'notaVenta' => $datos_notaVenta,
  'envio_correo' => $datos_correo,
  'detalle_NotaVenta' => $datos_detalleFactura,
  'codigos'=>$datos_ptoemsion
);

}
echo json_encode(sendMailLocal($datos, $_POST["name"]));
