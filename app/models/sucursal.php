<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Sucursal extends Conexion
{
  public static function obtenerSucursal()
  {
    try {
      $sql = "SELECT * FROM tbl_sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
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
  public static function guardarSucursal($data)
  {
    try {
      $sql = "INSERT INTO tbl_sucursal(sucursal_provincia,sucursal_nombre,sucursal_direccion,sucursal_telefono) VALUES(:sucursal_provincia,:sucursal_nombre,:sucursal_direccion,:sucursal_telefono)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_provincia", $data["sucursal_provincia"]);
      $query->bindParam(":sucursal_nombre", $data["sucursal_nombre"]);
      $query->bindParam(":sucursal_direccion", $data["sucursal_direccion"]);
      $query->bindParam(":sucursal_telefono", $data["sucursal_telefono"]);
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
  public static function validarNombreSucursal($nombre)
  {
    try {
      $sql = "SELECT sucursal_nombre FROM tbl_sucursal WHERE sucursal_nombre=:sucursal_nombre";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_nombre", $nombre);
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
