<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Proveedor extends Conexion
{
  public static function obtenerProveedores()
  {
    try {
      $sql = "SELECT * FROM tbl_proveedor WHERE proveedor_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarProveedor($idProveedor)
  {
    try {
      $sql = "UPDATE tbl_proveedor SET proveedor_estado = 'I' WHERE proveedor_id=:proveedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_id", $idProveedor);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerProveedorId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_proveedor WHERE proveedor_id=:proveedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarProveedores($data)
  {
    try {
      $sql = "INSERT INTO tbl_proveedor(proveedor_razonsocial,proveedor_ruc,proveedor_telefono,proveedor_direccion,proveedor_email,proveedor_contacto) VALUES(:proveedor_razonsocial,:proveedor_ruc,:proveedor_telefono,:proveedor_direccion,:proveedor_email,:proveedor_contacto)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_razonsocial", $data["proveedor_razonsocial"]);
      $query->bindParam(":proveedor_ruc", $data["proveedor_ruc"]);
      $query->bindParam(":proveedor_telefono", $data["proveedor_telefono"]);
      $query->bindParam(":proveedor_direccion", $data["proveedor_direccion"]);
      $query->bindParam(":proveedor_email", $data["proveedor_email"]);
      $query->bindParam(":proveedor_contacto", $data["proveedor_contacto"]);
      $query->execute();
      $sql2 = "SELECT * FROM tbl_proveedor WHERE proveedor_ruc=:proveedor_ruc";
      $query2 = Conexion::obtenerConexion()->prepare($sql2);
      $query2->bindParam(":proveedor_ruc", $data["proveedor_ruc"]);
      $query2->execute();
      return  $query2->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function guardarProveedor($data)
  {
    try {
      $sql = "INSERT INTO tbl_proveedor(proveedor_razonsocial,proveedor_ruc,proveedor_telefono,proveedor_direccion,proveedor_email,proveedor_contacto) VALUES(:proveedor_razonsocial,:proveedor_ruc,:proveedor_telefono,:proveedor_direccion,:proveedor_email,:proveedor_contacto)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_razonsocial", $data["proveedor_razonsocial"]);
      $query->bindParam(":proveedor_ruc", $data["proveedor_ruc"]);
      $query->bindParam(":proveedor_telefono", $data["proveedor_telefono"]);
      $query->bindParam(":proveedor_direccion", $data["proveedor_direccion"]);
      $query->bindParam(":proveedor_email", $data["proveedor_email"]);
      $query->bindParam(":proveedor_contacto", $data["proveedor_contacto"]);
      $query->execute();
      return  true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarProveedores($data)
  {
    try {
      $sql = "UPDATE tbl_proveedor SET proveedor_razonsocial=:proveedor_razonsocial,proveedor_ruc=:proveedor_ruc,proveedor_telefono=:proveedor_telefono,proveedor_direccion=:proveedor_direccion,proveedor_email=:proveedor_email,proveedor_contacto=:proveedor_contacto WHERE proveedor_id=:proveedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_razonsocial", $data["proveedor_razonsocial"]);
      $query->bindParam(":proveedor_ruc", $data["proveedor_ruc"]);
      $query->bindParam(":proveedor_telefono", $data["proveedor_telefono"]);
      $query->bindParam(":proveedor_direccion", $data["proveedor_direccion"]);
      $query->bindParam(":proveedor_email", $data["proveedor_email"]);
      $query->bindParam(":proveedor_contacto", $data["proveedor_contacto"]);
      $query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarRucProveedor($ruc)
  {
    try {
      $sql = "SELECT proveedor_ruc FROM tbl_proveedor WHERE proveedor_ruc=:proveedor_ruc";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_ruc", $ruc);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarRucActualizarProveedor($ruc, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_proveedor WHERE proveedor_ruc=:proveedor_ruc OR proveedor_id=:proveedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_ruc", $ruc);
      $query->bindParam(":proveedor_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarEmailProveedor($email)
  {
    try {
      $sql = "SELECT proveedor_email FROM tbl_proveedor WHERE proveedor_email=:proveedor_email";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_email", $email);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarEmailActualizarProveedor($email, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_proveedor WHERE proveedor_email=:proveedor_email OR proveedor_id=:proveedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":proveedor_email", $email);
      $query->bindParam(":proveedor_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
