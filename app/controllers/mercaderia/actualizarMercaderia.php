<?php
include dirname(dirname(__FILE__)) . "../../models/mercaderia.php";
$arrayName = array(
  'mercaderia_fechaelaboracion' => $_POST["mercaderia_fechaelaboracion"],
  'mercaderia_fechaexpiracion' => $_POST["mercaderia_fechaexpiracion"],
  // 'producto_id' => $_POST["producto_id_mercaderia"],
  'mercaderia_id' => $_POST["mercaderia_id"]
);
echo json_encode(Mercaderia::actualizarMercaderia($arrayName));
