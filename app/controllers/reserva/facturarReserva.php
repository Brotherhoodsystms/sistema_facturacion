<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
$id_reserva=$_POST['id_reserva'];
$datosEmisor=Reserva::obtenerSecuencial($id_reserva);
$secuenciaFactura=$datosEmisor['secuencialFactura'];

$datosaFacturar=array();
$datosaFacturar['id_reserva']=$id_reserva;
$datosaFacturar['secuencialFactura']=$secuenciaFactura;
$idFactura=Reserva::guardarFactura($datosaFacturar);
$detalle_factura = array(
    'id_factura' => $idFactura,
    'id_usuario' => $_SESSION['idUser'],
    'id_reserva'=>$id_reserva
  );
  $arrayFactura=array(
    'factura_serie'=>$secuenciaFactura,
    'pto_emision_id'=>$datosEmisor['id'],
    'id_establecimiento'=>$datosEmisor['establecimiento_id'],
  );
  $InFactura = (Reserva::guardarDetalleFactura($detalle_factura));

  ///todo::continuar mvg
  if ($InFactura = true) {
    $actualizacion_serie = (Reserva::actualizarSerieFactura($arrayFactura));
    //todo::ingreso del instorial
    $identificacion = 'FAC';
    $datos = $_SESSION['idUser'];
    $cantidad = Reserva::obtenersumaFactura($idFactura);
    $fecha = date('d-m-Y');
    $Idtransaccion = $identificacion . '-' . $idFactura . '-' . $fecha;
    $accion = 'FACTURA DE VENTA';
    $arrayHistorial = array(
      'accion' => $accion,
      'idtransaccion' => $Idtransaccion,
      'usuario' => $datos
    );
    $historial = Reserva::ingresarHistorial($arrayHistorial);
    $datos_tempubicacion = Reserva::obtenerUbicacionesTemporal($datos); //

    foreach ($datos_tempubicacion as $temp) {
      $temp['idusuario'] = $datos;
      Reserva::actualizacionReferencia($temp, $historial);
    }
    $tipo_comprobante='F';
    $resultado=array(
    );
    $resultado['id_factura'] = $idFactura;
    $resultado['id_tipo'] = $tipo_comprobante;
    $eliminarReserva=Reserva::eliminarReserva($id_reserva);
   // $valor_comision = Venta::ingresoComision($arrayFactura, $idFactura);
   //todo::la comision se asigno al inicio
    echo json_encode($resultado);
    //echo json_encode($datos_tempubicacion);
  }
//var_dump($datosEmisor);
