<?php
include dirname(dirname(__FILE__)) . "../../models/categoria.php";

$arrayName = array(
  'categoria_identificador' => $_POST["categoria_identificador"],
  'categoria_descripcion' => strtoupper($_POST["categoria_descripcion"])
);

if (Categoria::validarDescripcionActualizarCategoria(strtoupper($_POST["categoria_descripcion"]))) {
  echo 0;
} else {
  echo json_encode(Categoria::actualizarCategoria($arrayName));
}