<?php
include dirname(dirname(__FILE__)) . "../../models/categoria.php";
$idCategoria = $_POST["id"];

echo json_encode(Categoria::eliminarCategoria($idCategoria));