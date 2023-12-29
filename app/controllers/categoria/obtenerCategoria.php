<?php
include dirname(dirname(__FILE__)) . "../../models/categoria.php";
$data = Categoria::obtenerCategoriaId($_POST['id']);
echo json_encode($data);