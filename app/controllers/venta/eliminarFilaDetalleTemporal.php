<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$tipoProducto = Venta::obtenerTipoProducto($_POST['producto_id']);
if($tipoProducto['producto_tipo'] === 'C'){
  $productosCombo = Venta::obtenerProductosCombo($_POST['producto_id']);
  foreach($productosCombo as $producto){
    $descripcion_bodega_venta = Venta::obtenerDescripcionStockDirecta($producto["producto_id"],$_POST['bodega_id_o']);
    $datosbusquedaStock = array(
      'producto_id' => $producto['producto_id'],
      'bodega_id' => $_POST['bodega_id_o'],
      'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion']
    );
    //todo::datos de producto general
    $stock_tbl_producto=Venta::obtenerProductoStockId($producto['producto_id']);
    
    $nuevostocktbl_producto=$stock_tbl_producto['producto_stock'] + ($_POST['temp_cantvender'] * $producto["cantidad"]);
  
      $producto_stock = Venta::obtenerProductoStockIdU($datosbusquedaStock);
      
      $producto_stocknuevo = ($_POST['temp_cantvender'] * $producto["cantidad"]) + $producto_stock['ubicacion_cantidad'];
      
      $datos = array(
        'producto_id' => $producto['producto_id'],
        'nuevo_stock' => $producto_stocknuevo,
        'bodega_id' => $_POST['bodega_id_o'],
        'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion']
    
      );
      if (Venta::actualizarProductoStockId($datos)) {
        $actulizar=Venta::actualizarProductoStockIdProductos($producto['producto_id'],$nuevostocktbl_producto);
        $datas = Venta::eliminarDetalletempId($_POST['temp_id']); 
      }
  }
  if($datas === true){
    echo 1;
 }else{
    echo 2;
 }
}else{
$array = explode("/", $_POST['ubicacion_descripcion']);
$datosbusquedaStock = array(
  'producto_id' => $_POST['producto_id'],
  'bodega_id' => $array[0],
  'ubicacion_descripcion' => $array[1]
);
//todo::datos de producto general
$stock_tbl_producto=Venta::obtenerProductoStockId($_POST['producto_id']);

$nuevostocktbl_producto=$stock_tbl_producto['producto_stock']+$_POST['temp_cantvender'];

if ($_POST['bodega_id_o'] == 'null' && $_POST['ubicacion_descripcion'] == 'null') {
  if (Venta::eliminarDetalletempId($_POST['temp_id'])) {
    echo 1;
  }
} else {
  $producto_stock = Venta::obtenerProductoStockIdU($datosbusquedaStock);
  $producto_id = $_POST['producto_id'];
  $producto_stocknuevo = $_POST['temp_cantvender'] + $producto_stock['ubicacion_cantidad'];
  
  $datos = array(
    'producto_id' => $_POST['producto_id'],
    'nuevo_stock' => $producto_stocknuevo,
    'bodega_id' => $array[0],
    'ubicacion_descripcion' => $array[1]

  );
  if (Venta::actualizarProductoStockId($datos)) {
    $actulizar=Venta::actualizarProductoStockIdProductos($_POST['producto_id'],$nuevostocktbl_producto);
    if (Venta::eliminarDetalletempId($_POST['temp_id'])) {
      echo 1;
    }
  }
}
}


