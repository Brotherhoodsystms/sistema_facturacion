<?php
include dirname(dirname(__FILE__)) . "../../models/reporte.php";
session_start();
if ($_POST["valor"] == 6) {
  //echo json_encode(Reporte::obtenerFacturaFecha($_POST["fecha_i"], $_POST["fecha_f"],$_SESSION['emisor_id']));
  $data = Reporte::obtenerFacturaFecha($_POST["fecha_i"], $_POST["fecha_f"],$_POST['sucursal']);
  $totalFacturaC=Reporte::obtenerTotalVentasFecha($_POST["fecha_i"], $_POST["fecha_f"],$_POST['sucursal']);
    $comprobante_salida = Reporte::obtenerComprobante_salidaFecha($_POST["fecha_i"], $_POST["fecha_f"],$_POST['sucursal']);
    $totalCompC=Reporte::obtenerTotalComproFecha($_POST["fecha_i"], $_POST["fecha_f"],$_POST['sucursal']);
    $reserva = Reporte::obtenerReservaFecha($_POST["fecha_i"], $_POST["fecha_f"],$_POST['sucursal']);
    $totalRes=Reporte::obtenerTotalReservaFecha($_POST["fecha_i"], $_POST["fecha_f"],$_POST['sucursal']);
    $data=(datos($data,$comprobante_salida,$reserva));
    $totales=$totalFacturaC+$totalCompC+$totalRes;
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
} else {
  echo 0;
}
//todo::funcion que nos da los datos en uno sololo podemos optimizar en la en un archivo diferente
function datos($data,$comprobante_salida,$reserva){
    $ftotal = count($data);
    $i = 0;

    if ($comprobante_salida != '') {
        foreach ($comprobante_salida as $c) {
            $data[$ftotal]['factura_serie'] = $c['notaventa_serie'];
            $data[$ftotal]['nombreComercial']=$c['nombreComercial'];
            $data[$ftotal]['factura_fechagenerada'] =
                $c['notaventa_fechagenerada'];
            $data[$ftotal]['formpago_id'] = $c['formpago_id'];
            $data[$ftotal]['cliente_id'] = $c['cliente_id'];
            $data[$ftotal]['comprobante_id'] = $c['comprobante_id'];
            $data[$ftotal]['factura_total'] = $c['notaventa_total'];
            $data[$ftotal]['comprobante_descripcion'] =
                $c['comprobante_descripcion'];
            $data[$ftotal]['formpago_descripcion'] = $c['formpago_descripcion'];
            $data[$ftotal]['cliente_razonsocial'] = $c['cliente_razonsocial'];
            $data[$ftotal]['cliente_ruc'] = $c['cliente_ruc'];
            $ftotal = $ftotal + 1; /*  */
        }
        if ($reserva != '') {
            foreach ($reserva as $c) {
                $data[$ftotal]['factura_serie'] = $c['reserva_numero'];
                $data[$ftotal]['nombreComercial']=$c['nombreComercial'];
                $data[$ftotal]['factura_fechagenerada'] =
                    $c['reserva_fechainicio'];
                $data[$ftotal]['formpago_id'] = $c['formpago_id'];
                $data[$ftotal]['cliente_id'] = $c['cliente_id'];
                $data[$ftotal]['comprobante_id'] = $c['reservas_comprobanteid'];
                $data[$ftotal]['factura_total'] = $c['reserva_total'];
                $data[$ftotal]['comprobante_descripcion'] =
                    $c['comprobante_descripcion'];
                $data[$ftotal]['formpago_descripcion'] =
                    $c['formpago_descripcion'];
                $data[$ftotal]['cliente_razonsocial'] =
                    $c['cliente_razonsocial'];
                $data[$ftotal]['cliente_ruc'] = $c['cliente_ruc'];
                $ftotal = $ftotal + 1;
            }
        }
    } elseif ($reserva != '') {
        foreach ($reserva as $c) {
            $data[$ftotal]['factura_serie'] = $c['reserva_numero'];
            $data[$ftotal]['nombreComercial']=$c['nombreComercial'];
            $data[$ftotal]['factura_fechagenerada'] = $c['reserva_fechainicio'];
            $data[$ftotal]['formpago_id'] = $c['formpago_id'];
            $data[$ftotal]['cliente_id'] = $c['cliente_id'];
            $data[$ftotal]['comprobante_id'] = $c['reservas_comprobanteid'];
            $data[$ftotal]['factura_total'] = $c['reserva_total'];
            $data[$ftotal]['comprobante_descripcion'] =
                $c['comprobante_descripcion'];
            $data[$ftotal]['formpago_descripcion'] = $c['formpago_descripcion'];
            $data[$ftotal]['cliente_razonsocial'] = $c['cliente_razonsocial'];
            $data[$ftotal]['cliente_ruc'] = $c['cliente_ruc'];
            $ftotal = $ftotal + 1;
        }
    }
    return $data;

}