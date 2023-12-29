<?php
include dirname(dirname(__FILE__)) . '../../models/reporte.php';
session_start();
$emisor_id = $_SESSION['emisor_id'];

if ($_POST['valor'] == 1) {
    echo json_encode(Reporte::obtenerReservaProducto($_POST['parametro']));
} elseif ($_POST['valor'] == 2) {
    $data = Reporte::obtenerFacturaCliente($_POST['parametro'], $_POST['sucursal']);
    $totalFacturaC=Reporte::obtenerTotalFacturaCliente($_POST['parametro'], $_POST['sucursal']);
    $comprobante_salida = Reporte::comprobante_salidaCliente($_POST['parametro'],$_POST['sucursal']);
    $totalCompC=Reporte::obtenerTotalComprobanteCliente($_POST['parametro'],$_POST['sucursal']);
    $reserva = Reporte::obtenerReservasCliente($_POST['parametro'],$_POST['sucursal']);
    $totalRes=Reporte::obtenertTotalReserva($_POST['parametro'],$_POST['sucursal']);
    $data=datos($data,$comprobante_salida,$reserva);
    $totales=$totalFacturaC+$totalCompC+$totalRes;
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    //echo json_encode($datos);
    echo json_encode($datos);
    //var_dump($comprobante_salida);

} elseif ($_POST['valor'] == 7) {
    $data = Reporte::obtenerFacturaFormapago($_POST['formapago'], $_POST['sucursal']);
    $totalFacturaC=Reporte::obtenerTotalFormaPagF($_POST['formapago'],$_POST['sucursal']);
    $comprobante_salida = Reporte::comprobante_salidaFormapago($_POST['formapago'],$_POST['sucursal']);
    $totalCompC=Reporte::obtenerTotalcomproForma($_POST['formapago'],$_POST['sucursal']);
    $reserva = Reporte::obtenerReservasFormapago($_POST['formapago'],$_POST['sucursal']);
    $totalRes=Reporte::obtenerTotalResFor($_POST['formapago'],$_POST['sucursal']);
    $data=(datos($data,$comprobante_salida,$reserva));
    $totales=$totalFacturaC+$totalCompC+$totalRes;
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);
} elseif ($_POST['valor'] == 8) {
    $data = Reporte::obtenerFacturaTipoComprobante($_POST['tipoComprobante'], $_POST['sucursal']);
    $totalFacturaC=Reporte::obtenertotalFacturaTC($_POST['tipoComprobante'], $_POST['sucursal']);
    $comprobante_salida = Reporte::comprobante_salidaTipoComprobante($_POST['tipoComprobante'],$_POST['sucursal']);
    $totalCompC=Reporte::obtenerComprTC($_POST['tipoComprobante'],$_POST['sucursal']);
    $reserva = Reporte::obtenerReservasTipoComprobante($_POST['tipoComprobante'],$_POST['sucursal']);
    $totalRes=Reporte::obtenerTotalResTC($_POST['tipoComprobante'],$_POST['sucursal']);
    $data=(datos($data,$comprobante_salida,$reserva));
    $totales=$totalFacturaC+$totalCompC+$totalRes;
    $datos=array('busqueda'=>$data,
    'totales'=>$totales);
    echo json_encode($datos);

} elseif ($_POST['valor'] == 5) {
    echo json_encode(Reporte::obtenerReservaFormaPago($_POST['parametro']));
} else {
    echo 0;
}
//todo::funcion que nos da los datos en uno solo
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