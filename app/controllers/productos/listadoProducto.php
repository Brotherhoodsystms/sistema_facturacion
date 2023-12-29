<?php
session_start();
include dirname(dirname(__FILE__)) . "../../models/productos.php";
$data = Productos::obtenerProductos();
//echo base64_encode($data["producto_imagen"]);
$datos = array(
    'data' => $data,
    'permisosMod' => $_SESSION['permisosMod'],
    'nombre_apellido'=> $_SESSION['nomb_apelido']
  );
echo json_encode($datos);

//echo json_encode($data);

//echo json_encode($datos2);
//echo json_encode($datos);
//echo$datos;
//echo $data[0] -> producto_codigoserial;
//$imagen = base64_encode($data["producto_imagen"]);
//echo json_encode($datos);
