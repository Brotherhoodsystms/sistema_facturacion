<?php
include dirname(dirname(__FILE__)) . "../../config/conexion.php";
require_once '../pdf/vendor/autoload.php';
require_once '../../Helpers/Helpers.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
  echo "No es posible generar la factura.";
} else {
  $codCliente = $_REQUEST['cl'];
  $noFactura = $_REQUEST['f'];
  $anulada = '';

  $sql = "SELECT * FROM tbl_reserva as reserva INNER JOIN tbl_emisor as emisor
  on emisor.id=reserva.emisor_id INNER JOIN tbl_cliente as cliente on
  reserva.cliente_id=cliente.cliente_id WHERE reserva.reserva_id=:reserva_numero";

  $query = Conexion::obtenerConexion()->prepare($sql);
  $query->bindParam(":reserva_numero", $noFactura);
  $datos = $query->execute();



  if ($datos > 0) {
    $reserva =
      $query->fetch(PDO::FETCH_ASSOC);
  }
  $sql2 = "SELECT * FROM tbl_detallereserva as detallereserva INNER JOIN tbl_producto as producto on detallereserva.producto_id=producto.producto_id WHERE reserva_id=:reserva_id";
  $query2 = Conexion::obtenerConexion()->prepare($sql2);
  $query2->bindParam(":reserva_id", $noFactura);
  $detalleTodos =
    $query2->execute();
  if ($detalleTodos > 0) {

    $detalleTodos = $query2->fetchAll(PDO::FETCH_ASSOC);
    //$no_factura = $factura['nofactura'];


    if ($reserva['reserva_estado'] != "A") {
      $anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
    }
/*todo::datos de codigos de emisor*/
$sql4 = "SELECT es.codigo as codigo_es, pt.codigo as codigo_pto,em.* FROM tbl_establecimiento as es
JOIN tbl_ptoemision as pt on pt.establecimiento_id=es.id
JOIN tbl_emisor as em on em.id=es.emisor_id WHERE es.emisor_id=:reserva_numero";
    $query4 = Conexion::obtenerConexion()->prepare($sql4);
    $query4->bindParam(':reserva_numero', $reserva['emisor_id']);
    $query4->execute();
    $datos_punto_emision =$query4->fetch(PDO::FETCH_ASSOC);

    ob_start();
    include(dirname('__FILE__') . '/factura.php');
    $html = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => 0));
    $output = $dompdf->output();
    $rutaGuardado = RUTA_ABSOLUTA.'\app\facturas\reservas/';
    file_put_contents($rutaGuardado . 'Reserva_'.$datos_punto_emision['ruc'].'_'.$datos_punto_emision['codigo_es'].'_'.$datos_punto_emision['codigo_pto'].'_'. $reserva['reserva_numero']. '.pdf', $output);
    exit;
  }
}
function generarXmlReserva($id, $reserva)
{

  $xml = new DOMDocument("1.0", "UTF-8");
  $xml->formatOutput = true;
  $xml_factura = $xml->createElement("factura");
  $cabecera = $xml->createAttribute("id");
  $cabecera->value = "Comprobante";
  $cabecera_version = $xml->createAttribute("version");
  $cabecera_version->value = "1.00";
  $xml_info = $xml->createElement("infoTributaria");
  $xml_ambiente =  $xml->createElement("ambiente", "1");
  $xml_tipo = $xml->createElement("tipoEmision", "1");
  $xml_razonsocial = $xml->createElement("razonSocial", $reserva['razonSocial']);
  $xml_nombrecomercial = $xml->createElement("nombreComercial", "SELI LOGISTICS");
  $xml_ruc = $xml->createElement("ruc", $reserva['ruc']);

  $xml_clave = $xml->createElement("claveAcceso", "2609202201123456789100110010010000000011234567812");
  $xml_doc = $xml->createElement("codDoc", "01");
  $xml_establecimiento = $xml->createElement("estab", "001");
  $xml_puntoemision = $xml->createElement("ptoEmi", "01");
  $xml_secuencial = $xml->createElement("secuencial", $reserva['direccionMatriz']);
  $xml_direccion = $xml->createElement("dirMatriz", $reserva['direccionMatriz']);



  $xml_infofactura = $xml->createElement("infoFactura");
  $xml_fechaemision = $xml->createElement("fechaEmision", $reserva['reserva_fechainicio']);
  $xml_direccionEstablecimiento = $xml->createElement("direccionEstablecimiento", "DIRECCION ESTABLECIMIENTO");
  $xml_obligadoContabilidad = $xml->createElement("obligadoContabilidad", "si");
  $xml_tipoIdentificacionComprador = $xml->createElement("tipoIdentificacionComprador", "05");
  $xml_razonSocialComprador = $xml->createElement("razonSocialComprador", "NOMBRE DEL COMPRADOR");
  $xml_identificacionComprador = $xml->createElement("identificacionComprador", "1234567891");
  $xml_totalSinImpuestos = $xml->createElement("totalSinImpuestos", "1.00");
  $xml_totalDescuento = $xml->createElement("totalDescuento", "0.00");


  $xml_totalConImpuestos = $xml->createElement("totalConImpuestos");
  $xml_totalImpuesto = $xml->createElement("totalImpuesto");
  $xml_codigo = $xml->createElement("codigo", "2");
  $xml_codigoPorcentaje = $xml->createElement("codigoPorcentaje", "0");
  $xml_baseImponible = $xml->createElement("baseImponible", "1.00");
  $xml_valor = $xml->createElement("valor", "0");


  $xml_propina = $xml->createElement("propina", "0.00");
  $xml_importeTotal = $xml->createElement("importeTotal", "1.00");
  $xml_moneda = $xml->createElement("moneda", "DOLAR");


  $xml_pagos = $xml->createElement("pagos");
  $xml_pago = $xml->createElement("pago");
  $xml_formaPago = $xml->createElement("formaPago", "01");
  $xml_total = $xml->createElement("total", "1.00");
  $xml_plazo = $xml->createElement("plazo", "30");
  $xml_unidadTiempo = $xml->createElement("unidadTiempo", "dias");


  $xml_detalles = $xml->createElement("detalles");
  $xml_detalle = $xml->createElement("detalle");
  $xml_codigoPrincipal = $xml->createElement("codigoPrincipal", "PROD008");
  $xml_descripcion = $xml->createElement("descripcion", "DESCRIPCION DEL PRODUCTO");
  $xml_cantidad = $xml->createElement("cantidad", "1");
  $xml_precioUnitario = $xml->createElement("precioUnitario", "1.00");
  $xml_descuento = $xml->createElement("descuento", "0.00");
  $xml_precioTotal = $xml->createElement("precioTotal", "1.00");



  $xml_impuestos = $xml->createElement("impuestos");
  $xml_impuesto = $xml->createElement("impuesto");
  $xml_codigoi = $xml->createElement("codigoi", "2");
  $xml_codigoPorcentajei = $xml->createElement("codigoPorcentajei", "2");
  $xml_tarifai = $xml->createElement("tarifai", "0.00");
  $xml_baseImponiblei = $xml->createElement("baseImponiblei", "1.00");
  $xml_valori = $xml->createElement("valori", "0.00");


  $xml_infoAdicional = $xml->createElement("infoAdicional");
  $xml_campoAdicional = $xml->createElement("campoAdicional", "xyz@xyz.com");
  $atributo = $xml->createAttribute("nombre");
  $atributo->value = "email";


  $xml_info->appendChild($xml_ambiente);
  $xml_info->appendChild($xml_tipo);
  $xml_info->appendChild($xml_razonsocial);
  $xml_info->appendChild($xml_nombrecomercial);
  $xml_info->appendChild($xml_ruc);
  $xml_info->appendChild($xml_clave);
  $xml_info->appendChild($xml_doc);
  $xml_info->appendChild($xml_establecimiento);
  $xml_info->appendChild($xml_puntoemision);
  $xml_info->appendChild($xml_secuencial);
  $xml_info->appendChild($xml_direccion);
  $xml_factura->appendChild($xml_info);

  $xml_infofactura->appendChild($xml_fechaemision);
  $xml_infofactura->appendChild($xml_direccionEstablecimiento);
  $xml_infofactura->appendChild($xml_obligadoContabilidad);
  $xml_infofactura->appendChild($xml_tipoIdentificacionComprador);
  $xml_infofactura->appendChild($xml_razonSocialComprador);
  $xml_infofactura->appendChild($xml_identificacionComprador);
  $xml_infofactura->appendChild($xml_totalSinImpuestos);
  $xml_infofactura->appendChild($xml_totalDescuento);
  $xml_infofactura->appendChild($xml_totalConImpuestos);
  $xml_infofactura->appendChild($xml_totalImpuesto);
  $xml_infofactura->appendChild($xml_codigo);
  $xml_infofactura->appendChild($xml_codigoPorcentaje);
  $xml_infofactura->appendChild($xml_baseImponible);
  $xml_infofactura->appendChild($xml_valor);
  $xml_factura->appendChild($xml_infofactura);

  $xml_infofactura->appendChild($xml_propina);
  $xml_infofactura->appendChild($xml_importeTotal);
  $xml_infofactura->appendChild($xml_moneda);

  $xml_infofactura->appendChild($xml_pagos);
  $xml_pagos->appendChild($xml_pago);
  $xml_pago->appendChild($xml_formaPago);
  $xml_pago->appendChild($xml_total);
  $xml_pago->appendChild($xml_plazo);
  $xml_pago->appendChild($xml_unidadTiempo);

  $xml_factura->appendChild($xml_detalles);
  $xml_detalles->appendChild($xml_detalle);
  $xml_detalle->appendChild($xml_codigoPrincipal);
  $xml_detalle->appendChild($xml_descripcion);
  $xml_detalle->appendChild($xml_cantidad);
  $xml_detalle->appendChild($xml_precioUnitario);
  $xml_detalle->appendChild($xml_descuento);
  $xml_detalle->appendChild($xml_precioTotal);


  $xml_impuestos->appendChild($xml_impuesto);
  $xml_impuesto->appendChild($xml_codigoi);
  $xml_impuesto->appendChild($xml_codigoPorcentajei);
  $xml_impuesto->appendChild($xml_tarifai);
  $xml_impuesto->appendChild($xml_baseImponiblei);
  $xml_impuesto->appendChild($xml_valori);


  $xml_factura->appendChild($xml_infoAdicional);
  $xml_infoAdicional->appendChild(
    $xml_campoAdicional
  );
  $xml_campoAdicional->appendChild($atributo);


  $xml_factura->appendChild($cabecera);
  $xml_factura->appendChild($cabecera_version);
  $xml->appendChild($xml_factura);

  echo 'Created by '
    . $xml->save(RUTA_ABSOLUTA."\app\comprobantes\autorizados/Reserva_" . $id . ".xml") . "bytes";
}
