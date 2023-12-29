<?php
include_once '../config/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   

$nombre = (isset($_POST['acceso_descripcion'])) ? $_POST['acceso_descripcion'] : '';
$estatus = (isset($_POST['estatus'])) ? $_POST['estatus'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id = (isset($_POST['acceso_id'])) ? $_POST['acceso_id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO tbl_acceso (acceso_descripcion, estatus) VALUES('$nombre', '1') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT acceso_id, acceso_descripcion, estatus FROM tbl_acceso ORDER BY acceso_id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE tbl_acceso SET acceso_descripcion='$nombre' WHERE acceso_id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT acceso_id, acceso_descripcion, estatus FROM tbl_acceso WHERE acceso_id='$id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM tbl_acceso WHERE acceso_id='$id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();           
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
