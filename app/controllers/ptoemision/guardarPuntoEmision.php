<?php
include dirname(dirname(__FILE__)) . "../../models/ptoemision.php";
$arrayName = array(
  'ambiente_ptoemision' => $_POST["ambiente_ptoemision"],
  'nombre_ptoemision' => $_POST["nombre_ptoemision"],
  'codigo_ptemision' => $_POST["codigo_ptemision"],
  'secuenciaF_ptoemision' => $_POST["secuenciaF_ptoemision"],
  'secuecianotav_ptoemision' => $_POST["secuecianotav_ptoemision"],
  'estado_ptroemision' => $_POST["estado_ptroemision"],
  'secuencia_reserva' => $_POST["secuencia_reserva"],
  'bodega_ptoemision' => $_POST["bodega_puntoemision"],
  'secuencial_proforma'=> $_POST["secuencial_proforma"]
);
//var_dump($_POST);
if (Ptoemision::validarNombrePtoEmision(strtoupper($_POST["nombre_ptoemision"]))) {
  echo 1;
} else {
  echo json_encode(Ptoemision::guardarPtoEmision($arrayName));
}
