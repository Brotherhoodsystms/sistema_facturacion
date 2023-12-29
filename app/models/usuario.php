<?php
// include "../config/conexion.php";
include dirname(dirname(__FILE__)) . "/config/conexion.php";
include dirname(dirname(__FILE__)) . "/utils/encriptacion.php";

class Usuario extends Conexion
{
  public static function obtenerUsuarios()
  {
    try {
      $sql = "SELECT * FROM tbl_usuario u
      JOIN tbl_acceso a ON u.acceso_id=a.acceso_id
      JOIN tbl_sucursal s ON u.sucursal_id=s.sucursal_id
      JOIN tbl_bodega b ON u.bodega_id=b.bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      // return  $query->fetchAll(PDO::FETCH_ASSOC);
      while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $json[] = array(
          'usuario_id' => $row['usuario_id'],
          'usuario_dni' => $row['usuario_dni'],
          'usuario_nombres' => $row['usuario_nombres'],
          'usuario_telefono' => $row['usuario_telefono'],
          'usuario_direccion' => $row['usuario_direccion'],
          'usuario_email' => $row['usuario_email'],
          'usuario_password' => Encryption::_desencryptacion($row['usuario_password']),
          'usuario_estado' => $row['usuario_estado'],
          'acceso_descripcion' => $row['acceso_descripcion'],
          'sucursal_provincia' => $row['sucursal_provincia'],
          'sucursal_nombre' => $row['sucursal_nombre'],
          'bodega_descripcion' => $row['bodega_descripcion']
        );
      }
      if (!empty($json)) {
        return $json;
      }
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function guardarUsuarios($data)
  {
    $password = Encryption::_encryptacion($data['usuario_password']);
    try {
      $sql = "INSERT INTO tbl_usuario(usuario_dni,usuario_nombres,usuario_telefono,usuario_direccion,usuario_email,usuario_password, acceso_id, sucursal_id,bodega_id) VALUES(:usuario_dni,:usuario_nombres,:usuario_telefono,:usuario_direccion,:usuario_email,:usuario_password,:acceso_id,:sucursal_id,:bodega_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_dni", $data["usuario_dni"]);
      $query->bindParam(":usuario_nombres", $data["usuario_nombres"]);
      $query->bindParam(":usuario_telefono", $data["usuario_telefono"]);
      $query->bindParam(":usuario_direccion", $data["usuario_direccion"]);
      $query->bindParam(":usuario_email", $data["usuario_email"]);
      $query->bindParam(":usuario_password", $password);
      $query->bindParam(":acceso_id", $data["acceso_id"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarDniUsuario($dni)
  {
    try {
      $sql = "SELECT usuario_dni FROM tbl_usuario WHERE usuario_dni=:usuario_dni";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_dni", $dni);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarEmailUsuario($email)
  {
    try {
      $sql = "SELECT usuario_email FROM tbl_usuario WHERE usuario_email=:usuario_email";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_email", $email);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function inactivarUsuario($id)
  {
    try {
      $sql = "UPDATE tbl_usuario SET usuario_estado='I' WHERE usuario_id=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUsuarioId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_usuario u INNER JOIN tbl_acceso a ON u.acceso_id = a.acceso_id INNER JOIN tbl_sucursal s ON u.sucursal_id = s.sucursal_id INNER JOIN tbl_bodega b ON u.bodega_id = b.bodega_id WHERE u.usuario_id =:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarRucActualizarUsuario($ruc)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_usuario WHERE usuario_dni=:usuario_dni";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_dni", $ruc);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  } 
  public static function validarEmailActualizarUsuario($email)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_usuario WHERE usuario_email=:usuario_email";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_email", $email);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarUsuario($data)
  {
    $password = Encryption::_encryptacion($data['usuario_password']);
    try {
      $sql = "UPDATE tbl_usuario SET usuario_dni=:usuario_dni,usuario_nombres=:usuario_nombres,usuario_telefono=:usuario_telefono,usuario_direccion=:usuario_direccion,usuario_email=:usuario_email,usuario_password=:usuario_password,acceso_id=:acceso_id,sucursal_id=:sucursal_id,bodega_id=:bodega_id WHERE usuario_id=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_dni", $data["usuario_dni"]);
      $query->bindParam(":usuario_nombres", $data["usuario_nombres"]);
      $query->bindParam(":usuario_telefono", $data["usuario_telefono"]);
      $query->bindParam(":usuario_direccion", $data["usuario_direccion"]);
      $query->bindParam(":usuario_email", $data["usuario_email"]);
      $query->bindParam(":usuario_password", $password);
      $query->bindParam(":acceso_id", $data["acceso_id"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->bindParam(":usuario_id", $data["usuario_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  
  public static function obtenerContraseniaUsuario($id)
  {
    try {
      $sql = "SELECT usuario_password FROM tbl_usuario WHERE usuario_id=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerEstadoUsuario($id)
  {
    try {
      $sql = "SELECT usuario_estado FROM tbl_usuario WHERE usuario_id=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function activarUsuario($id)
  {
    try {
      $sql = "UPDATE tbl_usuario SET usuario_estado='A' WHERE usuario_id=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
