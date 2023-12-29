<?php
include dirname(dirname(__FILE__)) . "../../models/usuario.php";
if (Usuario::obtenerEstadoUsuario($_POST['id'])["usuario_estado"] != 'A') {
  echo json_encode(false);
} else {
  echo json_encode(true);
}
