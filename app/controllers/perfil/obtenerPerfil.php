<?php
include dirname(dirname(__FILE__)) . "../../models/perfil.php";
session_start();

$data = Perfil::ObternetPerfil($_SESSION['idUser']);
echo json_encode($data);
