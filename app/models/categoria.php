<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Categoria extends Conexion
{
  public static function obtenerCategorias()
  {
    try {
      $sql = "SELECT c.categoria_id, c.categoria_descripcion FROM tbl_categoria c WHERE categoria_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarCategoria($data)
  {
    try {
      $sql = "UPDATE tbl_categoria SET categoria_descripcion=:categoria_descripcion WHERE categoria_id=:categoria_identificador";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":categoria_identificador", $data["categoria_identificador"]);
      $query->bindParam(":categoria_descripcion", $data["categoria_descripcion"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarCategoria($idCategoria)
  {
    try {
      $sql = "UPDATE tbl_categoria SET categoria_estado = 'I' WHERE categoria_id=:categoria_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":categoria_id", $idCategoria);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarDescripcionActualizarCategoria($categoria)
  {
    try {
      $sql = "SELECT * FROM tbl_categoria WHERE categoria_descripcion=:categoria";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":categoria", $categoria);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }


  public static function obtenerCategoriaId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_categoria WHERE categoria_id=:categoria_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":categoria_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function guardarCategorias($categoria)
  {
    try {
      $sql = "INSERT INTO tbl_categoria(categoria_descripcion) VALUES(:categoria_descripcion)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":categoria_descripcion", $categoria);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarCategoria($categoria)
  {
    try {
      $sql = "SELECT categoria_descripcion FROM tbl_categoria WHERE categoria_descripcion=:categoria_descripcion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":categoria_descripcion", $categoria);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
