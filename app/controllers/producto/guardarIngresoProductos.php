<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
session_start();
$id_usuario = $_SESSION['idUser'];
$datos_temporales = Producto::obtenerUbicacionTemporalparaIngreso($id_usuario);
$totalProducto_temporal = count($datos_temporales);

$i = 0;
if ($totalProducto_temporal > 0) {
  foreach ($datos_temporales as $temp) {
    $temp['id_usuario'] = $id_usuario;
    $temp['id_facturaCompra'] = $_POST['id_facturaCompra'];
    $temp['total_factura'] = $_POST['factura_total'];

    $validarCodigoProducto = Producto::validarProducto($temp['temp_producto_codigoserial']);


    if ($validarCodigoProducto != false) { //validacion si existe producto
      $nuevaCantidadProducto = $validarCodigoProducto[0]['producto_stock'] + $temp['temp_producto_stock'];

      if(empty($temp['temp_producto_imagen'])){
        $actualizarProductoDatos = array(
          'id_producto' => $validarCodigoProducto[0]['producto_id'],
          'cantidad_producto' => $nuevaCantidadProducto,
          'precio_menor' => $temp['temp_producto_precio_menor'],
          'precio_mayor' => $temp['temp_producto_precio_mayor']
          //todo::aumentar los campos de valores para actualizar el valor
        );
        $actualizarProducto = Producto::actualizarProducto($actualizarProductoDatos);
      }else{
        $actualizarProductoDatos = array(
          'id_producto' => $validarCodigoProducto[0]['producto_id'],
          'cantidad_producto' => $nuevaCantidadProducto,
          'precio_menor' => $temp['temp_producto_precio_menor'],
          'precio_mayor' => $temp['temp_producto_precio_mayor'],
          'producto_imagen' => $temp['temp_producto_imagen']
          //todo::aumentar los campos de valores para actualizar el valor
        );
        $actualizarProducto = Producto::actualizarProductoImagen($actualizarProductoDatos);
      }
     // $actualizarProducto = Producto::actualizarProducto($actualizarProductoDatos);
      $validarUbicacion = Producto::validarUbicacion($temp['temp_pro_bodegaid'], $temp['temp_pro_ubicaccion'], $validarCodigoProducto[0]['producto_id']);
      if ($validarUbicacion != false) { //todo::validacion si existe en la ubicacion
        $nuevaCantidadUbicacion = $validarUbicacion['ubicacion_cantidad'] + $temp['temp_producto_stock'];
        $actualizarUbicacion = array(
          'idubicacion' => $validarUbicacion['ubicacion_id'],
          'cantidad_ubicacion' => $nuevaCantidadUbicacion
        );
        $temp['id_productiP'] = $validarCodigoProducto[0]['producto_id'];
        //todo::guardarUbicacionTemporar guarda los datos en
        //la tabla temporal donde se
        //registra todos los movimientos en cuanto a producto
        $guardadoTemporal = Producto::guardarUbicacionTemporal($temp);
        Producto::eliminarProductoTemporal($temp['temp_producto_id']);
      } else {
        $temp['id_productiP'] = $validarCodigoProducto[0]['producto_id'];
        $guardadoTemporal = Producto::guardarUbicacionTemporal($temp);
        Producto::eliminarProductoTemporal($temp['temp_producto_id']);
      }
    } else { //todo::el producto no existe en la tabla principal


      $id_productoIngresado = Producto::guardarProductoIn($temp['temp_producto_id']);
      Producto::eliminarProductoTemporal($temp['temp_producto_id']);
      $temp['id_productiP'] = $id_productoIngresado;
      $guardadoTemporal = Producto::guardarUbicacionTemporal($temp);
    }
  }
  //todo::guardado de informacion para historial aqui poner el total
  $identificacion = 'IB';
  $datos = $_SESSION['idUser'];
  $cantidad = Producto::obtenerUbicacionTemporalcantidad($datos);
  $fecha = date('d-m-Y');
  $Idtransaccion = $identificacion . '-' . $cantidad['sum(tem_ubica_cantidad )'] . '-' . $fecha;
  $accion = 'INGRESO DE PRODUCTOS';
  $arrayHistorial = array(
    'accion' => $accion,
    'idtransaccion' => $Idtransaccion,
    'usuario' => $datos
  );
  $tipo_gasto='COMPRA';
  $id_historial = Producto::ingresarHistorial($arrayHistorial);
  $arrayGastos=array(
    'id_usuario' => $id_usuario,
    'gasto_factura' => $_POST['id_facturaCompra'],
    'gastos_total' => $_POST['factura_total'],
    'gastos_descripcion' => $accion,
    'tipo_gasto' => $tipo_gasto,
    'historial_id'=>$id_historial,
    'emisor_id'=>$_SESSION['emisor_id']


  );
  $ingresoGastos=Producto::guardarGastos($arrayGastos);
  $datos_tempubicacion = Producto::obtenerUbicacionesTemporal($datos); //
  $resutlado = array();
  $i = 0;
  foreach ($datos_tempubicacion as $temp) {
    //todo::datos iguales dependiendo de la tabla que tenemos
    $validacion = Producto::validarUbicacion2($temp);
    $temp['idusuario'] = $datos;
    if (count($validacion) > 0) {
      //echo json_encode($temp);
      $cantidad = $validacion[0]['ubicacion_cantidad'] + $temp['tem_ubica_cantidad'];
      $actualizacion = Producto::actualizarCantidad($temp, $cantidad);
      //todo::crear un array que envie el estado del ingreso y que nos envie
      //todo::el valor del historial de ingreso para la impresion
      //todo guardar en una variable al ejecuacion de actualizacio de la refee
      $estado = Producto::actualizacionReferencia($temp, $id_historial);
      $resutlado[$i]['estado'] = $estado;
      $resutlado[$i]['id_historial'] = $id_historial;
      //echo json_encode($resutlado);
    } else {
      $nuevoIngresoUbicacion = Producto::guardarNuevaUbicacion($temp);
      //todo::crear un array que envie el estado del ingreso y que nos envie
      //todo::el valor del historial de ingreso para la impresion
      //todo guardar en una variable al ejecuacion de actualizacio de la refee
      $estado = Producto::actualizacionReferencia($temp, $id_historial);
      $resutlado[$i]['estado'] = $estado;
      $resutlado[$i]['id_historial'] = $id_historial;
      //echo json_encode($resutlado);
    }
    $i++;
  }
  echo json_encode($resutlado);
} else {
  $resutlado = array();
  $resutlado[$i]['estado'] = 2;
  echo json_encode($resutlado);
}
