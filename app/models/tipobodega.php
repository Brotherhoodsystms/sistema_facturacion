<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Tipobodega extends Conexion
{
  public static function obtenerTipoBodegas()
  {
    try {
      $sql = "SELECT * FROM tbl_tipobodega";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerTipoBodegaId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_tipobodega WHERE tipobodega_id =:tipobodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tipobodega_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarTipoBodega($data)
  {
    try {
      $sql = "INSERT INTO tbl_tipobodega(tipobodega_especificacion,tipobodega_capacidad) VALUES(:tipobodega_especificacion,:tipobodega_capacidad)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tipobodega_especificacion", $data["tipobodega_especificacion"]);
      $query->bindParam(":tipobodega_capacidad", $data["tipobodega_capacidad"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarTipoBodega($data)
  {
    try {
      $sql = "UPDATE tbl_tipobodega SET tipobodega_especificacion=:tipobodega_especificacion,
      tipobodega_capacidad=:tipobodega_capacidad WHERE tipobodega_id=:tipobodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tipobodega_especificacion", $data["tipobodega_especificacion"]);
      $query->bindParam(":tipobodega_capacidad", $data["tipobodega_capacidad"]);
      $query->bindParam(":tipobodega_id", $data["tipobodega_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarEspecificacionTipoBodega($data)
  {
    try {
      $sql = "SELECT * FROM tbl_tipobodega WHERE tipobodega_especificacion=:tipobodega_especificacion AND tipobodega_capacidad=:tipobodega_capacidad";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tipobodega_especificacion", $data['tipobodega_especificacion']);
      $query->bindParam(":tipobodega_capacidad", $data['tipobodega_capacidad']);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarEspecificacionActualizarTipoBodega($data)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_tipobodega WHERE tipobodega_especificacion=:tipobodega_especificacion AND tipobodega_capacidad=:tipobodega_capacidad OR tipobodega_id=:tipobodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tipobodega_especificacion", $data['tipobodega_especificacion']);
      $query->bindParam(":tipobodega_capacidad", $data['tipobodega_capacidad']);
      $query->bindParam(":tipobodega_id", $data['tipobodega_id']);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
