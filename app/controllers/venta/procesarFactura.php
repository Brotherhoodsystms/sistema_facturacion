<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/venta.php";

$actualizarCliente = Venta::actualizarCliente($_POST["id_cliente"],$_POST["razonsocial_cliente"],$_POST["ruc_cliente"],$_POST["direccio_cliente"],$_POST["correo_cliente"]);
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
  'factura_iva' => $_POST["factura_iva"],
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

if ($_POST["comprobante_id"] == 1) {//todo::ingreso de factura

  $id_factura = Venta::guardarFactura($arrayFactura);
  $detalle_factura = array(
    'id_factura' => $id_factura,
    'id_usuario' => $_SESSION['idUser']
  );
  $InFactura = (Venta::guardarDetalleFactura($detalle_factura));

  if ($InFactura = true) {
    $actualizacion_serie = (Venta::actualizarSerieFactura($arrayFactura));
    //todo::ingreso del instorial
    $identificacion = 'FAC';
    $datos = $_SESSION['idUser'];
    $cantidad = Venta::obtenersumaFactura($id_factura);
    $fecha = date('d-m-Y');
    $Idtransaccion = $identificacion . '-' . $id_factura . '-' . $fecha;
    $accion = 'FACTURA DE VENTA';
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
    $tipo_comprobante='F';
    $resultado=array(
    );
    $resultado['id_factura'] = $id_factura;
    $resultado['id_tipo'] = $tipo_comprobante;
    $valor_comision = Venta::ingresoComision($arrayFactura, $id_factura);
    echo json_encode($resultado);
    //echo json_encode($datos_tempubicacion);
  }
} else if ($_POST["comprobante_id"] == 2) {//todo::si e nota de venta

  $id_nota_venta = Venta::guardarNotaVenta($arrayFactura);
  $detalle_notaventa = array(
    'id_factura' => $id_nota_venta,
    'id_usuario' => $_SESSION['idUser']
  );
  $InFactura = (Venta::guardarDetalleNotaVenta($detalle_notaventa));
  if ($InFactura = true) {
    $actualizacion_serieNota = (Venta::actualizarSerieNotaVenta($arrayFactura));
    //todo::ingreso del hinstorial
    $identificacion = 'NOTVE';
    $datos = $_SESSION['idUser'];
    //$cantidad = Venta::obtenersumaFactura($id_factura);
    $fecha = date('d-m-Y');
    $Idtransaccion = $identificacion . '-' . $id_nota_venta . '-' . $fecha;
    $accion = 'NOTA DE VENTA';
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
    $tipo_comprobante='N';
    $resultado=array(
    );
    $resultado['id_factura'] = $id_nota_venta;
    $resultado['id_tipo'] = $tipo_comprobante;
    $valor_comision = Venta::ingresoComision($arrayFactura, $id_nota_venta);
    echo json_encode($resultado);
  }
} else if ($_POST["comprobante_id"] == 3) {//todo::reserva
  
  
  $id_reserva = Venta::guardarReserva($arrayFactura);
 
  
  $detalle_reserva = array(
    'id_factura' => $id_reserva,
    'id_usuario' => $_SESSION['idUser']
  );
  $InFactura = (Venta::guardarDetalleReserva($detalle_reserva));
  if ($InFactura = true) {
    $valoractualizarReserva = Venta::actualizarSerieReserva($arrayFactura);
    //todo::ingreso del hinstorial
    $identificacion = 'RESE';
    $datos = $_SESSION['idUser'];
    //$cantidad = Venta::obtenersumaFactura($id_factura);
    $fecha = date('d-m-Y');
    $Idtransaccion = $identificacion . '-' . $id_reserva . '-' . $fecha;
    $accion = 'RESERVA';
    $arrayHistorial = array(
      'accion' => $accion,
      'idtransaccion' => $Idtransaccion,
      'usuario' => $datos
    );
    $historial = Venta::ingresarHistorial($arrayHistorial);
    $datos_tempubicacion = Venta::obtenerUbicacionesTemporal($datos); //

    foreach ($datos_tempubicacion as $temp){
      $temp['idusuario'] = $datos;
      Venta::actualizacionReferencia($temp, $historial);
    }
    $tipo_comprobante='R';
    $resultado=array(
    );
    $resultado['id_factura'] = $id_reserva;
    $resultado['id_tipo'] = $tipo_comprobante;
    $valor_comision = Venta::ingresoComision($arrayFactura, $id_reserva);
    echo json_encode($resultado);
  }
}


//echo json_encode(Venta::guardarDetalleFactura($detalle_factura));
