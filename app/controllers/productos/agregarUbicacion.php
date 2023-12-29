<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/productos.php";
$arrayName = array(
    'producto_id'=>$_POST["id"],
    'bodega_id'=> $_SESSION['bodega_id'],
    'ubicacion_descripcion'=> "PUNTO-VENTA",
    'ubicacion_cantidad'=> round(($_POST["ubicacion_cantidad"]),2)
  );
    //todo::guardado de informacion para historial aqui poner el total
    $identificacion = 'IB';
    $datos = $_SESSION['idUser'];
    $cantidad = round(($_POST["ubicacion_cantidad"] * $_POST["producto_precio_menor"]),2);
    $fecha = date('d-m-Y');
    $Idtransaccion = $identificacion . '-' . $cantidad . '-' . $fecha;
    $accion = 'INGRESO DE PRODUCTOS';
    $arrayHistorial = array(
      'accion' => $accion,
      'idtransaccion' => $Idtransaccion,
      'usuario' => $datos
    );
    $tipo_gasto='COMPRA';
    $id_historial = Productos::ingresarHistorial($arrayHistorial);
    $IdtransaccionCompra = 'SN';
    $arrayGastos=array(
      'id_usuario' => $_SESSION['idUser'],
      'gasto_factura' => $IdtransaccionCompra,
      'gastos_total' => $cantidad,
      'gastos_descripcion' => $accion,
      'tipo_gasto' => $tipo_gasto,
      'historial_id'=>$id_historial,
      'emisor_id'=>$_SESSION['emisor_id']
    );
    $ingresoGastos=Productos::guardarGastos($arrayGastos);
//echo $idProducto;
echo json_encode(Productos::agregarUbicacionProductos($arrayName));