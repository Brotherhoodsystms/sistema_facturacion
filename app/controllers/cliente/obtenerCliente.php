<?php
include dirname(dirname(__FILE__)) . "../../models/cliente.php";
$data = Cliente::obtenerClienteId($_POST['id']);
echo json_encode($data);
