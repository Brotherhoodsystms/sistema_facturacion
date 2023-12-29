<?php
include dirname(dirname(__FILE__)) . "../../models/usuario.php";
$data = Usuario::obtenerUsuarioId($_POST['id']);
echo json_encode($data);