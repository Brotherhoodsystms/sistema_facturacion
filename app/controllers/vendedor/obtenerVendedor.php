<?php
include dirname(dirname(__FILE__)) . "../../models/vendedor.php";
$data = Vendedor::obtenerVendedorId($_POST['id']);
echo json_encode($data);
