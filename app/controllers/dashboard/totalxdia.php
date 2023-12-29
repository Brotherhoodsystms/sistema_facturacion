<?php
include_once dirname(dirname(__FILE__)) . "../../models/dashboard.php";
date_default_timezone_set('America/Guayaquil');
$data = Dashboard::obtenerEmisor();
$cantidad_emisores=COUNT($data);
$j=0;
$datos=array();
foreach($data as $elementos){
    $datos[$j]['emisor']=$elementos['nombreComercial'];
    $gastos=Dashboard::obtenerTotalgastosDia($elementos['id']);
    $datos[$j]['gastos']=$gastos['gastos'];
    $compras=Dashboard::obtenerTotalComprasDia($elementos['id']);
    $datos[$j]['compras']=$compras['compras'];
    $ventasf=Dashboard::obtenerTotalVentasDia($elementos['id']);
    //var_dump($ventas);
    $datos[$j]['ventas']=$ventasf['ventas'];
    $datos[$j]['utilidad']=round($datos[$j]['ventas']-($datos[$j]['gastos']+$datos[$j]['compras']),2);
$j=$j+1;
}
echo json_encode($datos);
