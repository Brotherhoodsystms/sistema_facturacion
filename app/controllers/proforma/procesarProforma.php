<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/venta.php";
if ($_POST['id_vendedor'] == 'Seleccione') {
  $vendedor = 1;
} else {
  $vendedor = $_POST["id_vendedor"];
}
$arrayFactura = array(
  'id_cliente' => $_POST["id_cliente"],
  'id_vendedor' => $vendedor,
  'comision_vende' => $_POST["comision_vende"],
  'forma_id' => $_POST["forma_id"],
  'comprobante_id' => $_POST["comprobante_id"],
  'factura_serie' => $_POST["factura_serie"],
  'factura_fechagenerada' => $_POST["factura_fechagenerada"],
  //'factura_iva' => $_POST["factura_iva"],
  'factura_subtotal' => $_POST["factura_subtotal"],
  'factura_total' => $_POST["factura_total"],
  'reserva_numero' => $_POST["reserva_numero"],
  'reserva_abono' => $_POST["reserva_abono"],
  'reserva_saldopendiente' => $_POST["reserva_saldopendiente"],
  'reserva_fechafinal' => $_POST["reserva_fechafinal"],
  'id_usuario' => $_SESSION['idUser'],
  'pto_emision_id' => $_POST["pto_emision_id"],
  'id_establecimiento' => $_POST["id_establecimiento"],
  'emisor_id' => $_SESSION["emisor_id"]

);
if ($_POST["comprobante_id"] == 4) {//todo::ingreso de factura

    $id_factura = Venta::guardarProforma($arrayFactura);
    $detalle_factura = array(
      'id_factura' => $id_factura,
      'id_usuario' => $_SESSION['idUser']
    );
    $InFactura = (Venta::guardarDetalleProforma($detalle_factura));
    //todo::aqui guardamos el detalle del hisotorial
    if ($InFactura = true) {
      $actualizacion_serie = (Venta::actualizarSerieProforma($arrayFactura));
      //todo::ingreso del hinstorial
      $identificacion = 'PROF';
      $datos = $_SESSION['idUser'];
      $cantidad = Venta::obtenersumaProforma($id_factura);
      $fecha = date('d-m-Y');
      $Idtransaccion = $identificacion . '-' . $id_factura . '-' . $fecha;
      $accion = 'PROFORMA';
      $arrayHistorial = array(
        'accion' => $accion,
        'idtransaccion' => $Idtransaccion,
        'usuario' => $datos
      );
      $historial = Venta::ingresarHistorial($arrayHistorial);
      $datos_tempubicacion = Venta::obtenerUbicacionesTemporal($datos); //
      foreach ($datos_tempubicacion as $temp) {
        $temp['idusuario'] = $datos;
        Venta::actualizacionReferencia($temp, $historial);
      }
      $tipo_comprobante='P';
      $resultado=array();
      $resultado['id_factura'] = $id_factura;
      $resultado['id_tipo'] = $tipo_comprobante;
      $valor_comision = Venta::ingresoComision($arrayFactura, $id_factura);
      echo json_encode($resultado);
      //echo json_encode($datos_tempubicacion);
    }
}
