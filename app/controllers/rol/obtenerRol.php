<?php
include dirname(dirname(__FILE__)) . "../../models/rol.php";
$data = Rol::obtenerRolId($_POST["id_rol"]);
echo json_encode($data);
