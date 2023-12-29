<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Comprobante extends Conexion
{
  public static function obtenerComprobante()
  {
    try {
      $sql = "SELECT * FROM tbl_comprobante WHERE comprobante_descripcion !='PROFORMA' AND comprobante_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
