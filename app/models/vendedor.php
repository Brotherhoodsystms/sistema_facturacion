<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Vendedor extends Conexion
{
  public static function obtenerVendedores()
  {
    try {
      $sql = "SELECT * FROM tbl_vendedor WHERE vendedor_estado = 'A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarVendedor($idVendedor)
  {
    try {
      $sql = "UPDATE tbl_vendedor SET vendedor_estado = 'I' WHERE vendedor_id=:vendedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedor_id", $idVendedor);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerVendedorId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_vendedor WHERE vendedor_id=:vendedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedor_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarVendedores($data)
  {
    try {
      $sql = "INSERT INTO tbl_vendedor(vendedor_dni,vendedor_nombres,vendedor_telefono,vendedor_direccion) VALUES(:vendedor_dni,:vendedor_nombres,:vendedor_telefono,:vendedor_direccion)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedor_dni", $data["vendedor_dni"]);
      $query->bindParam(":vendedor_nombres", $data["vendedor_nombres"]);
      $query->bindParam(":vendedor_telefono", $data["vendedor_telefono"]);
      $query->bindParam(":vendedor_direccion", $data["vendedor_direccion"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarVendedores($data)
  {
    try {
      $sql = "UPDATE tbl_vendedor SET vendedor_dni=:vendedor_dni,vendedor_nombres=:vendedor_nombres,vendedor_telefono=:vendedor_telefono,vendedor_direccion=:vendedor_direccion WHERE vendedor_id=:vendedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedor_dni", $data["vendedor_dni"]);
      $query->bindParam(":vendedor_nombres", $data["vendedor_nombres"]);
      $query->bindParam(":vendedor_telefono", $data["vendedor_telefono"]);
      $query->bindParam(":vendedor_direccion", $data["vendedor_direccion"]);
      $query->bindParam(":vendedor_id", $data["vendedor_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarDniVendedor($dni)
  {
    try {
      $sql = "SELECT vendedor_dni FROM tbl_vendedor WHERE vendedor_dni=:vendedor_dni";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedor_dni", $dni);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarDniActualizarVendedor($dni, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_vendedor WHERE vendedor_dni=:vendedor_dni OR vendedor_id=:vendedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":vendedor_dni", $dni);
      $query->bindParam(":vendedor_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
 
}
