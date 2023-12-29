<?php
include dirname(dirname(__FILE__)) . "../../models/dashboard.php";

session_start();
//$datos = 1;
date_default_timezone_set('America/Guayaquil');

$datos = $_SESSION['idUser'];
$emisor_id=$_SESSION['emisor_id'];
if($_SESSION['id_rol']=='1'){
$datat = Dashboard::totalFacturasAd($datos,$emisor_id);
$facturasValor = Dashboard::totalVendidosAd($datos,$emisor_id);
$clientes=Dashboard::totalClientes();
$productos=Dashboard::totalProductos();
$notaVenta=Dashboard::totalNotaVentaAd($datos,$emisor_id);
$reserva=Dashboard::totalReservaAd($datos,$emisor_id);
$notasVentaTotal=$notaVenta[0]['totaln'];
$reserTotal=$reserva[0]['totalr'];

}else{


$datat = Dashboard::totalFacturas($datos,$emisor_id);
$facturasValor = Dashboard::totalVendidos($datos,$emisor_id);
$clientes=Dashboard::totalClientes();
$productos=Dashboard::totalProductos();
$notaVenta=Dashboard::totalNotaVenta($datos,$emisor_id);
$reserva=Dashboard::totalReserva($datos,$emisor_id);
$notasVentaTotal=$notaVenta[0]['totaln'];
$reserTotal=$reserva[0]['totalr'];

}
//todo:gastosy compras
$compras=Dashboard::total_compra();
$gastos=Dashboard::totalGastos();
$facturastotalMes=Dashboard::totalFacturastmes();
//todo::cambiar el margen de utilidad esta por dia en ventas y total por compras y gastos  corregir para el
//todo::en base a la anterior funcion
$utilidad=($facturastotalMes[0]['total']+$reserva[0]['total']+$notaVenta[0]['total'])-($compras[0]['total']+$gastos[0]['total']);

$data1['ventas_dia'] = round(($facturasValor[0]['total']+$reserva[0]['total']+$notaVenta[0]['total']),2);
$data1['total_facturas'] = $datat[0]['total'];
$data1['total_clientes'] = $clientes[0]['total'];
$data1['total_productos'] = $productos[0]['total'];
$data1['total_notaVenta'] = $notaVenta[0]['totaln'];
$data1['total_reserva'] = $reserva[0]['totalr'];
$data1['total_compras'] = $compras[0]['total'];
$data1['total_gastos'] = $gastos[0]['total'];
$data1['total_utilidad'] = $utilidad;



echo json_encode($data1);
