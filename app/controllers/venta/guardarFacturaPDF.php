<?php

include dirname(dirname(__FILE__)) . "../../models/factura.php";
include '../lib/FPDF/fpdf.php';
include '../lib/codigo_barras/barcode.inc.php';
require_once '../factura/Digito_Verificador.php';

//todo::datos de la factura, datos cliente, datos emisor EMPRESA
$sqlven = Factura::obtenerEmisor($_POST['id_factura']);
//todo::datos de establecimiento y bodega
session_start();

$id_bodega = $_SESSION['bodega_id'];
$datosEstaBod = Factura::obtenerBodegaEsta($id_bodega);

$resven = $sqlven;
$fechac = date('dmY', strtotime($resven['factura_fechagenerada']));
$codcla = '01';
$ruccla = $resven['ruc'];
$ambien = $resven['ambiente'];
//$punemi = substr($resven['serie_comprobante'], -3); //modificar ptemision
//$seccla = substr($resven['serie_comprobante'], -3); //modificar establecimiento
$punemi = $datosEstaBod['codPtemi']; //modificar ptemision
$seccla = $datosEstaBod['codigo'];
$secucl = str_pad($resven['factura_serie'], 9, "0", STR_PAD_LEFT);
$tipoem = $resven['tipoEmision'];
$numero = '12345678';

$clave_acceso = $fechac . $codcla . $ruccla . $ambien . $seccla. $punemi . $secucl . $numero . $tipoem;
$numeroAutorizacion = $clave_acceso . modulo11($clave_acceso);
echo json_encode($datosEstaBod);

pdfFacura($numeroAutorizacion, $id_bodega, $_POST['id_factura']);


   function pdfFacura($numeroAutorizacion, $id_bodega, $id_factura)
  {

    $id_bodega = $id_bodega;
    $sqlven = Factura::obtenerEmisor($id_factura);
    $resven = $sqlven;
    $datosEstaBod = Factura::obtenerBodegaEsta($id_bodega);
    //global $resven;

    $pdf = new FPDF();
    $pdf->SetCreator('ESTEBAN BAHAMONDE/RICARD TIPANTUÑA');
    $pdf->SetAuthor('ESTEBAN BAHAMONDE/RICARD TIPANTUÑA');
    $pdf->SetTitle('factura');
    $pdf->SetSubject('PDF');
    $pdf->SetKeywords('FPDF, PDF, cheque, impresion, guia');
    $pdf->SetMargins('10', '10', '10');
    $pdf->SetAutoPageBreak(TRUE);
    $pdf->SetFont('Arial', '', 7);
    $pdf->AddPage();
    $pdf->Image($resven['dirLogo'], 20, 10, 80);
    $pdf->SetXY(107, 10);
    $pdf->Cell(93, 84, '', 1, 1);
    $pdf->SetXY(10, 54);
    $pdf->Cell(93, 40, '', 1, 1);
    $pdf->SetXY(10, 98);
    $pdf->Cell(190, 12, '', 1, 1);
    $pdf->SetXY(10, 114);
    $pdf->Cell(190, 173, '', 0, 1);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetXY(10, 54);
    $pdf->Cell(93, 10, $resven['razonSocial'], 0, 1, 'C');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(10, 63);
    $pdf->MultiCell(15, 2, 'Direccion Matriz', 0, 'C');
    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(25, 63);
    $pdf->MultiCell(78, 2, $resven['direccionMatriz'], 0, 'L');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(10, 73);
    $pdf->MultiCell(15, 2, 'Direccion Sucursal', 0, 'C');
    $pdf->SetFont('Arial', '', 6);
    $pdf->SetXY(25, 73);
    $pdf->MultiCell(78, 2, $resven['direccionMatriz'], 0, 'L');
    ////TODO::FALTANTES DE REGIMEN
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(10, 76);
    $pdf->Cell(10, 8, 'Contribuyente especial:' . $resven['contribuyenteEspecial'], 0, 1);
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(10, 80);
    $pdf->Cell(10, 8, 'OBLIGADO A LLEVAR CONTABILIDAD:' . $resven['obligadoContabilidad'], 0, 1);
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(10, 84);
    if ($resven['regimenMicroempresa'] == '1') {
      $regimen = 'RIMPE-MICROEMPRESA';
    } else if ($resven['regimenRimpe'] == '1') {
      $regimen = 'RIMPE';
    } else {
      $regimen = 'RIMPE-NEGOCIO POPULAR';
    }
    $pdf->Cell(10, 8, 'CONTRIBUYENTE REGIMEN -' . $regimen, 0, 1);
    //todo:terminado
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetXY(107, 10);
    $pdf->Cell(40, 8, 'RUC:' . $resven['ruc'], 0, 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(107, 18);
    $pdf->Cell(93, 8, 'FACTURA', 0, 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(107, 26);
    $pdf->Cell(40, 8, 'No: ' . $datosEstaBod['codigo'] . '-' . $datosEstaBod['codPtemi'] . '-' . (str_pad($resven['factura_serie'], 9, "0", STR_PAD_LEFT)), 0, 1);
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(107, 32);
    $pdf->Cell(40, 10, 'FECHA AUTORIZACION:' . $resven['factura_fechagenerada'], 0, 1);
    /////////
    if ($resven['ambiente'] == 1) {
      $ambiente = 'PRUEBAS';
      $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(107, 38);
    $pdf->Cell(35, 10, 'AMBIENTE:' . $ambiente, 0, 1, 'C');
    } else {

      $ambiente = 'PRODUCCION';
      $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(110, 38);
    $pdf->Cell(35, 10, 'AMBIENTE:' . $ambiente, 0, 1, 'C');
    }
    
    $pdf->SetFont('Arial', '', 9);
    $pdf->SetXY(107, 44);
    $pdf->Cell(30, 10, 'EMISION:NORMAL', 0, 1, 'C');
    ////todo::pruebasf
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetXY(107, 49);
    $pdf->Cell(93, 8, 'NUMERO DE AUTORIZACION', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(107, 52);
    $pdf->Cell(93, 10, $numeroAutorizacion, 0, 1, 'C'); //'2009202001179134544400110010010003971781234567815'
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetXY(107, 62);
    $pdf->Cell(93, 4, 'CLAVE DE ACCESO', 0, 1, 'C');
    new barCodeGenrator($numeroAutorizacion, 1, 'barra.gif', 455, 60, false); //'2009202001179134544400110010010003971781234567815'
    $pdf->Image('barra.gif', 108, 70, 90, 10);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(107, 80);
    $pdf->Cell(93, 5, $numeroAutorizacion, 0, 1, 'C'); //2009202001179134544400110010010003971781234567815

    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetXY(10, 98);
    $pdf->Cell(30, 3, 'RAZON SOCIAL', 0, 1, 'C');
    $pdf->SetXY(10, 101);
    $pdf->Cell(30, 3, 'NOMBRES Y APELLIDOS', 0, 0, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(40, 98);
    $pdf->MultiCell(160, 3, utf8_decode($resven['cliente_razonsocial']), 0, 'L');//utf8_decodeponer para utf-8
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetXY(10, 104);
    $pdf->Cell(30, 6, 'FECHA DE EMISION', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(40, 104);
    $pdf->Cell(100, 6, $resven['factura_fechagenerada'], 0, 1);
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(140, 104);
    $pdf->Cell(30, 6, 'IDENTIFICACION', 0, 1);
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(170, 104);
    $pdf->Cell(30, 6, $resven['cliente_ruc'], 0, 1);
    //todo::datos detalle factura
    $pdf->SetFont('Arial', 'B', 6);
    $pdf->SetXY(10, 114);
    $pdf->Cell(22, 6, false, 1, 1); //vertical
    $pdf->SetXY(10, 114);
    $pdf->Cell(22, 3, 'Cod.', 0, 1, 'C');
    $pdf->SetXY(10, 117); //horizontal
    $pdf->Cell(22, 3, 'Principal', 0, 1, 'C');
    $pdf->SetXY(32, 114);
    $pdf->Cell(14, 6, false, 1, 1);
    $pdf->SetXY(32, 114);
    $pdf->Cell(14, 3, 'Cod.', 0, 1, 'C');
    $pdf->SetXY(32, 117);
    $pdf->Cell(14, 3, 'Auxiliar', 0, 1, 'C');
    $pdf->SetXY(46, 114);
    $pdf->Cell(13, 6, 'Cant', 1, 1, 'C');
    //todo:modifcado de columnas
    $pdf->SetXY(59, 114);
    $pdf->Cell(100, 6, 'DESCRIPCION', 1, 1, 'C');
    $pdf->SetXY(159, 114);
    $pdf->Cell(13, 6, false, 1, 1);
    $pdf->SetXY(159, 114);
    $pdf->Cell(13, 3, 'Precio', 0, 1, 'C');
    $pdf->SetXY(159, 117);
    $pdf->Cell(13, 3, 'Unitario', 0, 1, 'C');
    $pdf->SetXY(172, 114);
    $pdf->Cell(15, 6, 'Descuento', 1, 1, 'C'); //tamaño de la columna
    $pdf->SetXY(187, 114); //posicion de la letras
    $pdf->Cell(13, 6, false, 1, 1);
    $pdf->SetXY(187, 114);
    $pdf->Cell(13, 3, 'Precio', 0, 1, 'C');
    $pdf->SetXY(187, 117);
    $pdf->Cell(13, 3, 'Total', 0, 1, 'C');
    //CABECERA KARDEX TOTALES Detalle de los productos vendidos
    $datosDetalle = Factura::obtenerDetalleFactura($resven['factura_id']);
    $total = count($datosDetalle);
    $ejey = 120;
    foreach ($datosDetalle as $datos) {

      $pdf->SetXY(10, $ejey);
      $pdf->Cell(22, 10, $datos['producto_codigoserial'], 1, 1, 'C');
      $pdf->SetXY(32, $ejey);
      $pdf->Cell(14, 10, '', 1, 1, 'C');
      $pdf->SetXY(46, $ejey);
      $pdf->Cell(13, 10, $datos['detafact_cantidad'], 1, 1, 'C');
      $pdf->SetFont('Arial', 'B', 5);
      $pdf->SetXY(59, $ejey);
      $pdf->Cell(100, 10, '', 1, 0);
      $pdf->SetXY(59, $ejey);
      $pdf->MultiCell(100, 5, $datos['producto_descripcion'], 'L');
      $pdf->SetFont('Arial', 'B', 7);
      $pdf->SetXY(159, $ejey);
      $pdf->Cell(13, 10, $datos['detafact_preciounitario'], 1, 1, 'C');
      $pdf->SetXY(172, $ejey);
      $pdf->Cell(15, 10, $datos['detafact_descuento'], 1, 1, 'C');
      $pdf->SetXY(187, $ejey);
      $pdf->Cell(13, 10, $datos['detafact_total'], 1, 1, 'C');

      $ejey = $ejey + 10;
    }
    ///////////////
    /*
    $ejey = $ejey + 10;
    $pdf->SetXY(10, $ejey);
    $pdf->Cell(13, 10, 'FAR18', 1, 1, 'C');
    $pdf->SetXY(23, $ejey);
    $pdf->Cell(13, 10, '', 1, 1, 'C');
    $pdf->SetXY(36, $ejey);
    $pdf->Cell(13, 10, '1.00', 1, 1, 'C');
    $pdf->SetFont('Arial', 'B', 5);
    $pdf->SetXY(49, $ejey);
    $pdf->Cell(110, 10, '', 1, 0);
    $pdf->SetXY(49, $ejey);
    $pdf->MultiCell(110, 10, 'ACRYLARM GELs', 'L');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(159, $ejey);
    $pdf->Cell(13, 10, '152.00', 1, 1, 'C');
    $pdf->SetXY(172, $ejey);
    $pdf->Cell(15, 10, '0.00', 1, 1, 'C');
    $pdf->SetXY(187, $ejey);
    $pdf->Cell(13, 10, '152.00', 1, 1, 'C');*/
    $ejey += 10;
    $ejey += 4;
    //KARDEX TOTALES FIN DEL REALIZAR FOREACH O FOR
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(120, $ejey);
    $pdf->Cell(50, 4, 'SUBTOTAL 12%', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 4);
    $pdf->Cell(50, 4, 'SUBTOTAL 0%', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 8);
    $pdf->Cell(50, 4, 'SUBTOTAL NO OBJETO DE IVA', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 12);
    $pdf->Cell(50, 4, 'SUBTOTAL EXENTO DE IVA', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 16);
    $pdf->Cell(50, 4, 'SUBTOTAL SIN IMPUESTOS', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 20);
    $pdf->Cell(50, 4, 'TOTAL DESCUENTO ', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 24);
    $pdf->Cell(50, 4, 'ICE ', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 28);
    $pdf->Cell(50, 4, 'IVA 12%', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 32);
    $pdf->Cell(50, 4, 'TOTAL DEVOLUCION IVA', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 36);
    $pdf->Cell(50, 4, 'IRBPNR', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 40);
    $pdf->Cell(50, 4, 'PROPINA', 1, 1, 'L');
    $pdf->SetXY(120, $ejey + 44);
    $pdf->Cell(50, 4, 'VALOR TOTAL', 1, 1, 'L');
    ////
    //todo::impuestos del iva y 
    $datosDetalle = Factura::obtenerDetalleFacturaImp($resven['factura_id']);
    $base12=0;
    $base0=0;
    $iva12=0;
    $iva0=0;
    foreach ($datosDetalle as $datos) {
      if ($datos['codimp_codigo']=='2' &&$datos['tarifaiva_codigo']=='2'){
        $base12=$datos['detafact_total'];
        $iva12=$datos['impuesto'];
      }else{
        $iva0=$datos['impuesto'];
        $base0=$datos['detafact_total'];
      }
    }
     //todo::valor total del descuento por factura
     $total_descuento=Factura::obtenerTotalDescuento($id_factura);
    $pdf->SetXY(170, $ejey);
    $pdf->Cell(30, 4, $base12, 1, 1, 'R'); //SUBTOTAL 12%
    $pdf->SetXY(170, $ejey + 4);
    $pdf->Cell(30, 4, $base0, 1, 1, 'R'); //subtotal IVA 0
    $pdf->SetXY(170, $ejey + 8);
    $pdf->Cell(30, 4, '0.00', 1, 1, 'R'); //VALOR NO OBJETO
    $pdf->SetXY(170, $ejey + 12);
    $pdf->Cell(30, 4, '0.00', 1, 1, 'R'); //VALOR EXENTO
    $pdf->SetXY(170, $ejey + 16);
    $pdf->Cell(30, 4, $resven['factura_subtotal'], 1, 1, 'R'); //VALOR  sub total sin  IVA
    $pdf->SetXY(170, $ejey + 20);
    $pdf->Cell(30, 4, $total_descuento['total'], 1, 1, 'R'); //SUBTOTAL descuento
    $pdf->SetXY(170, $ejey + 24);
    $pdf->Cell(30, 4, '0.00', 1, 1, 'R'); //ICE
    $pdf->SetXY(170, $ejey + 28);
    $pdf->Cell(30, 4, $iva12, 1, 1, 'R'); //VALOR IVA12
    $pdf->SetXY(170, $ejey + 32);
    $pdf->Cell(30, 4, '0.00', 1, 1, 'R'); //VALOR Devolucion iva
    $pdf->SetXY(170, $ejey + 36);
    $pdf->Cell(30, 4, '0.00', 1, 1, 'R'); //VALOR CON IVA irbpnr
    $pdf->SetXY(170, $ejey + 40);
    $pdf->Cell(30, 4, '0.00', 1, 1, 'R'); //VALOR DESCUENTO propina
    $pdf->SetXY(170, $ejey + 44);
    $pdf->Cell(30, 4, $resven['factura_total'], 1, 1, 'R'); //VALOR CON IV
    //INFO ADICIONAL
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetXY(10, $ejey + 5);
    $pdf->Cell(105, 7, 'INFORMACION ADICIONAL', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(10, $ejey + 6);
    $pdf->SetXY(10, $ejey + 12);
    $pdf->Cell(20, 6, 'Email cliente:', 'L', 1, 'L');
    $pdf->SetXY(10, $ejey + 18);
    $pdf->Cell(20, 6, 'Telefono cliente:', 'L', 1, 'L');
    $pdf->SetXY(30, $ejey + 6);
    $pdf->SetXY(30, $ejey + 12);
    $pdf->Cell(85, 6, $resven['cliente_email'], 'R', 1, 'L');
    $pdf->SetXY(30, $ejey + 18);
    $pdf->Cell(85, 6, $resven['cliente_telefono'], 'R', 1, 'L');
    $pdf->SetXY(10, $ejey + 24);
    $pdf->MultiCell(105, 10, 'Direccion cliente:' . $resven['cliente_direccion'] . $resven['cliente_direccion'], 'LRB', 'L');
    //FORMA DE PAGO
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(10, $ejey + 55);
    $pdf->Cell(75, 6, 'Forma de pago', 1, 1, 'C');
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetXY(85, $ejey + 55);
    $pdf->Cell(30, 6, 'Valor', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(10, $ejey + 61);
    $pdf->Cell(75, 6, $resven['formpago_descripcion'], 'LRB', 1, 'L');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetXY(85, $ejey + 61);
    $pdf->Cell(30, 6, $resven['factura_total'], 'RB', 1, 'L');
    //SAVE
    $pdf->Output($resven['dirDocPdf'] . 'FAC-'.$datosEstaBod['codigo'] . '-' . $datosEstaBod['codPtemi'] . '-' . (str_pad($resven['factura_serie'], 9, "0", STR_PAD_LEFT)).'.pdf', 'F');
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

