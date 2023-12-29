<?php
include dirname(dirname(__FILE__)) . '../../models/gastos.php';
session_start();
$arrayName = [
    'gastos_id' => $_POST['gastosid'],
    'gasto_factura' => $_POST['gasto_factura'],
    'gastos_descripcion' => strtoupper($_POST['gastos_descripcion']),
    'gastos_total' => $_POST['gastos_total'],
    'tipo_gasto' => $_POST['tipo_gasto'],
    'id_usuario' => $_SESSION['idUser'],
];
echo json_encode(Gastos::actualizarGastos($arrayName));
