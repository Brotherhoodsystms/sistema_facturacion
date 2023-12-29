<?php
// include '../config/conexion.php';
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Acceso extends Conexion
{
  public static function obtenerAccesos()
  {
    try {
      $sql = "SELECT a.acceso_id, a.acceso_descripcion FROM tbl_acceso a";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
