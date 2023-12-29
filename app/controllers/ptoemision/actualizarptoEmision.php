<?php
include dirname(dirname(__FILE__)) . "../../models/ptoemision.php";
$arrayName = array(
  'pto_emision_id' => $_POST["pto_emision_id"],
  'ambiente_ptoemision' => $_POST["ambiente_ptoemision"],
  'nombre_ptoemision' => $_POST["nombre_ptoemision"],
  'codigo_ptemision' => $_POST["codigo_ptemision"],
  'secuenciaF_ptoemision' => $_POST["secuenciaF_ptoemision"],
  'secuecianotav_ptoemision' => $_POST["secuecianotav_ptoemision"],
  'secuencia_reserva' => $_POST["secuencia_reserva"],
  'estado_ptroemision' => $_POST["estado_ptroemision"],
  'secuencial_proforma'=> $_POST["secuencial_proforma"]
);
if (Ptoemision::actualizarPtoEmision($arrayName)) {
  echo true;
} else {
  echo  2;
}
