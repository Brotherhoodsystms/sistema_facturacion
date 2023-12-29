<?php
include dirname(dirname(__FILE__)) . "../../models/cajachica.php";
echo json_encode(Cajachica::obtenerCajachica());