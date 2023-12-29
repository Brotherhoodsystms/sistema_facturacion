<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Rol extends Conexion
{
  public static function obtenerRoles()
  {
    try {
      $sql = "SELECT * FROM tbl_acceso WHERE estatus=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerRolId($id_rol)
  {
    try {
      $sql = "SELECT * FROM tbl_acceso WHERE  acceso_id=:id_rol";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $id_rol);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }


  public static function guardarRol($arrayName)
  {
    try {
      $sql = "INSERT INTO tbl_acceso(acceso_descripcion,estatus) VALUES(:nombre_rol,:estatus)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":nombre_rol", $arrayName["nombre_rol"]);
      $query->bindParam(":estatus", $arrayName["estatus_rol"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarNombreRol($nombre_rol)
  {
    try {
      $sql = "SELECT * FROM tbl_acceso WHERE acceso_descripcion=:nombre_rol";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":nombre_rol", $nombre_rol);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarRol($data)
  {
    try {
      $sql = "UPDATE tbl_acceso SET acceso_descripcion=:nombre_rol WHERE acceso_id=:id_rol";

      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":nombre_rol", $data["nombre_rol"]);
      $query->bindParam(":id_rol", $data["id_rol"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarRolND($data){
    try{
      $sql = "UPDATE tbl_acceso SET acceso_descripcion='" . $data["nombre_rol"] . "', estatus='" . $data["estatus_rol"] . "' WHERE acceso_id='" . $data["id_rol"] . "'";

      $query = Conexion::obtenerConexion()->prepare($sql);

      $query->execute();
      return true;

    }catch( \Throwable $ex){
      return $ex->getMessage();
    }
  }

  public static function eliminarRol($data)
  {
    try {
      $sql = "DELETE FROM tbl_acceso WHERE acceso_id:id_rol";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $data);
      return ($query->execute());
    } catch (\Throwable $ex) {
      if ($ex->getMessage()) {
        return $ex;
      }
    }
  }
}
