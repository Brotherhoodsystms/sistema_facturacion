<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/retencion.php";
$emisor_id=$_SESSION['emisor_id'];
$datos=array(
    'emisor_id' => $emisor_id,
    'temp_id' => $_POST['temp_id']
);
echo json_encode(Retencion::eliminarDetalletempId($_POST['temp_id']));