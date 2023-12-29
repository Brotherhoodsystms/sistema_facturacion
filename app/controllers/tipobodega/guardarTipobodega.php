<?php
include dirname(dirname(__FILE__)) . "../../models/tipobodega.php";
$arrayName = array(
  'tipobodega_especificacion' => strtoupper($_POST["tipobodega_especificacion"]),
  'tipobodega_capacidad' => strtolower($_POST["tipobodega_capacidad"])
);
if (Tipobodega::validarEspecificacionTipoBodega($arrayName)) {
  echo 0;
} else {
  echo json_encode(Tipobodega::guardarTipoBodega($arrayName));
}
