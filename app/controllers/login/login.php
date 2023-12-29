<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/login.php";
$arrayName = array(
  'username' => $_POST["username"],
  'password' => $_POST["password"]
);
$dato = Login::validarLogin(($arrayName));
if (!empty($dato)) {;
  $_SESSION['login'] = true;
  $_SESSION['idUser'] = $dato['usuario_id'];
  $_SESSION['id_rol'] = $dato['acceso_id'];
  $_SESSION['sucursal_id'] = $dato['sucursal_id'];
  $_SESSION['bodega_id'] = $dato['bodega_id'];
  $_SESSION['emisor_id'] = $dato['id'];
  $_SESSION['nombreComercial']=$dato['nombreComercial'];
  $_SESSION['email'] = $dato['usuario_email'];
  $_SESSION['rol'] = $dato['acceso_descripcion'];
  $_SESSION['ci'] = $dato['usuario_dni'];
  $datos_usuario=Login::obtenerUsuario($dato['usuario_id']); //
  $_SESSION['nomb_apelido']=$datos_usuario['usuario_nombres'];
  $_SESSION['telefono']=$datos_usuario['usuario_telefono'];
  echo json_encode($dato);
} else {
  echo json_encode($dato = 0);
  $_SESSION['login'] = false;
}
