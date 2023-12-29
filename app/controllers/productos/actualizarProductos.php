<?php
include dirname(dirname(__FILE__)) . "../../models/productos.php";

$nombre_imagen = $_FILES['foto']['name'];
$temporal = $_FILES['foto']['tmp_name'];
$carpeta = "../../img";
$ruta = $carpeta.'/'.$nombre_imagen;
move_uploaded_file($temporal,$carpeta.'/'.$nombre_imagen);

if(empty($nombre_imagen)){
    $imagen = $_POST['producto_imagenes'];
}else{
    $imagen = $ruta;
}

if(empty($_POST['porcentaje_iva'])){
   $porcentajeimpuestoproductos = $_POST['porcentaje_iva_producto'];
}else{
    $porcentajeimpuestoproductos = $_POST['porcentaje_iva'];
}

//todo:: actualizacion de los datos producto general y de la ubicion
$arrayName = array(
    'codigo_producto'=>$_POST['producto_codigoserial'],
'producto_id'=> $_POST['producto_id'],
'producto_descripcion'=> strtoupper($_POST['producto_descripcion']),
'producto_precio_compra'=> $_POST['producto_precio_compra'],
'producto_precio_venta'=> $_POST['producto_precio_venta'],
'producto_fechaelaboracion'=> $_POST['producto_fechaelaboracion'],
'producto_fechaexpiracion'=> $_POST['producto_fechaexpiracion'],
'tipo_impuesto_id'=> $_POST['tipo_impuesto_id'],
'porcentaje_iva'=> $porcentajeimpuestoproductos,
'producto_imagen'=> $imagen
);

/*     $CantidProdcutoV=Productos::validarCodigoserialProducto($_POST['codigo_producto'],$_POST['producto_id']);
    if($CantidProdcutoV['producto_codigoserial']==$_POST['codigo_producto']){
        echo json_encode('1');
    }else{ */
    $CantUbi=Productos::obtenerUbicacionIdParaProduCantidad($_POST['ubicacion_id']);
    $CantidProdcuto=Productos::obtenerProductoId($_POST['producto_id']);

    if(isset($_POST['ubicacion_id'])){
        if($CantUbi['ubicacion_cantidad']<$_POST['producto_stock']){
            $cantidadS=$_POST['producto_stock']-$CantUbi['ubicacion_cantidad'];
            $arrayUbicacionCantidad=array(
                'ubicacion_id'=>$_POST['ubicacion_id'],
            'cantidad'=>$_POST['producto_stock']
            );
            $cantidadProductoNueva=$CantidProdcuto['producto_stock']+$cantidadS;
            $productoCan=Productos::actualizarCantidadProducto($_POST['producto_id'],$cantidadProductoNueva);

        }else if($CantUbi['ubicacion_cantidad']>$_POST['producto_stock']){
            $cantidadS=$CantUbi['ubicacion_cantidad']-$_POST['producto_stock'];
            $arrayUbicacionCantidad=array(
                'ubicacion_id'=>$_POST['ubicacion_id'],
            'cantidad'=>$_POST['producto_stock']
            );
            $cantidadProductoNueva=$CantidProdcuto['producto_stock']-$cantidadS;
            $productoCan=Productos::actualizarCantidadProducto($_POST['producto_id'],$cantidadProductoNueva);
        }else{
            $cantidadProductoNueva=$CantidProdcuto['producto_stock'];
            $arrayUbicacionCantidad=array(
                'ubicacion_id'=>$_POST['ubicacion_id'],
            'cantidad'=>$_POST['producto_stock']
            );
        }
        $cantida=Productos::actualizarCantidadUbicacion($arrayUbicacionCantidad);
    }else{
    }
echo json_encode(Productos::actualizarProductos($arrayName));
/* } */

