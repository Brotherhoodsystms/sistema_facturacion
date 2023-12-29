<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/venta.php";
  $data = Venta::obtenerClienteBycodigoRUC(($_POST["ruc_cliente"]));
  echo json_encode($data);

