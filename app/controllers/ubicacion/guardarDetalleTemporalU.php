<?php
include dirname(dirname(__FILE__)) . "../../models/ubicacion.php";
session_start();
if ($_POST['producto_comprar'] > $_POST['producto_stock']) {
  echo json_encode(false);
} else {

  $arrayName = array(

    'bodega_idE' => $_POST['bodega_idE'],
    'producto_idE' => $_POST['producto_idE'],
    'producto_codigoserial' => $_POST['producto_codigoserial'],
    'producto_stock' => $_POST['producto_stock'],
    'producto_comprar' => $_POST['producto_comprar'],
    'sucursal_id' => $_POST['sucursal_id'],
    'sucursal_id_d' => $_POST['sucursal_id_d'],
    'bodega_id_o' => $_POST['bodega_id_o'],
    'ubicacion_bodega_r' => $_POST['ubicacion_bodega_r'],
    'ubicacion_descripcion_o' => $_POST['ubicacion_descripcion_o'],
    'ubicacion_descripcion' => $_POST['ubicacion_descripcion'],
    'id_usuario' => $_SESSION['idUser']
  );
  $datos_iguales = Ubicacion::validarIngresoTemporal($arrayName);
  //if ($datos_iguales == false) {
    $Ing_temporal1 = (Ubicacion::guardarUbicacionTemporal($arrayName));
  //} /*else {

    //echo json_encode($datos_iguales);
   // $arrayName['tempo_id'] = $datos_iguales['tem_ubica_id'];
    //$arrayName['temporal_cantidad'] = $datos_iguales['tem_ubica_cantidad'] + $arrayName['producto_comprar'];
   // $Ing_temporal1 = (Ubicacion::actualizarUbicacionTemporal($arrayName));
  //}*/
  if ($Ing_temporal1 == true) {
    echo json_encode(Ubicacion::actualizarProductoOrigen($arrayName));
  }
}
//echo json_encode(Ubicacion::guardarUbicacionTemporal($arrayName));
/*
if (Ubicacion::validarBodegaUbicacion(strtoupper($_POST['ubicacion_descripcion']), $_POST['ubicacion_bodega_r'])) {
  echo 0;
} else {
  echo json_encode(Ubicacion::guardarUbicacion($arrayName));
}
*/
//echo json_encode($arrayName);
