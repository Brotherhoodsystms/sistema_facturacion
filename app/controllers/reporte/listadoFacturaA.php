<?php
session_start();
include dirname(dirname(__FILE__)) . '../../models/reporte.php';
//$data = Factura::obtenerFacturasActivas();

$data = Reporte::obtenerFacturasActivas($_SESSION['emisor_id']);
$totalFacturaC=Reporte::obtenerTotalFacturasA($_SESSION['emisor_id']);
$comprobante_salida = Reporte::comprobante_salida($_SESSION['emisor_id']);
$totalCompC=Reporte::obtenerTotalComproA($_SESSION['emisor_id']);
$reserva=Reporte::obtenerReservas($_SESSION['emisor_id']);
$totalRes=Reporte::obtenerTotolReser($_SESSION['emisor_id']);
$totales=$totalFacturaC['total']+$totalCompC['total']+$totalRes['total'];
$totales=round($totales,2);
$ftotal = count($data);
$i = 0;


if ($comprobante_salida != '') {
    foreach ($comprobante_salida as $c) {
        $data[$ftotal]['factura_serie'] = $c['notaventa_serie'];
        $data[$ftotal]['nombreComercial']=$c['nombreComercial'];
        $data[$ftotal]['factura_fechagenerada'] = $c['notaventa_fechagenerada'];
        $data[$ftotal]['formpago_id'] = $c['formpago_id'];
        $data[$ftotal]['cliente_id'] = $c['cliente_id'];
        $data[$ftotal]['comprobante_id'] = $c['comprobante_id'];
        $data[$ftotal]['factura_total'] = $c['notaventa_total'];
        $data[$ftotal]['comprobante_descripcion']=$c['comprobante_descripcion'];
        $data[$ftotal]['formpago_descripcion']=$c['formpago_descripcion'];
        $data[$ftotal]['cliente_razonsocial']=$c['cliente_razonsocial'];
        $data[$ftotal]['cliente_ruc']=$c['cliente_ruc'];
        $ftotal=$ftotal+1;/*  */
    }
    if($reserva!=''){
        foreach ($reserva as $c) {
            $data[$ftotal]['factura_serie'] = $c['reserva_numero'];
            $data[$ftotal]['nombreComercial']=$c['nombreComercial'];
            $data[$ftotal]['factura_fechagenerada'] = $c['reserva_fechainicio'];
            $data[$ftotal]['formpago_id'] = $c['formpago_id'];
            $data[$ftotal]['cliente_id'] = $c['cliente_id'];
            $data[$ftotal]['comprobante_id'] = $c['reservas_comprobanteid'];
            $data[$ftotal]['factura_total'] = $c['reserva_total'];
            $data[$ftotal]['comprobante_descripcion']=$c['comprobante_descripcion'];
            $data[$ftotal]['formpago_descripcion']=$c['formpago_descripcion'];
            $data[$ftotal]['cliente_razonsocial']=$c['cliente_razonsocial'];
        $data[$ftotal]['cliente_ruc']=$c['cliente_ruc'];
            $ftotal=$ftotal+1;
        }
    }
}else if($reserva!=''){
    foreach ($reserva as $c) {
        $data[$ftotal]['factura_serie'] = $c['reserva_numero'];
        $data[$ftotal]['nombreComercial']=$c['nombreComercial'];
        $data[$ftotal]['factura_fechagenerada'] = $c['reserva_fechainicio'];
        $data[$ftotal]['formpago_id'] = $c['formpago_id'];
        $data[$ftotal]['cliente_id'] = $c['cliente_id'];
        $data[$ftotal]['comprobante_id'] = $c['reservas_comprobanteid'];
        $data[$ftotal]['factura_total'] = $c['reserva_total'];
        $data[$ftotal]['comprobante_descripcion']=$c['comprobante_descripcion'];
        $data[$ftotal]['formpago_descripcion']=$c['formpago_descripcion'];
        $data[$ftotal]['cliente_razonsocial']=$c['cliente_razonsocial'];
        $data[$ftotal]['cliente_ruc']=$c['cliente_ruc'];
        $ftotal=$ftotal+1;
    }

}

    
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    
    echo json_encode($datos);

