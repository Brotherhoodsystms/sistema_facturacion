<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/combos.php";
$arrayProducto = array(
  'codigoserial_producto_combo' => $_POST["codigo_combo"],
  'descripcion_producto_combo' => $_POST["nombre_producto_combo"],
  'combos_compra' => 0,
  'combos_total' => $_POST["combos_total"],
  'combos_stock' => 1,
  'combos_proveedorid' => 1,
  'combos_categoriaid' => $_POST["categoria_id"],
  'combos_productotipo' => "C",
  'tipo_impuesto_id' => $_POST["tipo_impuesto_id"],
  'porcentaje_iva' => $_POST["porcentaje_iva"],
  'producto_ca' => 0
);

if (Combos::validarCodigoseriaCombo($_POST['codigo_combo'])) {
    echo 1;
  } else{
    $id_producto = Combos::guardarProducto($arrayProducto);
    $detalle_producto = array(
      'id_producto' => $id_producto,
      'id_usuario' => $_SESSION['idUser']
    );
    $InProducto = (Combos::guardarDetalleFactura($detalle_producto));
    echo json_encode($InProducto);
  }

