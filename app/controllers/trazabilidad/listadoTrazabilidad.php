<?php
include dirname(dirname(__FILE__)) . "../../models/trazabilidad.php";
$data = Trazabilidad::obtenerTrazabilidades();
$i = 0;
/*foreach ($data as $bodegaDestino) {

  $destino = Trazabilidad::obtenerBodegaDestino($bodegaDestino['tipobodega_id']);
  $bodegaDestino['bodegaDestino'] = $destino['bodega_descripcion'];
  $bodega[$i]['destino'] = 100;
  $i++;
}*/
/*for ($i = 0; $i < count($data); $i++) {
  if ($destino = Trazabilidad::obtenerBodegaDestino($data[$i]['temp_bodegaid_origen'])) {
    $data[$i]['origen'] = $destino['bodega_descripcion'];
  } else {
    $data[$i]['origen'] = 'No existe';
  }
  if ($destino = Trazabilidad::obtenerBodegaDestino($data[$i]['tem_ubica_bodegaid'])) {
    $data[$i]['destino'] = $destino['bodega_descripcion'];
  } else {
    $data[$i]['destino'] = 'No existe';
  }
}*/


foreach($data as $datos){
  if ($destino = Trazabilidad::obtenerBodegaDestino($datos['temp_bodegaid_origen'])) {
    $datos['origen'] = $destino['bodega_descripcion'];
  } else {
    $datos['origen'] = 'No existe';
  }
  if ($destino = Trazabilidad::obtenerBodegaDestino($datos['tem_ubica_bodegaid'])) {
    $datos['destino'] = $destino['bodega_descripcion'];
  } else {
    $datos['destino'] = 'No existe';
  }
}
echo json_encode($data);
