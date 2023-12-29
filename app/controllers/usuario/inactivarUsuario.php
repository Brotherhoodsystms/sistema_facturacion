<?php
include dirname(dirname(__FILE__)) . "../../models/usuario.php";
echo json_encode(Usuario::inactivarUsuario($_POST['id']));
