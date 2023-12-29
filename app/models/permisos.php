<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Permisos extends Conexion
{
  public static function obtenerPermisoId($id_rol)
  {

    try {
      $sql = "SELECT * FROM tbl_permisos WHERE  id_rol=:id_rol";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $id_rol);
      $query->execute();
      return $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function eliminarPermisos($id_rol)
  {
    try {
      $sql = "DELETE FROM tbl_permisos WHERE id_rol=:id_rol";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $id_rol);
      $query->execute();
      return $query;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function insertarPermisos(int $intIdrol, string $idModulo, string $r, string $w, string $u, string $d, string $i)
  {
    try {

      $sql = "INSERT INTO tbl_permisos(id_rol,id_modulo,r,w,u,d,i) VALUES(:intIdrol,:idModulo,:r,:w,:u,:d,:i)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":intIdrol", $intIdrol);
      $query->bindParam(":idModulo", $idModulo);
      $query->bindParam(":r", $r);
      $query->bindParam(":w", $w);
      $query->bindParam(":u", $u);
      $query->bindParam(":d", $d);
      $query->bindParam(":i", $i);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
