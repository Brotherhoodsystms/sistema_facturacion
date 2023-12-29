<?php
//include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Modelos extends Conexion
{
  public static function obtenerModelos()
  {

    try {
      $sql = "SELECT * FROM tbl_modelos ";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $id_rol);
      $query->execute();
      return $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerRolId($id_rol)
  {
    try {
      $sql = "SELECT * FROM tbl_rol WHERE  id_rol=:id_rol";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $id_rol);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
