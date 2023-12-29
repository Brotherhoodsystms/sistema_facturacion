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

  $sql = "SELECT * FROM tbl_factura as factura INNER JOIN tbl_emisor as emisor
  on emisor.id=factura.emisor_id INNER JOIN tbl_cliente as cliente on
  factura.cliente_id=cliente.cliente_id WHERE factura.factura_id=:reserva_numero";

  $query = Conexion::obtenerConexion()->prepare($sql);
  $query->bindParam(":reserva_numero", $noFactura);
  $datos = $query->execute();



  if ($datos > 0) {
    $reserva =
      $query->fetch(PDO::FETCH_ASSOC);
      
    $fechaEmision
      = date("d/m/Y", strtotime($reserva['factura_fechagenerada']));
    $tipoEmision = $reserva['tipoEmision'];
    $ambiente = $reserva['ambiente'];
    $emisor = $reserva['ruc'];
    $factura = str_pad($reserva['factura_serie'], 9, "0", STR_PAD_LEFT);
    $sql3 = "SELECT establecimiento.codigo as establecimientocodigo, puntoemision.* FROM
    tbl_establecimiento as establecimiento INNER JOIN tbl_ptoemision as puntoemision on
    establecimiento.id=puntoemision.establecimiento_id where establecimiento.emisor_id=:emisor_id";
    $query3 = Conexion::obtenerConexion()->prepare($sql3);
    $query3->bindParam(":emisor_id", $reserva['emisor_id']);
    $query3->execute();
    $estapunto = $query3->fetch(PDO::FETCH_ASSOC);

    $reserva['establecimiento'] = $establecimiento = $estapunto['establecimientocodigo'];

    $reserva['ptoEmision'] = $ptoEmision = $estapunto['codigo'];
    $reserva['claveAcceso'] = claveAcceso($ambiente, $factura, $emisor, $establecimiento, $ptoEmision, $fechaEmision, $tipoEmision);
    //llamado de datos de forma de pago 
    $sql4 = "SELECT * FROM tbl_formapago where formpago_id=:formpago_id";
    $query4 = Conexion::obtenerConexion()->prepare($sql4);
    $query4->bindParam(":formpago_id", $reserva['formpago_id']);
    $query4->execute();
    $formpago = $query4->fetch(PDO::FETCH_ASSOC);
    $reserva['formpago_codigo'] = $formpago['formpago_codigo'];
  }
  $sql2 = "SELECT * FROM tbl_detallefactura as detafactura INNER JOIN tbl_producto as producto on detafactura.producto_id=producto.producto_id WHERE detafactura.factura_id=:reserva_id";
  $query2 = Conexion::obtenerConexion()->prepare($sql2);
  $query2->bindParam(":reserva_id", $noFactura);
  $detalleTodos =
    $query2->execute();
  if ($detalleTodos > 0) {

    $detalleTodos = $query2->fetchAll(PDO::FETCH_ASSOC);
    //$no_factura = $factura['nofactura'];
    


    /* if ($reserva['factura_estado'] != "A") {
      $anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
    } */
    /*
    $query_productos = mysqli_query($conection, "SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.nofactura = dt.nofactura
														INNER JOIN producto p
														ON dt.codproducto = p.codproducto
														WHERE f.nofactura = $no_factura ");
    $result_detalle = mysqli_num_rows($query_productos);
*/
    ob_start();
    include(dirname('__FILE__') . '/ticket.php');
    $html = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'portrait');
    $dompdf->setPaper('b7', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream('reserva' . $noFactura . '.pdf', array('Attachment' => 0));
    $output = $dompdf->output();
    //$rutaGuardado = 'C:\laragon\www\seli_logistics_inventario\app\comprobantes\autorizados/';
    /*hablitarpara guardado de datos*/
    //file_put_contents($rutaGuardado . 'Ticket_' . $noFactura . '.pdf', $output);
    //generarXmlReserva($noFactura, $reserva);
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
  $xml_ambiente =  $xml->createElement("ambiente", $reserva['ambiente']);
  $xml_tipo = $xml->createElement("tipoEmision", $reserva['tipoEmision']);
  $xml_razonsocial = $xml->createElement("razonSocial", $reserva['razonSocial']);
  $xml_nombrecomercial = $xml->createElement("nombreComercial", "SELI LOGISTICS");
  $xml_ruc = $xml->createElement("ruc", $reserva['ruc']);

  $xml_clave = $xml->createElement("claveAcceso", $reserva['claveAcceso']);
  $xml_doc = $xml->createElement("codDoc", "01");
  $xml_establecimiento = $xml->createElement("estab", $reserva['establecimiento']);
  $xml_puntoemision = $xml->createElement("ptoEmi", $reserva['ptoEmision']);
  $xml_secuencial = $xml->createElement("secuencial", $reserva['direccionMatriz']);
  $xml_direccion = $xml->createElement("dirMatriz", $reserva['direccionMatriz']);



  $xml_infofactura = $xml->createElement("infoFactura");
  $xml_fechaemision = $xml->createElement("fechaEmision", $reserva['reserva_fechainicio']);
  $xml_direccionEstablecimiento = $xml->createElement("direccionEstablecimiento", "DIRECCION ESTABLECIMIENTO");
  $xml_obligadoContabilidad = $xml->createElement("obligadoContabilidad", $reserva['obligadoContabilidad']);
  $xml_tipoIdentificacionComprador = $xml->createElement("tipoIdentificacionComprador", "05");
  $xml_razonSocialComprador = $xml->createElement("razonSocialComprador", "NOMBRE DEL COMPRADOR");
  $xml_identificacionComprador = $xml->createElement("identificacionComprador", "1234567891");
  $xml_totalSinImpuestos = $xml->createElement("totalSinImpuestos", $reserva['factura_subtotal']);
  $xml_totalDescuento = $xml->createElement("totalDescuento", "0.00");


  $xml_totalConImpuestos = $xml->createElement("totalConImpuestos");
  $xml_totalImpuesto = $xml->createElement("totalImpuesto");
  $xml_codigo = $xml->createElement("codigo", "2");
  $xml_codigoPorcentaje = $xml->createElement("codigoPorcentaje", "0");
  $xml_baseImponible = $xml->createElement("baseImponible", "1.00");
  $xml_valor = $xml->createElement("valor", "0");


  $xml_propina = $xml->createElement("propina", "0.00");
  $xml_importeTotal = $xml->createElement("importeTotal", "0.00");
  $xml_moneda = $xml->createElement("moneda", "DOLAR");


  $xml_pagos = $xml->createElement("pagos");
  $xml_pago = $xml->createElement("pago");
  $xml_formaPago = $xml->createElement("formaPago", $reserva['formpago_codigo']);
  $xml_total = $xml->createElement("total", $reserva['factura_total']);
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
    . $xml->save(RUTA_ABSOLUTA."\app\comprobantes\autorizados/Factura_" . $reserva['claveAcceso'] . ".xml") . "bytes";
}
function claveAcceso($ambiente, $factura, $emisor, $establecimiento, $ptoEmision, $fechaEmision, $tipoEmision)
{
  $claveAcceso = str_replace("/", "", $fechaEmision);
  $claveAcceso .= "01";
  $claveAcceso .= $emisor;
  $claveAcceso .= $ambiente;
  $serie = $establecimiento . $ptoEmision;
  $claveAcceso .= $serie;
  $claveAcceso .= $factura;
  $claveAcceso .= "12345678";
  $claveAcceso .= $tipoEmision;
  $claveAcceso .= modulo11($claveAcceso);
  return $claveAcceso;
}
function modulo11($claveAcceso)
{
  $multiplos = [2, 3, 4, 5, 6, 7];
  $i = 0;
  $cantidad = strlen($claveAcceso);
  $total = 0;
  while ($cantidad > 0) {
    $total += intval(substr($claveAcceso, $cantidad - 1, 1)) * $multiplos[$i];
    $i++;
    $i = $i % 6;
    $cantidad--;
  }
  $modulo11 = 11 - $total % 11;
  if ($modulo11 == 11) {
    $modulo11 = 0;
  } else if ($modulo11 == 10) {
    $modulo11 = 1;
  }
  return strval($modulo11);
}

/*
 *  Author	David S. Tufts
 *  Company	davidscotttufts.com
 *
 *  Date:	05/25/2003
 *  Usage:	<img src="/barcode.php?text=testing" alt="testing" />
 */

// For demonstration purposes, get pararameters that are passed in through $_GET or set to the default value
$filepath = (isset($_GET["filepath"]) ? $_GET["filepath"] : "");
$text = (isset($_GET["text"]) ? $_GET["text"] : "0");
$size = (isset($_GET["size"]) ? $_GET["size"] : "20");
$orientation = (isset($_GET["orientation"]) ? $_GET["orientation"] : "horizontal");
$code_type = (isset($_GET["codetype"]) ? $_GET["codetype"] : "code128");
$print = (isset($_GET["print"]) && $_GET["print"] == 'true' ? true : false);
$sizefactor = (isset($_GET["sizefactor"]) ? $_GET["sizefactor"] : "1");

// This function call can be copied into your project and can be made from anywhere in your code
barcode($filepath, $text, $size, $orientation, $code_type, $print, $sizefactor);

function barcode($filepath = "", $text = "0", $size = "20", $orientation = "horizontal", $code_type = "code128", $print = false, $SizeFactor = 1)
{
  $code_string = "";
  // Translate the $text into barcode the correct $code_type
  if (in_array(strtolower($code_type), array("code128", "code128b"))) {
    $chksum = 104;
    // Must not change order of array elements as the checksum depends on the array's key to validate final code
    $code_array = array(" " => "212222", "!" => "222122", "\"" => "222221", "#" => "121223", "$" => "121322", "%" => "131222", "&" => "122213", "'" => "122312", "(" => "132212", ")" => "221213", "*" => "221312", "+" => "231212", "," => "112232", "-" => "122132", "." => "122231", "/" => "113222", "0" => "123122", "1" => "123221", "2" => "223211", "3" => "221132", "4" => "221231", "5" => "213212", "6" => "223112", "7" => "312131", "8" => "311222", "9" => "321122", ":" => "321221", ";" => "312212", "<" => "322112", "=" => "322211", ">" => "212123", "?" => "212321", "@" => "232121", "A" => "111323", "B" => "131123", "C" => "131321", "D" => "112313", "E" => "132113", "F" => "132311", "G" => "211313", "H" => "231113", "I" => "231311", "J" => "112133", "K" => "112331", "L" => "132131", "M" => "113123", "N" => "113321", "O" => "133121", "P" => "313121", "Q" => "211331", "R" => "231131", "S" => "213113", "T" => "213311", "U" => "213131", "V" => "311123", "W" => "311321", "X" => "331121", "Y" => "312113", "Z" => "312311", "[" => "332111", "\\" => "314111", "]" => "221411", "^" => "431111", "_" => "111224", "\`" => "111422", "a" => "121124", "b" => "121421", "c" => "141122", "d" => "141221", "e" => "112214", "f" => "112412", "g" => "122114", "h" => "122411", "i" => "142112", "j" => "142211", "k" => "241211", "l" => "221114", "m" => "413111", "n" => "241112", "o" => "134111", "p" => "111242", "q" => "121142", "r" => "121241", "s" => "114212", "t" => "124112", "u" => "124211", "v" => "411212", "w" => "421112", "x" => "421211", "y" => "212141", "z" => "214121", "{" => "412121", "|" => "111143", "}" => "111341", "~" => "131141", "DEL" => "114113", "FNC 3" => "114311", "FNC 2" => "411113", "SHIFT" => "411311", "CODE C" => "113141", "FNC 4" => "114131", "CODE A" => "311141", "FNC 1" => "411131", "Start A" => "211412", "Start B" => "211214", "Start C" => "211232", "Stop" => "2331112");
    $code_keys = array_keys($code_array);
    $code_values = array_flip($code_keys);
    for ($X = 1; $X <= strlen($text); $X++) {
      $activeKey = substr($text, ($X - 1), 1);
      $code_string .= $code_array[$activeKey];
      $chksum = ($chksum + ($code_values[$activeKey] * $X));
    }
    $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

    $code_string = "211214" . $code_string . "2331112";
  } elseif (strtolower($code_type) == "code128a") {
    $chksum = 103;
    $text = strtoupper($text); // Code 128A doesn't support lower case
    // Must not change order of array elements as the checksum depends on the array's key to validate final code
    $code_array = array(" " => "212222", "!" => "222122", "\"" => "222221", "#" => "121223", "$" => "121322", "%" => "131222", "&" => "122213", "'" => "122312", "(" => "132212", ")" => "221213", "*" => "221312", "+" => "231212", "," => "112232", "-" => "122132", "." => "122231", "/" => "113222", "0" => "123122", "1" => "123221", "2" => "223211", "3" => "221132", "4" => "221231", "5" => "213212", "6" => "223112", "7" => "312131", "8" => "311222", "9" => "321122", ":" => "321221", ";" => "312212", "<" => "322112", "=" => "322211", ">" => "212123", "?" => "212321", "@" => "232121", "A" => "111323", "B" => "131123", "C" => "131321", "D" => "112313", "E" => "132113", "F" => "132311", "G" => "211313", "H" => "231113", "I" => "231311", "J" => "112133", "K" => "112331", "L" => "132131", "M" => "113123", "N" => "113321", "O" => "133121", "P" => "313121", "Q" => "211331", "R" => "231131", "S" => "213113", "T" => "213311", "U" => "213131", "V" => "311123", "W" => "311321", "X" => "331121", "Y" => "312113", "Z" => "312311", "[" => "332111", "\\" => "314111", "]" => "221411", "^" => "431111", "_" => "111224", "NUL" => "111422", "SOH" => "121124", "STX" => "121421", "ETX" => "141122", "EOT" => "141221", "ENQ" => "112214", "ACK" => "112412", "BEL" => "122114", "BS" => "122411", "HT" => "142112", "LF" => "142211", "VT" => "241211", "FF" => "221114", "CR" => "413111", "SO" => "241112", "SI" => "134111", "DLE" => "111242", "DC1" => "121142", "DC2" => "121241", "DC3" => "114212", "DC4" => "124112", "NAK" => "124211", "SYN" => "411212", "ETB" => "421112", "CAN" => "421211", "EM" => "212141", "SUB" => "214121", "ESC" => "412121", "FS" => "111143", "GS" => "111341", "RS" => "131141", "US" => "114113", "FNC 3" => "114311", "FNC 2" => "411113", "SHIFT" => "411311", "CODE C" => "113141", "CODE B" => "114131", "FNC 4" => "311141", "FNC 1" => "411131", "Start A" => "211412", "Start B" => "211214", "Start C" => "211232", "Stop" => "2331112");
    $code_keys = array_keys($code_array);
    $code_values = array_flip($code_keys);
    for ($X = 1; $X <= strlen($text); $X++) {
      $activeKey = substr($text, ($X - 1), 1);
      $code_string .= $code_array[$activeKey];
      $chksum = ($chksum + ($code_values[$activeKey] * $X));
    }
    $code_string .= $code_array[$code_keys[($chksum - (intval($chksum / 103) * 103))]];

    $code_string = "211412" . $code_string . "2331112";
  } elseif (strtolower($code_type) == "code39") {
    $code_array = array("0" => "111221211", "1" => "211211112", "2" => "112211112", "3" => "212211111", "4" => "111221112", "5" => "211221111", "6" => "112221111", "7" => "111211212", "8" => "211211211", "9" => "112211211", "A" => "211112112", "B" => "112112112", "C" => "212112111", "D" => "111122112", "E" => "211122111", "F" => "112122111", "G" => "111112212", "H" => "211112211", "I" => "112112211", "J" => "111122211", "K" => "211111122", "L" => "112111122", "M" => "212111121", "N" => "111121122", "O" => "211121121", "P" => "112121121", "Q" => "111111222", "R" => "211111221", "S" => "112111221", "T" => "111121221", "U" => "221111112", "V" => "122111112", "W" => "222111111", "X" => "121121112", "Y" => "221121111", "Z" => "122121111", "-" => "121111212", "." => "221111211", " " => "122111211", "$" => "121212111", "/" => "121211121", "+" => "121112121", "%" => "111212121", "*" => "121121211");

    // Convert to uppercase
    $upper_text = strtoupper($text);

    for ($X = 1; $X <= strlen($upper_text); $X++) {
      $code_string .= $code_array[substr($upper_text, ($X - 1), 1)] . "1";
    }

    $code_string = "1211212111" . $code_string . "121121211";
  } elseif (strtolower($code_type) == "code25") {
    $code_array1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
    $code_array2 = array("3-1-1-1-3", "1-3-1-1-3", "3-3-1-1-1", "1-1-3-1-3", "3-1-3-1-1", "1-3-3-1-1", "1-1-1-3-3", "3-1-1-3-1", "1-3-1-3-1", "1-1-3-3-1");

    for ($X = 1; $X <= strlen($text); $X++) {
      for ($Y = 0; $Y < count($code_array1); $Y++) {
        if (substr($text, ($X - 1), 1) == $code_array1[$Y])
          $temp[$X] = $code_array2[$Y];
      }
    }

    for ($X = 1; $X <= strlen($text); $X += 2) {
      if (isset($temp[$X]) && isset($temp[($X + 1)])) {
        $temp1 = explode("-", $temp[$X]);
        $temp2 = explode("-", $temp[($X + 1)]);
        for ($Y = 0; $Y < count($temp1); $Y++)
          $code_string .= $temp1[$Y] . $temp2[$Y];
      }
    }

    $code_string = "1111" . $code_string . "311";
  } elseif (strtolower($code_type) == "codabar") {
    $code_array1 = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0", "-", "$", ":", "/", ".", "+", "A", "B", "C", "D");
    $code_array2 = array("1111221", "1112112", "2211111", "1121121", "2111121", "1211112", "1211211", "1221111", "2112111", "1111122", "1112211", "1122111", "2111212", "2121112", "2121211", "1121212", "1122121", "1212112", "1112122", "1112221");

    // Convert to uppercase
    $upper_text = strtoupper($text);

    for ($X = 1; $X <= strlen($upper_text); $X++) {
      for ($Y = 0; $Y < count($code_array1); $Y++) {
        if (substr($upper_text, ($X - 1), 1) == $code_array1[$Y])
          $code_string .= $code_array2[$Y] . "1";
      }
    }
    $code_string = "11221211" . $code_string . "1122121";
  }

  // Pad the edges of the barcode
  $code_length = 20;
  if ($print) {
    $text_height = 30;
  } else {
    $text_height = 0;
  }

  for ($i = 1; $i <= strlen($code_string); $i++) {
    $code_length = $code_length + (int)(substr($code_string, ($i - 1), 1));
  }

  if (strtolower($orientation) == "horizontal") {
    $img_width = $code_length * $SizeFactor;
    $img_height = $size;
  } else {
    $img_width = $size;
    $img_height = $code_length * $SizeFactor;
  }

  $image = imagecreate($img_width, $img_height + $text_height);
  $black = imagecolorallocate($image, 0, 0, 0);
  $white = imagecolorallocate($image, 255, 255, 255);

  imagefill($image, 0, 0, $white);
  if ($print) {
    imagestring($image, 5, 31, $img_height, $text, $black);
  }

  $location = 10;
  for ($position = 1; $position <= strlen($code_string); $position++) {
    $cur_size = $location + (substr($code_string, ($position - 1), 1));
    if (strtolower($orientation) == "horizontal")
      imagefilledrectangle($image, $location * $SizeFactor, 0, $cur_size * $SizeFactor, $img_height, ($position % 2 == 0 ? $white : $black));
    else
      imagefilledrectangle($image, 0, $location * $SizeFactor, $img_width, $cur_size * $SizeFactor, ($position % 2 == 0 ? $white : $black));
    $location = $cur_size;
  }

  // Draw barcode to the screen or save in a file
  if ($filepath == "") {
    header('Content-type: image/png');
    imagepng($image);
    imagedestroy($image);
  } else {
    imagepng($image, $filepath);
    imagedestroy($image);
  }
}
