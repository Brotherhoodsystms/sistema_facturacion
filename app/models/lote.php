<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Lote extends Conexion
{
  public static function obtenerLote()
  {
    try {
      $sql = "SELECT l.lote_id, l.lote_descripcion FROM tbl_lote l";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarLote($lote)
  {
    try {
      $sql = "INSERT INTO tbl_lote(lote_descripcion) VALUES(:lote_descripcion)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":lote_descripcion", $lote);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarLote($lote)
  {
    try {
      $sql = "SELECT lote_descripcion FROM tbl_lote WHERE lote_descripcion=:lote_descripcion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":lote_descripcion", $lote);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
