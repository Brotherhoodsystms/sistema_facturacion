<?php
include dirname(dirname(__FILE__)) . "../../models/categoria.php";

if (Categoria::validarCategoria(strtoupper($_POST['categoria_descripcion']))) {
  echo 1;
} else {
  echo json_encode(Categoria::guardarCategorias(strtoupper($_POST['categoria_descripcion'])));
}
