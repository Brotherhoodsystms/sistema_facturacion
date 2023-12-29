<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/producto.php";

if (empty($_POST["nuevoStock_kardex"])){
    $nuevoStock = $_POST["stock_kardex"];
}else{
    $nuevoStock = $_POST["nuevoStock_kardex"];
}
if(empty($_POST['porcentaje_iva'])){
  $impuesto = $_POST['valorimpuesto_kardex'];
}else{
  $impuesto = $_POST['porcentaje_iva'];
}

if(empty($_POST["tipo_ingreso_stock"])){
  $obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stocka']);

  $actualizarProducto=Producto::actualizarProductoDetalle($obtenerDatosUbiacacionB['producto_id'],
      $_POST["codigoproducto_kardex"],$_POST["codigoreferencia_kardex"],($_POST["descripcionproducto_kardex"]),
      $_POST["preciocompra_kardex"],$_POST["precioventa_kardex"],$_POST["categoria_id"],$_POST["tipo_impuesto_id"],
      $impuesto);
  
      echo json_encode($actualizarProducto);
  
}else if( $_POST["tipo_ingreso_stock"] === '1'){
    //aumentar stock
    $stockaumentado = $_POST["stock_kardex"] + $_POST["nuevoStock_kardex"];
//todo::ingreso del instorial
$identificacion = 'IB';
$datos = $_SESSION['idUser'];
$cantidad = $nuevoStock;
$fecha = date('d-m-Y');
$Idtransaccion = $identificacion . '-' . $cantidad . '-' . $fecha;
$accion = 'INGRESO A BODEGA';
$obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stocka']);
$arrayHistorial = array(
  'accion' => $accion,
  'idtransaccion' => $Idtransaccion,
  'usuario' => $datos
);
$historial = Producto::ingresarHistorial($arrayHistorial);
$obtenerDatosUbiacacionB['cantidad'] = $cantidad;
$obtenerDatosUbiacacionB['idUsuario'] = $datos;
$obtenerDatosUbiacacionB['idtransaccion'] = $historial;
$tempHistorial = Producto::ingresartempUbi($obtenerDatosUbiacacionB);
//todo::actualizarProducto
$actualizarProducto=Producto::actualizarProductoDetalle($obtenerDatosUbiacacionB['producto_id'],
$_POST["codigoproducto_kardex"],$_POST["codigoreferencia_kardex"],$_POST["descripcionproducto_kardex"],
$_POST["preciocompra_kardex"],$_POST["precioventa_kardex"],$_POST["categoria_id"],$_POST["tipo_impuesto_id"],
$impuesto);
      
     //todo::datos de producto general
    $stock_tbl_producto=Producto::obtenerProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id']);

     $nuevostocktbl_producto=$stock_tbl_producto['producto_stock']+$_POST["nuevoStock_kardex"];

     $actulizar=Producto::actualizarProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id'],$nuevostocktbl_producto);

echo json_encode(Producto::actualizarProductoStockId($_POST['producto_id_stocka'], $stockaumentado));

}else if($_POST["tipo_ingreso_stock"] === '2'){
    //disminuir stock
    if ($_POST["stock_kardex"] > $_POST["nuevoStock_kardex"]) {
        $stockdisminuyo = $_POST["stock_kardex"] - $_POST["nuevoStock_kardex"];

        $identificacion = 'EB';
$datos = $_SESSION['idUser'];
$cantidad = $nuevoStock;
$fecha = date('d-m-Y');
$Idtransaccion = $identificacion . '-' . $cantidad . '-' . $fecha;
$accion = 'EGRESO DE BODEGA';
$obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stocka']);
$arrayHistorial = array(
  'accion' => $accion,
  'idtransaccion' => $Idtransaccion,
  'usuario' => $datos
);
$historial = Producto::ingresarHistorial($arrayHistorial);
$obtenerDatosUbiacacionB['cantidad'] = $cantidad;
$obtenerDatosUbiacacionB['idUsuario'] = $datos;
$obtenerDatosUbiacacionB['idtransaccion'] = $historial;
$tempHistorial = Producto::ingresartempUbi($obtenerDatosUbiacacionB);
        //todo::actualizarProducto
           //todo::datos de producto general
           $obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stocka']);
      
           $stock_tbl_producto=Producto::obtenerProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id']);
      
           $nuevostocktbl_producto=$stock_tbl_producto['producto_stock']-$_POST["nuevoStock_kardex"];
      
           $actulizar=Producto::actualizarProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id'],$nuevostocktbl_producto);

           $actualizarProducto=Producto::actualizarProductoDetalle($obtenerDatosUbiacacionB['producto_id'],
           $_POST["codigoproducto_kardex"],$_POST["codigoreferencia_kardex"],$_POST["descripcionproducto_kardex"],
           $_POST["preciocompra_kardex"],$_POST["precioventa_kardex"],$_POST["categoria_id"],$_POST["tipo_impuesto_id"],
           $impuesto);

        echo json_encode(Producto::actualizarProductoStockId($_POST["producto_id_stocka"], $stockdisminuyo));
      } else {
        echo 0;
      }
}else if ($_POST["tipo_ingreso_stock"] === '3'){
    //correguir stock
$identificacion = 'AS';
$datos = $_SESSION['idUser'];
$cantidad = $nuevoStock;
$fecha = date('d-m-Y');
$Idtransaccion = $identificacion . '-' . $cantidad . '-' . $fecha;
$accion = 'AJUSTE STOCK';
$obtenerDatosUbiacacionB = Producto::obtenerUbicacion($_POST['producto_id_stocka']);
$arrayHistorial = array(
  'accion' => $accion,
  'idtransaccion' => $Idtransaccion,
  'usuario' => $datos
);
$historial = Producto::ingresarHistorial($arrayHistorial);
$obtenerDatosUbiacacionB['cantidad'] = $cantidad;
$obtenerDatosUbiacacionB['idUsuario'] = $datos;
$obtenerDatosUbiacacionB['idtransaccion'] = $historial;
$tempHistorial = Producto::ingresartempUbi($obtenerDatosUbiacacionB);
//todo::actualizarProducto
     //todo::datos de producto general
     $actulizar=Producto::actualizarProductoStockIdProductos($obtenerDatosUbiacacionB['producto_id'],$nuevoStock);

    $actualizarProducto=Producto::actualizarProductoDetalle($obtenerDatosUbiacacionB['producto_id'],
    $_POST["codigoproducto_kardex"],$_POST["codigoreferencia_kardex"],$_POST["descripcionproducto_kardex"],
    $_POST["preciocompra_kardex"],$_POST["precioventa_kardex"],$_POST["categoria_id"],$_POST["tipo_impuesto_id"],
    $impuesto);
    

echo json_encode(Producto::actualizarProductoStockId($_POST['producto_id_stocka'], $nuevoStock));

}
//echo "valor: "+ $_POST["nuevoStock_kardex"] ;
//echo "valor: "+ $_POST["producto_id_stocka"] ;

