<?php
include dirname(dirname(__FILE__)) . "../../models/costo.php";

if (Costo::validarGasto(strtoupper($_POST['gasto_descripcion']))) {
  echo 1;
} else {
  echo json_encode(Costo::guardarGasto(strtoupper($_POST['gasto_descripcion'])));
}
