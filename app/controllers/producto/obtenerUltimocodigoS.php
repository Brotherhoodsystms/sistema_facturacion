<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
//$data = Producto::obtenerUltimoCodigo();
//$codigo_serie=$_POST["serie"];
//$nuevo_codigo=recursiva($codigo_serie);
$obtenerCodigo=Producto::obtenerCodigoSerialValUltimoTemp();
     $secuencial=$obtenerCodigo["ultimo"]+1;
echo $secuencial;   

function recursiva($serial){
    $obtenerCodigo=Producto::obtenerCodigoSerialValUltimoTemp();
     $secuencial=$obtenerCodigo["ultimo"]+1;
    return $secuencial;
     /*
    if($obtenerCodigo){
        recursiva($secuencial);
        var_dump($secuencial); 
    }else{
       return $secuencial;
    }
    */
}

