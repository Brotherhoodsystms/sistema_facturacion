<?php
include dirname(dirname(__FILE__)) . "../../models/cajachica.php";

$arrayName = array(
  'sucursal_id' => $_POST["sucursal_id"],
  'bodega_descripcion' => strtoupper($_POST["bodega_descripcion"]),
  'tipobodega_id' => $_POST["tipobodega_id"]
);
echo json_encode($arrayName);
/*if (Categoria::validarCategoria(strtoupper($_POST['categoria_descripcion']))) {
  echo 1;
} else {
  echo json_encode(Categoria::guardarCategorias(strtoupper($_POST['categoria_descripcion'])));
}*/