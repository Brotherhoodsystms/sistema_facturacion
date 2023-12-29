<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Bodega extends Conexion
{
  public static function obtenerBodegas()
  {
    try {
      $sql = "SELECT * FROM tbl_bodega b
      JOIN tbl_sucursal s ON b.sucursal_id=s.sucursal_id WHERE bodega_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarBodega($idBodega)
  {
    try {
      $sql = "UPDATE tbl_bodega SET bodega_estado = 'I' WHERE bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":bodega_id", $idBodega);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerBodegaId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_bodega WHERE bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":bodega_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarBodega($data)
  {
    try {
      $sql = "INSERT INTO tbl_bodega(bodega_descripcion,sucursal_id) VALUES(:bodega_descripcion,:sucursal_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":bodega_descripcion", $data["bodega_descripcion"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarBodega($data)
  {
    try {
      $sql = "UPDATE tbl_bodega SET bodega_descripcion=:bodega_descripcion, sucursal_id=:sucursal_id WHERE bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":bodega_descripcion", $data["bodega_descripcion"]);
      $query->bindParam(":sucursal_id", $data["sucursal_id"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarDescripcionBodega($descripcion, $nombre)
  {
    try {
      $sql = "SELECT s.sucursal_nombre, b.bodega_descripcion FROM tbl_bodega b JOIN tbl_sucursal s ON b.sucursal_id=s.sucursal_id WHERE b.bodega_descripcion=:bodega_descripcion AND s.sucursal_nombre=:sucursal_nombre";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":bodega_descripcion", $descripcion);
      $query->bindParam(":sucursal_nombre", $nombre);
      $query->execute();
      $resquest = $query->fetchAll(PDO::FETCH_ASSOC);
      if (!empty($resquest)) {
        return true;
      }
      return false;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarDescripcionActualizarBodega($descripcion, $nombre, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_bodega b JOIN tbl_sucursal s ON b.sucursal_id=s.sucursal_id WHERE b.bodega_descripcion=:bodega_descripcion AND s.sucursal_nombre=:sucursal_nombre OR bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":bodega_descripcion", $descripcion);
      $query->bindParam(":sucursal_nombre", $nombre);
      $query->bindParam(":bodega_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerNombreSucursal($id)
  {
    try {
      $sql = "SELECT sucursal_nombre FROM tbl_sucursal WHERE sucursal_id =:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerBodegaReferencia($id)
  {
    try {
      $sql = "SELECT * FROM tbl_bodega 
      WHERE sucursal_id =:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::para la tabla de punto emision llamado a los datos de bodega 
  public static function obtenerSucursal($id_establecimiento)
  {
    try {
      $sql = "SELECT es.id as estable_id, es.nombre as estable_nombre,emi.*,s.*
      FROM tbl_establecimiento as es INNER JOIN
      tbl_emisor as emi on emi.id=es.emisor_id
      INNER JOIN tbl_sucursal as s on s.sucursal_id=emi.id_sucursal
      where es.id=:id_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_establecimiento", $id_establecimiento);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerBodegaReferenciaSucursal($datos)
  {
    try {
      $sql = "SELECT DISTINCT b.* FROM tbl_ubicacion as u
      INNER JOIN tbl_bodega as b on u.bodega_id=b.bodega_id
      INNER JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id
      INNER JOIN tbl_producto as p on p.producto_id=u.producto_id
      WHERE s.sucursal_id=:sucursal_id AND p.producto_codigoserial=:codigo_serie;";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $datos['sucursal_id']);
      $query->bindParam(":codigo_serie", $datos['codigo_serie']);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
