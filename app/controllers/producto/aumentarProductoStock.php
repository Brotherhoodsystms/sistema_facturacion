<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/producto.php";

$stockaumentado = $_POST["producto_capacidadstocka"] + $_POST["producto_aumentarstock"];
//todo::ingreso del instorial
$identificacion = 'IB';
$datos = $_SESSION['idUser'];
$cantidad = $_POST["producto_aumentarstock"];
$fecha = date('d-m-Y');
$Idtransaccion = $identificacion . '-' . $cantidad . '-' . $fecha;
$accion = 'INGRESO A BODEGA';
$obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stocka']);
$arrayHistorial = array(
  'accion' => $accion,
  'idtransaccion' => $Idtransaccion,
  'usuario' => $datos
);
$obtenerDatosUbiacacionB['cantidad'] = $cantidad;
$obtenerDatosUbiacacionB['idUsuario'] = $datos;
$historial = Producto::ingresarHistorial($arrayHistorial);
$obtenerDatosUbiacacionB['idtransaccion'] = $historial;
$tempHistorial = Producto::ingresartempUbi($obtenerDatosUbiacacionB);
//todo::actualizarProducto
     //todo::datos de producto general
    $stock_tbl_producto=Producto::obtenerProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id']);

     $nuevostocktbl_producto=$stock_tbl_producto['producto_stock']+$_POST["producto_aumentarstock"];

     $actulizar=Producto::actualizarProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id'],$nuevostocktbl_producto);



echo json_encode(Producto::actualizarProductoStockId($_POST['producto_id_stocka'], $stockaumentado));
