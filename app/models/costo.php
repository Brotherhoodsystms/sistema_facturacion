<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Costo extends Conexion
{
  public static function obtenerGasto()
  {
    try {
      $sql = "SELECT l.gastos_id, l.gastos_descripcion FROM tbl_gastos as l WHERE l.gasto_tipo='GASTO'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarGasto($gasto)
  {
    try {
      $sql = "INSERT INTO tbl_gasto(gasto_descripcion) VALUES(:gasto_descripcion)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":gasto_descripcion", $gasto);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarGasto($gasto)
  {
    try {
      $sql = "SELECT gasto_descripcion FROM tbl_gasto WHERE gasto_descripcion=:gasto_descripcion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":gasto_descripcion", $gasto);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
