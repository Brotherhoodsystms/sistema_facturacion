<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Mercaderia extends Conexion
{
  public static function obtenerMercaderia()
  {
    try {
      $sql = "SELECT * FROM tbl_mercaderia m
      JOIN tbl_producto p ON m.producto_id =p.producto_id
      -- JOIN tbl_bodega b ON m.bodega_id=b.bodega_id
      -- JOIN tbl_sucursal s ON b.sucursal_id =s.sucursal_id
      JOIN tbl_categoria c ON p.categoria_id=c.categoria_id
      JOIN tbl_lote l ON p.lote_id=l.lote_id
      JOIN tbl_proveedor f ON p.proveedor_id=f.proveedor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerMercaderiaId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_mercaderia WHERE mercaderia_id=:mercaderia_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":mercaderia_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarMercaderia($data)
  {
    try {
      $sql = "INSERT INTO tbl_mercaderia(mercaderia_fechaelaboracion, mercaderia_fechaexpiracion, producto_id) VALUES(:mercaderia_fechaelaboracion,:mercaderia_fechaexpiracion,:producto_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":mercaderia_fechaelaboracion", $data["mercaderia_fechaelaboracion"]);
      $query->bindParam(":mercaderia_fechaexpiracion", $data["mercaderia_fechaexpiracion"]);
      $query->bindParam(":producto_id", $data["producto_id"]);
      // $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarMercaderia($data)
  {
    try {
      $sql = "UPDATE tbl_mercaderia SET mercaderia_fechaelaboracion=:mercaderia_fechaelaboracion, mercaderia_fechaexpiracion=:mercaderia_fechaexpiracion WHERE mercaderia_id=:mercaderia_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":mercaderia_fechaelaboracion", $data["mercaderia_fechaelaboracion"]);
      $query->bindParam(":mercaderia_fechaexpiracion", $data["mercaderia_fechaexpiracion"]);
      // $query->bindParam(":producto_id", $data["producto_id"]);
      $query->bindParam(":mercaderia_id", $data["mercaderia_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function eliminarMercaderia($id)
  {
    try {
      $sql = "DELETE FROM tbl_mercaderia WHERE mercaderia_id=:mercaderia_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":mercaderia_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
