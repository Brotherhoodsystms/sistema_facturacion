<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Ptoemision extends Conexion
{
  public static function obtenerPtolistado()
  {
    try {
      $sql = "SELECT * FROM tbl_ptoemision";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerPtoemision($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ptoemision WHERE id=:id_puntoemision";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_puntoemision", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarPtoEmision($data)
  {
    $establecimiento = $data["ambiente_ptoemision"];
    try {
      $sql = "INSERT INTO `tbl_ptoemision` (`establecimiento_id`, `nombre`, `codigo`,
      `secuencialFactura`, `secuencialLiquidacionCompra`,`activo`,
      secuencia_reserva,ptemision_bodegaid,secuencial_proforma) VALUES
      (:establecimiento,:nombre_ptoemision,:codigo_ptemision,:secuenciaF_ptoemision,
      :secuecianotav_ptoemision,:estado_ptroemision,:secuencia_reserva,:bodega_ptoemision,:secuencial_proforma)";
      $query = Conexion::obtenerConexion()->prepare($sql);

      $query->bindParam(":establecimiento", $establecimiento);
      $query->bindParam(":nombre_ptoemision", $data["nombre_ptoemision"]);
      $query->bindParam(":codigo_ptemision", $data["codigo_ptemision"]);
      $query->bindParam(":secuenciaF_ptoemision", $data["secuenciaF_ptoemision"]);
      $query->bindParam(":secuecianotav_ptoemision", $data["secuecianotav_ptoemision"]);
      $query->bindParam(":estado_ptroemision", $data["estado_ptroemision"]);
      $query->bindParam(":secuencia_reserva", $data["secuencia_reserva"]);
      $query->bindParam(":bodega_ptoemision", $data['bodega_ptoemision']);
      $query->bindParam(":secuencial_proforma",$data['secuencial_proforma']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarPtoEmision($data)
  {
    $establecimiento = $data["ambiente_ptoemision"];
    try {
      $sql = "UPDATE tbl_ptoemision SET
      establecimiento_id=:establecimiento,
      nombre=:nombre_ptoemision,
      codigo=:codigo_ptemision,
      secuencialFactura=:secuenciaF_ptoemision,
      secuencialLiquidacionCompra=:secuecianotav_ptoemision,
      activo=:estado_ptroemision,secuencia_reserva=:secuencia_reserva,secuencial_proforma=:secuencial_proforma WHERE id=:pto_emision_id";
      $query = Conexion
        ::obtenerConexion()->prepare($sql);
      $query->bindParam(":establecimiento", $establecimiento);
      $query->bindParam(":nombre_ptoemision", $data["nombre_ptoemision"]);
      $query->bindParam(":codigo_ptemision", $data["codigo_ptemision"]);
      $query->bindParam(":secuenciaF_ptoemision", $data["secuenciaF_ptoemision"]);
      $query->bindParam(":secuecianotav_ptoemision", $data["secuecianotav_ptoemision"]);
      $query->bindParam(":estado_ptroemision", $data["estado_ptroemision"]);
      $query->bindParam(":pto_emision_id", $data["pto_emision_id"]);
      $query->bindParam(":secuencia_reserva", $data["secuencia_reserva"]);
      $query->bindParam(":secuencial_proforma",$data['secuencial_proforma']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarNombrePtoEmision($nombre)
  {
    try {
      $sql = "SELECT nombre FROM tbl_ptoemision WHERE nombre=:nombre_ptoemision";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":nombre_ptoemision", $nombre);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //eliminar suscursal
  public static function eliminarPtoEmision($id)
  {
    try {
      $sql = "DELETE FROM tbl_ptoemision WHERE id=:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //
  public static function validarNombreActualizarSucursal($nombre, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_sucursal WHERE sucursal_nombre=:sucursal_nombre OR sucursal_id=:sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":sucursal_nombre", $nombre);
      $query->bindParam(":sucursal_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function mostrarEstablecimientos()
  {
    try {
      $sql = "SELECT es.id as estable_id, es.nombre as estable_nombre,emi.*,s.* FROM tbl_establecimiento as es INNER JOIN tbl_emisor as emi on emi.id=es.emisor_id INNER JOIN tbl_sucursal as s on s.sucursal_id=emi.id_sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerPtoemisionbySucursal($dato)
  {
    try {
      $sql = "SELECT ptemision.id as idptemision,ptemision.establecimiento_id,
      ptemision.secuencialFactura as secuencialFactura,ptemision.secuencialLiquidacionCompra
      as secuencialLiquidacionCompra,ptemision.secuencia_reserva as secuencia_reserva,ptemision.secuencial_proforma as
      secuencialProformaPto, esta.*,emi.*
      FROM tbl_ptoemision as ptemision INNER JOIN tbl_establecimiento as esta
      on ptemision.establecimiento_id=esta.id INNER JOIN tbl_emisor as emi on esta.emisor_id=emi.id
      where emi.id_sucursal=:id_sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_sucursal", $dato);
      $query->execute();
      return  $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
