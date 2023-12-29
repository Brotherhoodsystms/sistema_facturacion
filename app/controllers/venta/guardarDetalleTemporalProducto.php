<?php
session_start();
include dirname(dirname(__FILE__)) . '../../models/venta.php';
if (!empty($_POST['producto_id'])) {
    if ($_POST['ubicacion_cantidad'] > 0) {
            $precio = $_POST['producto_precio_mayor'];
            $total_descuento = 0.00;
        $descripcion_producto_venta = Venta::obtenerProductoStockId(
            $_POST['producto_id']
        );
        $descripcion_bodega_venta = Venta::obtenerDescripcionStock(
            $_POST['producto_id'],$_POST['bodega_id'],$_POST['ubicacion_id']
        );
        
       
        $arrayName = [
            'temp_serialproducto' => strtoupper(
                $_POST['producto_codigoserial']
            ),
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
                'nuevo_stock' => $_POST['ubicacion_cantidad']-$_POST['precio_xcantidad'],
                'bodega_id' =>$_POST['bodega_id'],
                'ubicacion_descripcion' => $descripcion_bodega_venta['ubicacion_descripcion'],
            ];
            //todo::datos de producto general
            $stock_tbl_producto = Venta::obtenerProductoStockId(
                $_POST['producto_id']
            );
            $nuevostocktbl_producto =
                $stock_tbl_producto['producto_stock'] -
                $_POST['precio_xcantidad'];
            if (Venta::actualizarProductoStockId($datos)) {
                $actulizar = Venta::actualizarProductoStockIdProductos(
                    $_POST['producto_id'],
                    $nuevostocktbl_producto
                );
                echo 1;
            }
        }
    } else if ($_POST['ubicacion_cantidad'] == 0.00) {
        echo 2;
    }
}else {
    echo 3;
}