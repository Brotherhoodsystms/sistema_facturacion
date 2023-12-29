<?php
include dirname(dirname(__FILE__)) . "../../models/factura.php";

require_once 'Digito_Verificador.php';
//todo::datos de la factura, datos cliente, datos emisor EMPRESA
$sqlven = Factura::obtenerEmisor($_POST['id']);
//todo::datos de establecimiento y bodega
session_start();
$id_bodega = $_SESSION['bodega_id'];
$datosEstaBod = Factura::obtenerBodegaEsta($id_bodega);

$resven = $sqlven;

//todo::forma del xml para la facturacion electronica 
 
$xml = new DOMDocument('1.0', 'utf-8');
$xml->formatOutput = true;
$tipocm = 'FV';
$xml_fac = $xml->createElement('factura');
$cabecera = $xml->createAttribute('id');
$cabecera->value = 'comprobante';
$cabecerav = $xml->createAttribute('version');
$cabecerav->value = '1.0.0';
$xml_inf = $xml->createElement('infoTributaria');
$xml_amb = $xml->createElement('ambiente', $resven['ambiente']);
$xml_tip = $xml->createElement('tipoEmision', '1');
$xml_raz = $xml->createElement('razonSocial', $resven['razonSocial']);
$xml_nom = $xml->createElement('nombreComercial', $resven['nombreComercial']);
$xml_ruc = $xml->createElement('ruc', $resven['ruc']);
$dig = new modulo();

$fechac = date('dmY', strtotime($resven['factura_fechagenerada']));
$codcla = '01';
$ruccla = $resven['ruc'];
$ambien = $resven['ambiente'];
//$punemi = substr($resven['serie_comprobante'], -3); //modificar ptemision
//$seccla = substr($resven['serie_comprobante'], -3); //modificar establecimiento
$punemi = $datosEstaBod['codPtemi']; //modificar ptemision];
$seccla = $datosEstaBod['codigo'];
$secucl = str_pad($resven['factura_serie'], 9, "0", STR_PAD_LEFT);
$tipoem = $resven['tipoEmision'];
$numero = '12345678';
$clave_acceso = $fechac . $codcla . $ruccla . $ambien . $seccla. $punemi . $secucl . $numero . $tipoem;
$xml_cla = $xml->createElement('claveAcceso', $clave_acceso . $dig->getMod11Dv($clave_acceso));
//COMPARACION DEL TIPO DE COMPROBANTE
if ($resven['comprobante_id'] == '1') {
  $xml_doc = $xml->createElement('codDoc', '01');
}
//EXTRAEMOS LOS 3 PRIMEROS DIGITOS DE LA SERIE DEL COMPROBANTEestablecimiento
//$digest = substr($resven['serie_comprobante'], -3);
$xml_est = $xml->createElement('estab', $datosEstaBod['codigo']);
//EXTRAEMOS LOS 3 ULTIMOS DIGITOS DE LA SERIE EL COMPROBANTE pto emision
//$digemi = substr($resven['serie_comprobante'], -3);
$xml_emi = $xml->createElement('ptoEmi', $datosEstaBod['codPtemi']);
$xml_sec = $xml->createElement('secuencial', str_pad($resven['factura_serie'], 9, "0", STR_PAD_LEFT));
$xml_dir = $xml->createElement('dirMatriz', $resven['direccionMatriz']);

//SEGUNDA PARTE
$xml_def = $xml->createElement('infoFactura');
//CONVIERTO LA FECHA AL FORMATO SRI dd/mm/yyyy
$xml_fec = $xml->createElement('fechaEmision', date('d/m/Y', strtotime($resven['factura_fechagenerada'])));
//$xml_fec = $xml->createElement('fechaEmision','22/09/2020');
$xml_des = $xml->createElement('dirEstablecimiento', $resven['direccionMatriz']);
//$xml_con = $xml->createElement('contribuyenteEspecial','NO');
$total_descuento=Factura::obtenerTotalDescuento($resven['factura_id']);

$xml_obl = $xml->createElement('obligadoContabilidad', 'NO');
$xml_ide = $xml->createElement('tipoIdentificacionComprador', $resven['codigo']);
$xml_rco = $xml->createElement('razonSocialComprador', $resven['cliente_razonsocial']);
$xml_idc = $xml->createElement('identificacionComprador', $resven['cliente_ruc']);
$xml_idd = $xml->createElement('direccionComprador', $resven['cliente_direccion']);
$xml_tsi = $xml->createElement('totalSinImpuestos', $resven['factura_subtotal']);
$xml_tds = $xml->createElement('totalDescuento', $total_descuento['total']);

//TODO::SEGUNDA PARTE 2.2todos los impuesto que se aplican a la factura
$datosDetalle = Factura::obtenerDetalleFacturaImp($resven['factura_id']);
$total = count($datosDetalle);
$xml_imp = $xml->createElement('totalConImpuestos');
$codigoanterior = 0;
$codigoporcentajeanterior = 0;
$base_acumulada = 0;
//var_dump($datosDetalle);
//exit();
foreach ($datosDetalle as $datos) {

  $xml_tim = $xml->createElement('totalImpuesto');
  $xml_tco = $xml->createElement('codigo', $datos['codimp_codigo']);
  $xml_cpr = $xml->createElement('codigoPorcentaje', $datos['tarifaiva_codigo']);
  $xml_bas = $xml->createElement('baseImponible', $datos['detafact_total']);
  $xml_val = $xml->createElement('valor', $datos['impuesto']);
  //todo::das

  $xml_imp->appendChild($xml_tim);
  $xml_tim->appendChild($xml_tco);
  $xml_tim->appendChild($xml_cpr);
  $xml_tim->appendChild($xml_bas);
  $xml_tim->appendChild($xml_val);
}






//PARTE 2.3
$xml_pro = $xml->createElement('propina', '0.00');
$xml_imt = $xml->createElement('importeTotal', $resven['factura_total']);
$xml_mon = $xml->createElement('moneda', 'DOLAR');

//PARTE PAGOS
$xml_pgs = $xml->createElement('pagos');
$xml_pag = $xml->createElement('pago');
$xml_fpa = $xml->createElement('formaPago', $resven['formpago_codigo']);
$xml_tot = $xml->createElement('total', $resven['factura_total']);
$xml_pla = $xml->createElement('plazo', '30');
$xml_uti = $xml->createElement('unidadTiempo', 'dias');

//todo::comienzo de detalle factura
$datosDetalle = Factura::obtenerDetalleFactura($resven['factura_id']);

$total = count($datosDetalle);
$xml_dts = $xml->createElement('detalles');
foreach ($datosDetalle as $datos) {


  $xml_det = $xml->createElement('detalle');
  $xml_cop = $xml->createElement('codigoPrincipal', $datos['producto_codigoserial']);
  $xml_dcr = $xml->createElement('descripcion', $datos['producto_descripcion']);
  $xml_can = $xml->createElement('cantidad', $datos['detafact_cantidad']);
  $xml_pru = $xml->createElement('precioUnitario', $datos['detafact_preciounitario']);
  $xml_dsc = $xml->createElement('descuento',$datos['detafact_descuento']);
  $xml_tsm = $xml->createElement('precioTotalSinImpuesto', $datos['detafact_total']);
  $xml_ips = $xml->createElement('impuestos');
  $xml_ipt = $xml->createElement('impuesto');
  //$xml_cdg = $xml->createElement('codigo', substr($resven['codimpuesto'], 1));
  $xml_cdg = $xml->createElement('codigo', $datos['codimp_codigo']);
  $xml_cpt = $xml->createElement('codigoPorcentaje', $datos['tarifaiva_codigo']);
  $xml_trf = $xml->createElement('tarifa', $datos['tarifaiva_porcentaje']);
  $xml_bsi = $xml->createElement('baseImponible', $datos['detafact_total']);
  $impuesto = (($datos['detafact_total'] * $datos['tarifaiva_porcentaje']) / 100);
  //$impuesto = ($datos['detafact_total'] - $datos['precioTotalSinImpuesto']);
  $impuesto = number_format($impuesto, 2, ".", "");//todo::restringir  a 2 decimales la division

  $xml_vlr = $xml->createElement('valor', $impuesto);

  $xml_dts->appendChild($xml_det);
  $xml_det->appendChild($xml_cop);
  $xml_det->appendChild($xml_dcr);
  $xml_det->appendChild($xml_can);
  $xml_det->appendChild($xml_pru);
  $xml_det->appendChild($xml_dsc);
  $xml_det->appendChild($xml_tsm);
  $xml_det->appendChild($xml_ips);
  $xml_ips->appendChild($xml_ipt);
  $xml_ipt->appendChild($xml_cdg);
  $xml_ipt->appendChild($xml_cpt);
  $xml_ipt->appendChild($xml_trf);
  $xml_ipt->appendChild($xml_bsi);
  $xml_ipt->appendChild($xml_vlr);
}




//INFO ADICIONAL
$xml_ifa = $xml->createElement('infoAdicional');
$xml_cp1 = $xml->createElement('campoAdicional', $resven['cliente_email']);
$atributo = $xml->createAttribute('nombre');
$atributo->value = 'email';
/*$xml_cp2 = $xml->createElement('campoAdicional','luisestebanz_@hotmail.com');
$atributo2 = $xml->createAttribute('nombre');
$atributo2->value = 'email';
$xml_cp3 = $xml->createElement('campoAdicional','aniialm16@gmail.com');
$atributo3 = $xml->createAttribute('nombre');
$atributo3->value = 'email';*/
//PRIMERA PARTE


$xml_inf->appendChild($xml_amb);
$xml_inf->appendChild($xml_tip);
$xml_inf->appendChild($xml_raz);
$xml_inf->appendChild($xml_nom);
$xml_inf->appendChild($xml_ruc);
$xml_inf->appendChild($xml_cla);
$xml_inf->appendChild($xml_doc);
$xml_inf->appendChild($xml_est);
$xml_inf->appendChild($xml_emi);
$xml_inf->appendChild($xml_sec);
$xml_inf->appendChild($xml_dir);
$xml_fac->appendChild($xml_inf);

//SEGUNDA PARTE
$xml_def->appendChild($xml_fec);

$xml_def->appendChild($xml_des);
//$xml_def->appendChild($xml_con);

$xml_def->appendChild($xml_obl);
$xml_def->appendChild($xml_ide);
$xml_def->appendChild($xml_rco);
$xml_def->appendChild($xml_idc);
$xml_def->appendChild($xml_idd);
$xml_def->appendChild($xml_tsi);
$xml_def->appendChild($xml_tds);
$xml_def->appendChild($xml_imp);

$xml_imp->appendChild($xml_tim);

$xml_fac->appendChild($xml_def);
//todo::impuestos cuando el documento no tiene datos de impuestos


//SEGUNDA PARTE 2.3

$xml_def->appendChild($xml_pro);
$xml_def->appendChild($xml_imt);
$xml_def->appendChild($xml_mon);


$xml_def->appendChild($xml_pgs);
$xml_pgs->appendChild($xml_pag);
$xml_pag->appendChild($xml_fpa);
$xml_pag->appendChild($xml_tot);
$xml_pag->appendChild($xml_pla);
$xml_pag->appendChild($xml_uti);

$xml_fac->appendChild($xml_dts);






$xml_fac->appendChild($xml_ifa);
$xml_ifa->appendChild($xml_cp1);
$xml_cp1->appendChild($atributo);

$xml_fac->appendChild($cabecera);
$xml_fac->appendChild($cabecerav);
$xml->appendChild($xml_fac);


//$xml->save("file.xml");
//print_r ($xml->saveXML());$seccla
echo 'CREADO: ' . $xml->save($resven["dirDocNoAutorizados"] . 'FAC-' .  $seccla . '-' .$punemi  . '-' . $secucl . '.xml') . ' bytes';
//echo 'CREADO: ' . $xml->save('../../comprobantes/no_firmados/prueba.xml') . ' bytes';
//"./no_firmado/".$xml_cla.".xml"
header("Location: Firmar_Xml.php?id=" . $_POST['id'] . "&cla=" . 'FAC-' . $seccla  . '-' . $punemi. '-' . $secucl);