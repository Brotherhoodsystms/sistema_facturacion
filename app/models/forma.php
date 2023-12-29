<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Forma extends Conexion
{
  public static function obtenerForma1()
  {
    try {
      $sql = "SELECT * FROM tbl_formapago WHERE formpago_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
