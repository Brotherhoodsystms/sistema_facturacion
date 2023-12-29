<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Establecimiento extends Conexion
{
  public static function obtenerEstablecimientos()
  {
    try {
      $sql = "SELECT * FROM tbl_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerEstablecimientoId($id_establecimiento)
  {
    try {
      $sql = "SELECT * FROM tbl_establecimiento WHERE id=$id_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarRucEmisor($ruc)
  {
    try {
      $sql = "SELECT * FROM tbl_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_rol", $id_rol);
      $query->execute();
      return $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarEstablecimiento($data)
  {
    try {
      $secuencialProforma = "1";
      $sql = "INSERT INTO `tbl_establecimiento` (`emisor_id`, `nombre`, `codigo`,`nombreComercial`, `direccion`, `activo`,  `secuencialProforma`) VALUES (:emisor_establecimiento,:nombre_establecimiento,:codigo_establecimiento,:nombre_comercial_estable,:direccion_establecimiento,:estado_establecimiento,:secuencialProforma);";

      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":emisor_establecimiento", $data["emisor_establecimiento"]);
      $query->bindParam(":nombre_establecimiento", $data["nombre_establecimiento"]);
      $query->bindParam(":codigo_establecimiento", $data["codigo_establecimiento"]);
      $query->bindParam(":nombre_comercial_estable", $data["nombre_comercial_estable"]);
      $query->bindParam(":direccion_establecimiento", $data["direccion_establecimiento"]);
      $query->bindParam(":estado_establecimiento", $data["estado_establecimiento"]);
      $query->bindParam(":secuencialProforma", $secuencialProforma);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function eliminarEmisor($id_emisor)
  {
    try {
      $sql = "DELETE FROM tbl_emisor WHERE id=:id_emisor";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_emisor", $id_emisor);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actalizarEstablecimiento($data)
  {
    try {
      $sql = "UPDATE tbl_establecimiento SET emisor_id=:emisor_id,nombre=:nombre,
      codigo=:codigo,nombreComercial=:nombreComercial,direccion=:direccion,activo=:activo
      WHERE id=:id";

      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":emisor_id", $data["emisor_establecimiento"]);
      $query->bindParam(":nombre", $data["nombre_establecimiento"]);
      $query->bindParam(":codigo", $data["codigo_establecimiento"]);
      $query->bindParam(":nombreComercial", $data["nombre_comercial_estable"]);
      $query->bindParam(":direccion", $data["direccion_establecimiento"]);
      $query->bindParam(":activo", $data["estado_establecimiento"]);
      $query->bindParam(":id", $data["estableciminto_id"]);
      
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
