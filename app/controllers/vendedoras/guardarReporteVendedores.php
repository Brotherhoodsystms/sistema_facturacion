<?php
include dirname(dirname(__FILE__)) . "../../models/vendedoras.php";
session_start();
$arrayName = array(

  /*'registro_idvendedor' => $_POST["registro_idvendedor"],*/
  'vendedoras_nombre' => strtoupper($_POST["vendedoras_nombre"]),
  'vendedoras_contacto' => strtoupper($_POST["vendedoras_contacto"]),
  'vendedoras_telefono' => $_POST["vendedoras_telefono"],
  'vendedora_sector' => strtoupper($_POST["vendedora_sector"]),
  'vendedoras_estatus' => $_POST["vendedoras_estatus"],
  'vendedora_horainicion' => $_POST["vendedora_horainicion"],
  'vendedor_direccion' => strtoupper($_POST["vendedor_direccion"]),
  'vendedoras_coordenadas' => $_POST["vendedoras_coordenadas"],
  'vendedoras_observacion' => strtoupper($_POST["vendedoras_observacion"]),
  'id_usuario' => $_SESSION["idUser"]
);

/*if (Vendedoras::validarNombreCliente(strtoupper($_POST["vendedoras_nombre"]))) {
  echo 1;
} else {*/
//var_dump('no se encontro datos en la base de datos');
echo json_encode(Vendedoras::guardarReporteVentas($arrayName));
/*}*/
