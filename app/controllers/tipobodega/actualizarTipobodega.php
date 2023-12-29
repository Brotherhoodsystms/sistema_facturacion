<?php
include dirname(dirname(__FILE__)) . "../../models/tipobodega.php";
$arrayName = array(
  'tipobodega_especificacion' => strtoupper($_POST["tipobodega_especificacion"]),
  'tipobodega_capacidad' => strtolower($_POST["tipobodega_capacidad"]),
  'tipobodega_id' => $_POST["tipobodega_id"]
);
if (Tipobodega::validarEspecificacionActualizarTipoBodega($arrayName)['COUNT(*)'] >= 2) {
  echo 0;
} else {
  echo json_encode(Tipobodega::actualizarTipoBodega($arrayName));
}
