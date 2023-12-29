<?php
include dirname(dirname(__FILE__)) . "../../models/forma.php";
$data = Forma::obtenerForma1();
echo json_encode($data);
