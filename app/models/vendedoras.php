<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
date_default_timezone_set('America/Guayaquil');
class Vendedoras extends Conexion
{
  public static function obtenerReporteVendedoras()
  {
    try {
      $dia = '%' . date('Y-m-d') . '%';
      $sql = "SELECT * FROM tbl_reportevendedora as v INNER JOIN
      tbl_usuario as u on u.usuario_id=v.vendedoras_id_usuario WHERE v.vendedoras_fechaI LIKE '" . $dia . "'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerusuarioId($id_usuario)
  {
    try {
      $sql = "SELECT * FROM tbl_usuario AS U INNER JOIN tbl_acceso as a on a.acceso_id=u.acceso_id
      WHERE a.acceso_descripcion='ADMINISTRADOR' AND u.usuario_id=:id_usuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':id_usuario', $id_usuario);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerSucursalId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_sucursal WHERE sucursal_id=:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::para sucursal de ubicaicon
  public static function obtenerSucursalIdUbicacion($id)
  {
    try {
      $sql = "SELECT DISTINCT s.* FROM tbl_producto as p INNER JOIN tbl_ubicacion as u on p.producto_id=u.producto_id INNER JOIN tbl_bodega as b on b.bodega_id=u.bodega_id INNER JOIN tbl_sucursal as s on b.sucursal_id=s.sucursal_id WHERE u.producto_id=:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarReporteVentas($data)
  {
    try {
      $sql = "INSERT INTO tbl_reportevendedora(
      vendedoras_id_usuario, vendedoras_nombres,
      vendedoras_contacto, vendedoras_telefono,vendedoras_sector,
      vendedoras_direccion, vendedoras_observacion, vendedoras_estatus,
      vendedora_hora_inicio, vendedoras_coordenadas)
      VALUES(:vendedoras_id_usuario,:vendedoras_nombres,
      :vendedoras_contacto,:vendedoras_telefono,:vendedoras_sector,:vendedoras_direccion,
      :vendedoras_observacion,:vendedoras_estatus,
      :vendedora_hora_inicio, :vendedoras_coordenadas)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedoras_id_usuario", $data["id_usuario"]);
      $query->bindParam(":vendedoras_nombres", $data["vendedoras_nombre"]);
      $query->bindParam(":vendedoras_contacto", $data["vendedoras_contacto"]);
      $query->bindParam(":vendedoras_telefono", $data["vendedoras_telefono"]);
      $query->bindParam(":vendedoras_sector", $data["vendedora_sector"]);
      $query->bindParam(":vendedoras_direccion", $data["vendedor_direccion"]);
      $query->bindParam(":vendedoras_observacion", $data["vendedoras_observacion"]);
      $query->bindParam(":vendedoras_estatus", $data["vendedoras_estatus"]);
      $query->bindParam(":vendedora_hora_inicio", $data["vendedora_horainicion"]);
      $query->bindParam(":vendedoras_coordenadas", $data["vendedoras_coordenadas"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarSucursal($data)
  {
    try {
      $sql = "UPDATE tbl_sucursal SET sucursal_provincia=:sucursal_provincia,sucursal_nombre=:sucursal_nombre,sucursal_direccion=:sucursal_direccion,sucursal_telefono=:sucursal_telefono WHERE sucursal_id=:sucursal_id ";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_provincia", $data["sucursal_provincia"]);
      $query->bindParam(":sucursal_nombre", $data["sucursal_nombre"]);
      $query->bindParam(":sucursal_direccion", $data["sucursal_direccion"]);
      $query->bindParam(":sucursal_telefono", $data["sucursal_telefono"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarNombreCliente($nombre)
  {
    try {
      $sql = "SELECT * FROM tbl_reportevendedora WHERE vendedoras_nombres=:vendedoras_nombres";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedoras_nombres", $nombre);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //eliminar suscursal
  public static function eliminarSucursal($id)
  {
    try {
      $sql = "DELETE FROM tbl_sucursal WHERE sucursal_id=:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $id);
      return  $query->execute();
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //
  public static function validarNombreActualizarSucursal($nombre, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_sucursal WHERE sucursal_nombre=:sucursal_nombre OR sucursal_id=:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_nombre", $nombre);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
