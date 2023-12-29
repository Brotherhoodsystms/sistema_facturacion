<?php

session_start();
include dirname(dirname(__FILE__)) . '../../models/venta.php';

// echo json_encode($arrayName);
if (empty($_POST['producto_id'])) {
    if ($_POST['precio_xcantidad'] === '1') {
        $precio = $_POST['producto_precioxMe'];
    } else {
        $precio = $_POST['producto_precioxMa'];
    }
    $descuento = $_POST['producto_descuento'] / 100;
    $total_descuento = $_POST['producto_comprar'] * $precio * $descuento;
    $arrayName3 = [
        'temp_serialproducto' => strtoupper($_POST['producto_codigoserial']),
        'temp_descripcion' => $_POST['producto_descripcion'],
        'temp_precioxMe' => $_POST['producto_precioxMe'],
        'temp_precioxMa' => $_POST['producto_precioxMa'],
        'temp_descuento' => $total_descuento,
        'temp_cantvender' => $_POST['producto_comprar'],
        'temp_total' => $_POST['producto_comprar'] * $precio - $total_descuento,
        'temp_idproducto' => $_POST['producto_id'],
        'temp_lote' => $_POST['producto_lote'],
    ];
    $arrayName = [
        'temp_serialproducto' => strtoupper($_POST['producto_codigoserial']),
        'temp_descripcion' => $_POST['producto_descripcion'],
        'temp_precio' => $precio,
        'temp_descuento' => $total_descuento,
        'temp_cantvender' => $_POST['producto_comprar'],
        'temp_total' => $_POST['producto_comprar'] * $precio - $total_descuento,
        'temp_idproducto' => $_POST['producto_id'],
        'temp_lote' => $_POST['producto_lote'],
    ];
    $id_producto4 = Venta::guardarProductos($arrayName3);
    $id_producto = Venta::obtenerProductoBycodigo(
        strtoupper($_POST['producto_codigoserial'])
    );
    /* if (
        empty(
            Venta::validarProducto(strtoupper($_POST['producto_codigoserial']))
        )
    ) {
        echo 'realizado';
    } */
    if ($_POST['producto_comprar'] <= $_POST['producto_stock']) {
        if ($_POST['precio_xcantidad'] === '1') {
            $precio = $_POST['producto_precioxMe'];
        } else {
            $precio = $_POST['producto_precioxMa'];
        }
        $array = explode('/', $_POST['ubicacion_descripcion_o']);
        $arrayName = [
            'temp_serialproducto' => strtoupper(
                $_POST['producto_codigoserial']
            ),
            'temp_descripcion' => $_POST['producto_descripcion'],
            'temp_precio' => $precio,
            'temp_descuento' => $total_descuento,
            'temp_cantvender' => $_POST['producto_comprar'],
            'temp_total' =>
                $_POST['producto_comprar'] * $precio - $total_descuento,
            'temp_idproducto' => $id_producto['producto_id'],
            'temp_lote' => $_POST['producto_lote'],
            'temp_idusuario' => $_SESSION['idUser'],
            'bodega_id' => $array[0],
            'ubicacion_descripcion' => $_POST['ubicacion_descripcion_o'],
        ];
        if (Venta::guardarDetalleTemp($arrayName)) {
            $array = explode('/', $_POST['ubicacion_descripcion_o']);
            $datos = [
                'producto_id' => $id_producto['producto_id'],
                'nuevo_stock' =>
                    $_POST['producto_stock'] - $_POST['producto_comprar'],
                'bodega_id' => $array[0],
                'ubicacion_descripcion' => $array[1],
            ];
            //todo::datos de producto general
            $stock_tbl_producto = Venta::obtenerProductoStockId(
                $_POST['producto_id']
            );

            $nuevostocktbl_producto =
                $stock_tbl_producto['producto_stock'] -
                $_POST['producto_comprar'];
            if (Venta::actualizarProductoStockId($datos)) {
                $actulizar = Venta::actualizarProductoStockIdProductos(
                    $_POST['producto_id'],
                    $nuevostocktbl_producto
                );

                var_dump($id_producto4);
            }
        }
    } else {
        echo 2;
    }
} else {
    /*if (empty(Venta::validarProducto(strtoupper($_POST["producto_codigoserial"])))) {
    echo "realizado";
  }*/
    if ($_POST['precio_xcantidad'] === '1') {
        $precio = $_POST['producto_precioxMe'];
    } else {
        $precio = $_POST['producto_precioxMa'];
    }
    $descuento = $_POST['producto_descuento'] / 100;
    $total_descuento = $_POST['producto_comprar'] * $precio * $descuento;

    $id_producto = Venta::obtenerProductoBycodigo(
        strtoupper($_POST['producto_codigoserial'])
    );
    $array = explode('/', $_POST['ubicacion_descripcion_o']);
    $arrayName = [
        'temp_serialproducto' => strtoupper($_POST['producto_codigoserial']),
        'temp_descripcion' => $_POST['producto_descripcion'],
        'temp_precio' => $precio,
        'temp_descuento' => $total_descuento,
        'temp_cantvender' => $_POST['producto_comprar'],
        'temp_total' => $_POST['producto_comprar'] * $precio - $total_descuento,
        'temp_idproducto' => $id_producto['producto_id'],
        'temp_lote' => $_POST['producto_lote'],
        'temp_idusuario' => $_SESSION['idUser'],
        'bodega_id' => $array[0],
        'ubicacion_descripcion' => $_POST['ubicacion_descripcion_o'],
    ];
    if ($_POST['producto_comprar'] <= $_POST['producto_stock']) {
        if (Venta::guardarDetalleTemp($arrayName)) {
            $array = explode('/', $_POST['ubicacion_descripcion_o']);
            $datos = [
                'producto_id' => $id_producto['producto_id'],
                'nuevo_stock' =>
                    $_POST['producto_stock'] - $_POST['producto_comprar'],
                'bodega_id' => $array[0],
                'ubicacion_descripcion' => $array[1],
            ];
            
            $stock_tbl_producto = Venta::obtenerProductoStockId(
                $_POST['producto_id']
            );

            $nuevostocktbl_producto =
                $stock_tbl_producto['producto_stock'] -
                $_POST['producto_comprar'];
            if (Venta::actualizarProductoStockId($datos)) {
                $actulizar = Venta::actualizarProductoStockIdProductos(
                    $_POST['producto_id'],
                    $nuevostocktbl_producto
                );

                echo 1;
            }
        }
    } else {
        echo 2;
    }
}
