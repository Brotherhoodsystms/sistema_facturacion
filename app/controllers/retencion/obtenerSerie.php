<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/retencion.php";
$emisor_id=$_SESSION['emisor_id'];
echo json_encode(Retencion::obtenerSerie($emisor_id));