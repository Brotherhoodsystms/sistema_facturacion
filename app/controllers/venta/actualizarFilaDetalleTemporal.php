<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";
$tipoProducto = Venta::obtenerTipoProducto($_POST['producto_id_add_stock']);
if($tipoProducto['producto_tipo'] === 'C'){
  if(empty($_POST['cantidadnueva_stock'])){
    $cantidad=$_POST['cantidadactual_stock'];
  }else{
      $cantidad=$_POST['cantidadnueva_stock'];
  }
  $productosComboValidar = Venta::obtenerProductosCombo($_POST['producto_id_add_stock']);
  foreach($productosComboValidar as $productoValidar){
    $descripcion_bodega_venta_validar = Venta::obtenerDescripcionStockDirecta($productoValidar["producto_id"],$_POST['bodegaid_add_stock']);
      if($descripcion_bodega_venta_validar['ubicacion_cantidad'] - ($productoValidar["cantidad"] * $cantidad) < 0 ){
          $actualizarValidar = false;
          break;
        }else{
          $actualizarValidar = true;
        }
  }
if($actualizarValidar === true){
  $productosCombo = Venta::obtenerProductosCombo($_POST['producto_id_add_stock']);
  foreach($productosCombo as $producto){
    $descripcion_bodega_venta = Venta::obtenerDescripcionStockDirecta($producto["producto_id"],$_POST['bodegaid_add_stock']);
    $datosbusquedaStock = array(
      'producto_id' => $producto['producto_id'],
      'bodega_id' => $_POST['bodegaid_add_stock'],
      'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion']
    );
    //todo::datos de producto general
    $stock_tbl_producto=Venta::obtenerProductoStockId($producto['producto_id']);
    
    if(($cantidad * $producto["cantidad"]) > $stock_tbl_producto['producto_stock']){
     echo 2;
    }else{
        $nuevostocktbl_producto = ($stock_tbl_producto['producto_stock'] + ( $_POST['cantidadactual_stock'] * $producto["cantidad"] ))  - ($cantidad * $producto["cantidad"]);
    }
      $producto_stock = Venta::obtenerProductoStockIdU($datosbusquedaStock);
      if($producto_stock['ubicacion_cantidad']+1 >= ( $_POST['cantidadnueva_stock'] * $producto["cantidad"] ) || ($producto_stock['ubicacion_cantidad'] + ( $_POST['cantidadactual_stock'] * $producto["cantidad"])) >= ($_POST['cantidadnueva_stock'] * $producto["cantidad"]) ){
      $producto_stocknuevo = ( $producto_stock['ubicacion_cantidad'] + ($_POST['cantidadactual_stock'] * $producto["cantidad"]) )- ($cantidad * $producto["cantidad"]);
      $datos = array(
        'producto_id' => $producto['producto_id'],
        'nuevo_stock' => $producto_stocknuevo,
        'bodega_id' => $_POST['bodegaid_add_stock'],
        'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion']
      );
      if (Venta::actualizarProductoStockId($datos)) {
        $actulizar=Venta::actualizarProductoStockIdProductos($producto['producto_id'],$nuevostocktbl_producto);
      }
      }else{
        echo 2;
      }
  }

  $impuestoProducto = Venta::buscarImpuestoProducto($_POST['producto_id_add_stock']);
  $impuestoPorcentaje = $impuestoProducto['producto_porcentaje'];

  if ($impuestoPorcentaje === 1){
    $precioProducto = $_POST['precio_producto'];
    $totalVenta= $_POST['precio_producto']*$cantidad;
    if(empty($_POST['descuento_producto'])){
      $descuento=0;
      $totalVenta= $_POST['precio_producto']*$cantidad;
    }else{
      $descuento= ($totalVenta*$_POST['descuento_producto'])/100;
      $subtotal = $_POST['precio_producto']*$cantidad;
      $totalVenta= $subtotal-$descuento;
    }
  }else if ($impuestoPorcentaje === 2){
    $precioProducto = round(($_POST['precio_producto']/1.12),4);
    $totalVenta= $precioProducto*$cantidad;
    if(empty($_POST['descuento_producto'])){
      $descuento=0;
      $totalVenta= $precioProducto*$cantidad;
    }else{
      $descuento= ($totalVenta*$_POST['descuento_producto'])/100;
      $subtotal = $precioProducto*$cantidad;
      $totalVenta= $subtotal-$descuento;
    }
  }

  if (Venta::actualizarDetalletempId($_POST['temp_id'],$cantidad,$totalVenta,$precioProducto,$descuento)) {
      echo 1;
  }
}else{
  echo 2;
}
}else{
  $array = explode("/", $_POST['ubicacion_descripcion_add_stock']);
$datosbusquedaStock = array(
  'producto_id' => $_POST['producto_id_add_stock'],
  'bodega_id' => $array[0],
  'ubicacion_descripcion' => $array[1]
);
//todo::datos de producto general
$stock_tbl_producto=Venta::obtenerProductoStockId($_POST['producto_id_add_stock']);

if(($_POST['cantidadnueva_stock']) > $stock_tbl_producto['producto_stock'] + $_POST['cantidadactual_stock']){
 echo 2;
}else{
    $nuevostocktbl_producto = ($stock_tbl_producto['producto_stock'] + $_POST['cantidadactual_stock'] )  - $_POST['cantidadnueva_stock'];

if(empty($_POST['cantidadnueva_stock'])){
  $cantidad=$_POST['cantidadactual_stock'];
}else{
    $cantidad=$_POST['cantidadnueva_stock'];
}
  $producto_stock = Venta::obtenerProductoStockIdU($datosbusquedaStock);
  $producto_id = $_POST['producto_id'];
  
  if($producto_stock['ubicacion_cantidad']+1 >= $_POST['cantidadnueva_stock'] || ($producto_stock['ubicacion_cantidad'] + $_POST['cantidadactual_stock']) >= $_POST['cantidadnueva_stock'] ){
  $producto_stocknuevo = ( $producto_stock['ubicacion_cantidad'] + $_POST['cantidadactual_stock'] )- $_POST['cantidadnueva_stock'];
  $datos = array(
    'producto_id' => $_POST['producto_id_add_stock'],
    'nuevo_stock' => $producto_stocknuevo,
    'bodega_id' => $array[0],
    'ubicacion_descripcion' => $array[1]
  );

  $impuestoProducto = Venta::buscarImpuestoProducto($_POST['producto_id_add_stock']);
  $impuestoPorcentaje = $impuestoProducto['producto_porcentaje'];

  if ($impuestoPorcentaje === '1'){
    $precioProducto = $_POST['precio_producto'];
    $totalVenta= $_POST['precio_producto']*$cantidad;
    if(empty($_POST['descuento_producto'])){
      $descuento=0;
      $totalVenta= $_POST['precio_producto']*$cantidad;
    }else{
      $descuento= ($totalVenta*$_POST['descuento_producto'])/100;
      $subtotal = $_POST['precio_producto']*$cantidad;
      $totalVenta= $subtotal-$descuento;
    }
  }else if ($impuestoPorcentaje === '2'){
    $precioProducto = ($_POST['precio_producto']/1.12);
    $totalVenta= $precioProducto*$cantidad;
    if(empty($_POST['descuento_producto'])){
      $descuento=0;
      $totalVenta= $precioProducto*$cantidad;
    }else{
      $descuento= ($totalVenta*$_POST['descuento_producto'])/100;
      $subtotal = $precioProducto*$cantidad;
      $totalVenta= $subtotal-$descuento;
    }
  }
  
  if (Venta::actualizarProductoStockId($datos)) {
    $actulizar=Venta::actualizarProductoStockIdProductos($_POST['producto_id_add_stock'],$nuevostocktbl_producto);
    if (Venta::actualizarDetalletempId($_POST['temp_id'],$cantidad,$totalVenta,$precioProducto,$descuento)) {
        echo 1;
      }
  }

  }else{
    echo 2;
  }
}  
}
