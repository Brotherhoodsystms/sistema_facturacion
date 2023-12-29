<?php
session_start();
include dirname(dirname(__FILE__)) . '../../models/venta.php';
if (!empty($_POST['producto_id'])) {
    if ($_POST['producto_stock'] > 0) {
            $precio = $_POST['producto_precio_mayor'];
            $total_descuento = 0.00;
            $tipoProducto = Venta::obtenerTipoProducto($_POST['producto_id']);
            if($tipoProducto['producto_tipo'] === 'C'){
                $descripcion_producto_venta = Venta::obtenerProductoStockId($_POST['producto_id']);
                $arrayName = [
                'temp_serialproducto' => strtoupper($_POST['producto_codigoserial']),
                'temp_descripcion' => $descripcion_producto_venta['producto_descripcion'],
                'temp_precio' => $precio,
                'temp_descuento' => $total_descuento,
                'temp_cantvender' => $_POST['precio_xcantidad'],
                'temp_total' => $_POST['producto_precio_mayor'],
                'temp_idproducto' => $_POST['producto_id'],
                'temp_idusuario' => $_SESSION['idUser'],
                'bodega_id' => $_POST['bodega_id'],
                'ubicacion_descripcion' => $_POST['bodega_id'],
                'temp_tipo_producto' => $descripcion_producto_venta['producto_tipo']
                 ];
                 $productosComboValidar = Venta::obtenerProductosCombo($_POST['producto_id']);
                 foreach($productosComboValidar as $productoValidar){
                    $descripcion_bodega_venta_validar = Venta::obtenerDescripcionStockDirecta($productoValidar["producto_id"],$_POST['bodega_id']);
                    if($descripcion_bodega_venta_validar['ubicacion_cantidad'] - $productoValidar["cantidad"] < 0 ){
                        $actualizarValidar = false;
                        break;
                    }else{
                        $actualizarValidar = true;
                     }
                    }
             if ($actualizarValidar === true){
                if (Venta::guardarDetalleTemp($arrayName)) {
                    $productosCombo = Venta::obtenerProductosCombo($_POST['producto_id']);
                     foreach($productosCombo as $producto){
                    $descripcion_bodega_venta = Venta::obtenerDescripcionStockDirecta($producto["producto_id"],$_POST['bodega_id']);
                    $datos = [
                        'producto_id' => $producto["producto_id"],
                        'nuevo_stock' => $descripcion_bodega_venta['ubicacion_cantidad']-$producto["cantidad"],
                        'bodega_id' =>$_POST['bodega_id'],
                        'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion'],
                    ];
                    $stock_tbl_producto = Venta::obtenerProductoStockId($producto["producto_id"]);
                    $nuevostocktbl_producto = $stock_tbl_producto['producto_stock'] - $producto["cantidad"];
                        if (Venta::actualizarProductoStockId($datos)){
                            $actualizar = Venta::actualizarProductoStockIdProductos($producto["producto_id"] , $nuevostocktbl_producto);
                          }
                    }
                     if($actualizar === true){
                        echo 1;
                     }else{
                        echo 2;
                     }
                  }
             }else{
                echo 2;
             }
            }else{
                $descripcion_producto_venta = Venta::obtenerProductoStockId($_POST['producto_id']);
                $descripcion_bodega_venta = Venta::obtenerDescripcionStockDirecta($_POST['producto_id'],$_POST['bodega_id']);
                $arrayName = [
                'temp_serialproducto' => strtoupper($_POST['producto_codigoserial']),
                'temp_descripcion' => $descripcion_producto_venta['producto_descripcion'],
                'temp_precio' => $precio,
                'temp_descuento' => $total_descuento,
                'temp_cantvender' => $_POST['precio_xcantidad'],
                'temp_total' => $_POST['producto_precio_mayor'],
                'temp_idproducto' => $_POST['producto_id'],
                'temp_idusuario' => $_SESSION['idUser'],
                'bodega_id' => $_POST['bodega_id'],
                'ubicacion_descripcion' => $_POST['bodega_id']."/".$descripcion_bodega_venta['ubicacion_descripcion'],
                'temp_tipo_producto' => $descripcion_producto_venta['producto_tipo']
                 ];
              if (Venta::guardarDetalleTemp($arrayName)) {
                $datos = [
                    'producto_id' => $_POST['producto_id'],
                    'nuevo_stock' => $descripcion_bodega_venta['ubicacion_cantidad']-$_POST['precio_xcantidad'],
                    'bodega_id' =>$_POST['bodega_id'],
                    'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion'],
                ];
                //todo::datos de producto general
                $stock_tbl_producto = Venta::obtenerProductoStockId($_POST['producto_id']);
                $nuevostocktbl_producto = $stock_tbl_producto['producto_stock'] - $_POST['precio_xcantidad'];
                if (Venta::actualizarProductoStockId($datos)) {
                    $actulizar = Venta::actualizarProductoStockIdProductos($_POST['producto_id'],$nuevostocktbl_producto);
                    echo 1;
                }
              }
            }
      } else if ($_POST['producto_stock'] == 0.00) {
        echo 2;
      }
  }else {
    echo 3;
  }