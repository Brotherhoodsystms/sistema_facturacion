<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$producto_stock = Venta::obtenerProductoStockId($_POST['producto_id']);
$producto_id = $_POST['producto_id'];
$producto_stocknuevo = $_POST['temp_cantvender'] + $producto_stock['producto_stock'];

if (Venta::actualizarProductoStockId($producto_id, $producto_stocknuevo)) {
  if (Venta::eliminarDetalleFacturaId($_POST['temp_id'],$producto_id)) {
    echo 1;
  }
}
