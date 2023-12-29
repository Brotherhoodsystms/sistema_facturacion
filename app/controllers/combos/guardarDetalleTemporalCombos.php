<?php
session_start();
include dirname(dirname(__FILE__)) . '../../models/combos.php';
if (!empty($_POST['producto_id'])) {
        $descripcion_bodega_venta = Combos::obtenerDescripcionStockDirecta(
            $_POST['producto_id'],$_POST['bodega_id']
        );
        $arrayName = [
            'temp_combos_productoid' => $_POST['producto_id'],
            'temp_combos_cantidad' => $_POST['precio_xcantidad'],
            'temp_combos_precio' =>  $_POST['producto_precio_mayor'],
            'temp_combos_total' =>  $_POST['producto_precio_mayor'],
            'temp_combos_usuarioid' => $_SESSION['idUser'],
            'temp_combos_bodega_id' => $_POST['bodega_id'],
            'temp_combos_descripcion_u' => $_POST['bodega_id']."/".$descripcion_bodega_venta['ubicacion_descripcion'],
        ];
        if (Combos::validarTemporalCombos($_POST["producto_id"], $_SESSION['idUser'])['COUNT(*)'] >= 1){
            echo 2;
        }else{
            $data = Combos::guardarDetalleTemp($arrayName);
            echo json_encode($data);
        }
       
}