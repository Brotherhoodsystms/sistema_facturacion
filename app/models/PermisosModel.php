<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class PermisosModel extends Conexion
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
  public static function insertarPermisos(int $intIdrol, string $idModulo, string $r, string $w, string $u, string $d)
  {
    try {

      $sql = "INSERT INTO tbl_permisos(id_rol,id_modulo,r,w,u,d) VALUES(:intIdrol,:idModulo,:r,:w,:u,:d)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":intIdrol", $intIdrol);
      $query->bindParam(":idModulo", $idModulo);
      $query->bindParam(":r", $r);
      $query->bindParam(":w", $w);
      $query->bindParam(":u", $u);
      $query->bindParam(":d", $d);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function permisosModulo(int $idrol)
  {
    $intRolid = $idrol;
    $sql = "SELECT p.id_rol, p.id_modulo, m.nombre as modulo, p.r, p.w, p.u, p.d, p.i FROM tbl_permisos p INNER JOIN tbl_modelos m ON p.id_modulo= m.id_modelo WHERE p.id_rol=:id_rol";
    $query = Conexion::obtenerConexion()->prepare($sql);
    $query->bindParam(":id_rol", $intRolid);
    $query->execute();
    $request =
      $query->fetchall(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($request); $i++) {
      $arrPermisos[$request[$i]['id_modulo']] = $request[$i];
    }
    return $arrPermisos;
  }
}
