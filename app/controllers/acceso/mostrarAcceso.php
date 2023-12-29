<?php
// include "../../models/acceso.php";
include dirname(dirname(__FILE__)) . "../../models/acceso.php";
echo json_encode(Acceso::obtenerAccesos());
