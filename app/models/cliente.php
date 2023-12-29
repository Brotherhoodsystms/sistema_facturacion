<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Cliente extends Conexion
{
  public static function obtenerClientes()
  {
    try {
      $sql = "SELECT * FROM tbl_cliente";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerClienteId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_cliente c INNER JOIN tb_tipodocumento t ON c.id_tipodoc = t.id_tipdoc WHERE cliente_id=:cliente_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarClientesVenta($data)
  {
    try {
      $sql = "INSERT INTO tbl_cliente(cliente_razonsocial,cliente_ruc,cliente_telefono,cliente_direccion,cliente_email,cliente_contacto,id_tipodoc) VALUES(:cliente_razonsocial,:cliente_ruc,:cliente_telefono,:cliente_direccion,:cliente_email,:cliente_contacto,:cliente_tipo_documentoC)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_razonsocial", $data["cliente_razonsocial"]);
      $query->bindParam(":cliente_ruc", $data["cliente_ruc"]);
      $query->bindParam(":cliente_telefono", $data["cliente_telefono"]);
      $query->bindParam(":cliente_direccion", $data["cliente_direccion"]);
      $query->bindParam(":cliente_email", $data["cliente_email"]);
      $query->bindParam(":cliente_contacto", $data["cliente_contacto"]);
      $query->bindParam(":cliente_tipo_documentoC", $data["tipo_documentoC"]);
      $query->execute();
      $sql2 = "SELECT * FROM tbl_cliente WHERE cliente_ruc=:cliente_ruc";
      $query2 = Conexion::obtenerConexion()->prepare($sql2);
      $query2->bindParam(":cliente_ruc", $data["cliente_ruc"]);
      $query2->execute();
      return  $query2->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  } 
 
  public static function guardarClientes($data)
  {
    try {
      $sql = "INSERT INTO tbl_cliente(cliente_razonsocial,cliente_ruc,cliente_telefono,cliente_direccion,cliente_email,cliente_contacto,id_tipodoc) VALUES(:cliente_razonsocial,:cliente_ruc,:cliente_telefono,:cliente_direccion,:cliente_email,:cliente_contacto,:cliente_tipo_documentoC)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_razonsocial", $data["cliente_razonsocial"]);
      $query->bindParam(":cliente_ruc", $data["cliente_ruc"]);
      $query->bindParam(":cliente_telefono", $data["cliente_telefono"]);
      $query->bindParam(":cliente_direccion", $data["cliente_direccion"]);
      $query->bindParam(":cliente_email", $data["cliente_email"]);
      $query->bindParam(":cliente_contacto", $data["cliente_contacto"]);
      $query->bindParam(":cliente_tipo_documentoC", $data["tipo_documentoC"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarClientes($data)
  {
    try {
      $sql = "UPDATE tbl_cliente SET cliente_razonsocial=:cliente_razonsocial,cliente_ruc=:cliente_ruc,cliente_telefono=:cliente_telefono,cliente_direccion=:cliente_direccion,cliente_email=:cliente_email,cliente_contacto=:cliente_contacto,id_tipodoc=:cliente_tipo_documentoC WHERE cliente_id=:cliente_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_razonsocial", $data["cliente_razonsocial"]);
      $query->bindParam(":cliente_ruc", $data["cliente_ruc"]);
      $query->bindParam(":cliente_telefono", $data["cliente_telefono"]);
      $query->bindParam(":cliente_direccion", $data["cliente_direccion"]);
      $query->bindParam(":cliente_email", $data["cliente_email"]);
      $query->bindParam(":cliente_contacto", $data["cliente_contacto"]);
      $query->bindParam(":cliente_id", $data["cliente_id"]);
      $query->bindParam(":cliente_tipo_documentoC", $data["tipo_documentoC"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarRucCliente($ruc)
  {
    try {
      $sql = "SELECT cliente_ruc FROM tbl_cliente WHERE cliente_ruc=:cliente_ruc";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_ruc", $ruc);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarRucActualizarCliente($ruc, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_cliente WHERE cliente_ruc=:cliente_ruc OR cliente_id=:cliente_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_ruc", $ruc);
      $query->bindParam(":cliente_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarEmailCliente($email)
  {
    try {
      $sql = "SELECT cliente_email FROM tbl_cliente WHERE cliente_email=:cliente_email";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_email", $email);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarEmailActualizarCliente($email, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_cliente WHERE cliente_email=:cliente_email OR cliente_id=:cliente_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_email", $email);
      $query->bindParam(":cliente_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
