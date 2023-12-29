<?php
include dirname(dirname(__FILE__)) . "../../models/lote.php";

if (Lote::validarLote(strtoupper($_POST['lote_descripcion']))) {
  echo 1;
} else {
  echo json_encode(Lote::guardarLote(strtoupper($_POST['lote_descripcion'])));
}
