<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Cajachica extends Conexion
{
  public static function obtenerCajachica()
  {
    try {
      $sql = "SELECT * FROM tbl_cajachica l
      INNER JOIN tbl_detallecajachica dch ON l.cajachica_id =dch.cajachica_id
      INNER JOIN tbl_gasto g on g.gasto_id=dch.gasto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerCajachicaId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_cajachica l
      INNER JOIN tbl_detallecajachica dch ON l.cajachica_id =dch.cajachica_id
      INNER JOIN tbl_gasto g on g.gasto_id=dch.gasto_id
      WHERE l.cajachica_id=:cajachica_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cajachica_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarCajachica($data)
  {
    try {
      $sql = "INSERT INTO tbl_cajachica(cajachica_serie,cajachica_area,cajachica_fechaasignacion,cajachica_fechaliquidacion,cajachica_asignacion,cajachica_egreso,cajachica_reposicion,cajachica_diasjustificados,sucursal_id) VALUES(:cajachica_serie,:cajachica_area,:cajachica_fechaasignacion,:cajachica_fechaliquidacion,:cajachica_asignacion,:cajachica_egreso,:cajachica_reposicion,:cajachica_diasjustificados,:sucursal_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cajachica_serie", $data["cajachica_serie"]);
      $query->bindParam(":cajachica_area", $data["cajachica_area"]);
      $query->bindParam(":cajachica_fechaasignacion", $data["cajachica_fechaasignacion"]);
      $query->bindParam(":cajachica_fechaliquidacion", $data["cajachica_fechaliquidacion"]);
      $query->bindParam(":cajachica_asignacion", $data["cajachica_asignacion"]);
      $query->bindParam(":cajachica_egreso", $data["cajachica_egreso"]);
      $query->bindParam(":cajachica_reposicion", $data["cajachica_reposicion"]);
      $query->bindParam(":cajachica_diasjustificados", $data["cajachica_diasjustificados"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function maximoCajachica()
  {
    try {
      $sql = "SELECT MAX(cajachica_id) AS cajachica_id FROM tbl_cajachica";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
