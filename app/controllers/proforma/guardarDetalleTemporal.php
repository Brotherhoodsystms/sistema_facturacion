<?php

session_start();
include dirname(dirname(__FILE__)) . '../../models/venta.php';
$id_producto = Venta::obtenerProductoBycodigo(
    strtoupper($_POST['producto_codigoserial'])
);
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
    'temp_descuento' => $_POST['producto_descuento'],
    'temp_cantvender' => $_POST['producto_comprar'],
    'temp_total' =>
        $_POST['producto_comprar'] * $precio - $total_descuento,
    'temp_idproducto' => $id_producto['producto_id'],
    'temp_lote' => $_POST['producto_lote'],
    'temp_idusuario' => $_SESSION['idUser'],
    'bodega_id' => $array[0],
    'ubicacion_descripcion' => $_POST['ubicacion_descripcion_o'],
];

//var_dump($arrayName);
if(Venta::guardarDetalleTemp($arrayName)){
    echo json_encode(1);
}