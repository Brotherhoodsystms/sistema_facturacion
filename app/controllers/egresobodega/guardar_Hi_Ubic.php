<?php
include dirname(dirname(__FILE__)) . "../../models/egresoubicacion.php";
//include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
session_start();
//$datos = 1;
$identificacion = 'EB';
$datos = $_SESSION['idUser'];
$cantidad = Egresoubicacion::obtenerUbicacionTemporal($datos);
$fecha = date('d-m-Y');
$Idtransaccion = $identificacion . '-' . $cantidad['sum(tem_ubica_cantidad )'] . '-' . $fecha;
$accion = 'EGRESO DE PRODUCTOS';
$arrayHistorial = array(
  'accion' => $accion,
  'idtransaccion' => $Idtransaccion,
  'usuario' => $datos
);
$id_historial = Egresoubicacion::ingresarHistorial($arrayHistorial);

//todo:validar si existe el producto en la bodega si //
$datos_tempubicacion = Egresoubicacion::obtenerUbicacionesTemporal($datos); //
$resultado = array();
$i = 0;
foreach ($datos_tempubicacion as $temp) {
  /*buscar::datos iguales dependiendo de la tabla que tenemos*/
  $validacion = Egresoubicacion::validarUbicacion($temp);
  $temp['idusuario'] = $datos;
  if (count($validacion) > 0) {
    //echo json_encode($temp);
    $cantidad = $validacion[0]['ubicacion_cantidad'] + $temp['tem_ubica_cantidad'];
    $actualizacion = Egresoubicacion::actualizarCantidad($temp, $cantidad);
    $estado = Egresoubicacion::actualizacionReferencia($temp, $id_historial);
    //echo json_encode();
    $resultado[$i]['estado'] = $estado;
    $resultado[$i]['id_historial'] = $id_historial;
  } else {
    $nuevoIngresoUbicacion = Egresoubicacion::guardarNuevaUbicacion($temp);
    //echo json_encode(Egresoubicacion::actualizacionReferencia($temp, $id_historial));

    $estado = Egresoubicacion::actualizacionReferencia($temp, $id_historial);
    $resultado[$i]['estado'] = $estado;
    $resultado[$i]['id_historial'] = $id_historial;
  }
  $i++;
}
echo json_encode($resultado);
