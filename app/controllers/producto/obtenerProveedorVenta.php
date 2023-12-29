<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/producto.php";
  $data = Producto::obtenerProveedorBycodigoRUC(($_POST["ruc_proveedor"]));
  echo json_encode($data);
