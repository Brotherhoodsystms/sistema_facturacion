<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
include dirname(dirname(__FILE__)) . "/utils/encriptacion.php";
class Login extends Conexion
{
  public static function validarLogin($data)
  {
    $password = Encryption::_encryptacion($data['password']);
    try {
      $sql = "SELECT * FROM tbl_usuario as u INNER JOIN tbl_emisor as e on
      e.id_sucursal=u.sucursal_id INNER JOIN tbl_acceso as ac on u.acceso_id = ac.acceso_id WHERE u.usuario_email=:username AND
      u.usuario_password=:password1 AND u.usuario_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":username", $data["username"]);
      $query->bindParam(":password1", $password);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUsuario($id_usuario)
  {
    try {
      $sql = "SELECT * FROM tbl_usuario as u INNER JOIN tbl_emisor as e on
      e.id_sucursal=u.sucursal_id
      WHERE u.usuario_id=:id_usuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_usuario", $id_usuario);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
