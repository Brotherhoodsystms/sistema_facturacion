<?php
include dirname(dirname(__FILE__)) . "../../models/lote.php";
echo json_encode(Lote::obtenerLote());
