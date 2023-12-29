<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
if ($_POST["producto_capacidadstockd"] < $_POST["producto_disminuirstock"]) {
  echo 0;
} else {
  $stockdisminuyo = $_POST["producto_capacidadstockd"] - $_POST["producto_disminuirstock"];
  //todo::actualizarProducto
     //todo::datos de producto general
     $obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stockd']);

     $stock_tbl_producto=Producto::obtenerProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id']);

     $nuevostocktbl_producto=$stock_tbl_producto['producto_stock']-$_POST["producto_disminuirstock"];

     $actulizar=Producto::actualizarProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id'],$nuevostocktbl_producto);


  echo json_encode(Producto::actualizarProductoStockId($_POST["producto_id_stockd"], $stockdisminuyo));
}
