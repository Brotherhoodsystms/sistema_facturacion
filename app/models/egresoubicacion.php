<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Egresoubicacion extends Conexion
{
  public static function obtenerUbicacionTemporal($data)
  {
    try {
      $sql = "SELECT sum(tem_ubica_cantidad )FROM tbl_tempubicacion
    WHERE tem_ubica_usuario=:id_user AND tmp_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_user", $data);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardasHistorialyUbicacion($data)
  {
    try {
      $dbh = Conexion::obtenerConexion(); //DELETE FROM tbl_detalletemporal WHERE temp_idusuario=1
      $sql = "INSERT INTO tbl_detallefactura(detafact_cantidad,detafact_preciounitario,detafact_descuento,detafact_total,factura_id,producto_id)SELECT temp_cantvender,temp_precio,temp_descuento,temp_total,:id_factura,temp_idproducto FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_factura", $data["id_factura"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      if ($query->execute() == true) {
        $sql2 = "DELETE FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
        $query = Conexion::obtenerConexion()->prepare($sql2);
        $query->bindParam(":id_usuario", $data["id_usuario"]);
        $query->execute();
        return true;
      }
    } catch (\Throwable  $ex) {
      return $ex->getMessage();
    }
  }
  //todo::ingreso del hisorial tener en cuenta solo el identificador de historial
  public static function ingresarHistorial($datos)
  {
    try {
      $dbh = Conexion::obtenerConexion();
      $sql = "INSERT INTO tbl_historial (historial_accion, historial_tipo_proceso, historial_idusuario)
      VALUES (:accion, :idtransaccion,:usuario)";
      $query = $dbh->prepare($sql);
      $query->bindParam(":accion", $datos['accion']);
      $query->bindParam("idtransaccion", $datos['idtransaccion']);
      $query->bindParam("usuario", $datos['usuario']);
      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable  $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarUbicacion($datos)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion WHERE ubicacion_descripcion=:descripcion
      AND bodega_id=:bodega_id AND producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":descripcion", $datos['tem_ubica_descripcion']);
      $query->bindParam(":bodega_id", $datos['tem_ubica_bodegaid']);
      $query->bindParam(":producto_id", $datos['temp_ubica_productoid']);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerUbicacionesTemporal($datos)
  {
    try {
      $sql = "SELECT * FROM tbl_tempubicacion WHERE tem_ubica_usuario=:id_usuario AND tmp_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_usuario", $datos);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarCantidad($data, $cantidad)
  {
    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:ubicacion_cantidad WHERE ubicacion_descripcion=:descripcion AND bodega_id=:bodega_id AND producto_id=:producto_id;";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_cantidad", $cantidad);
      $query->bindParam(":descripcion", $data["tem_ubica_descripcion"]);
      $query->bindParam(":bodega_id", $data['tem_ubica_bodegaid']);
      $query->bindParam(":producto_id", $data['temp_ubica_productoid']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarNuevaUbicacion($datos)
  {
    try {
      $sql = "INSERT INTO tbl_ubicacion (ubicacion_descripcion, bodega_id, producto_id,ubicacion_cantidad)
      VALUES (:ubicacion_descripcion,:bodega_id,:producto_id,:ubicacion_cantidad)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam("ubicacion_descripcion", $datos["tem_ubica_descripcion"]);
      $query->bindParam("bodega_id", $datos["tem_ubica_bodegaid"]);
      $query->bindParam("producto_id", $datos["temp_ubica_productoid"]);
      $query->bindParam("ubicacion_cantidad", $datos["tem_ubica_cantidad"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizacionReferencia($datos, $id_historial)
  {
    try {
      $sql = "UPDATE tbl_tempubicacion SET tmp_estado='I',tem_idtransaccion =:id_referencia WHERE tem_ubica_id = :tem_ubica_id AND tem_ubica_usuario=:idusuario
      AND tem_ubica_descripcion=:tem_ubica_descripcion AND tem_ubica_bodegaid=:tem_ubica_bodegaid AND temp_ubica_productoid=:temp_ubica_productoid
      AND tmp_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_referencia", $id_historial);
      $query->bindParam(":tem_ubica_id", $datos["tem_ubica_id"]);
      $query->bindParam(":idusuario", $datos['idusuario']);
      $query->bindParam(":tem_ubica_descripcion", $datos["tem_ubica_descripcion"]);
      $query->bindParam(":tem_ubica_bodegaid", $datos["tem_ubica_bodegaid"]);
      $query->bindParam(":temp_ubica_productoid", $datos['temp_ubica_productoid']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
