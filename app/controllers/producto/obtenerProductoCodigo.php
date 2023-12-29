<?php
include dirname(dirname(__FILE__)) . "../../models/producto.php";
$data = Producto::obtenerCodigoProductoUbicacion($_POST['id']);
if ($data) {
  echo 1;
} else {
  echo 0;
}
