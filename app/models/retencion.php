<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Retencion extends Conexion
{
  public static function obtenerRetencionesIva()
  {
    try {
      $sql = "SELECT * FROM tbl_impretencion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static  function obtenerRetencionesRenta(){
    try {
        $sql = "SELECT * FROM tbl_retencion_renta";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
  }
  //tbl_retencion_isd
  public static  function obtenerRetencionesIsd(){
    try {
        $sql = "SELECT * FROM tbl_retencion_isd";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
  }
  public static function guardarDetalleTemporal($array){
    try{
        $sql = "INSERT INTO tbl_detalletemp_retencion(detalle_tempr_base,
        detalle_tempr_tipo,detalle_tempr_porcentaje,detalle_tempr_idusu,detalle_tempr_emisor_id,
        detalle_tempr_total)
        VALUES(:detalle_tempr_base,:detalle_tempr_tipo,:detalle_tempr_porcentaje,:detalle_tempr_idusu,
        :detalle_tempr_emisor_id,:detalle_tempr_total)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":detalle_tempr_base", $array["base"]);
      $query->bindParam(":detalle_tempr_tipo", $array["tipo_renta"]);
      $query->bindParam(":detalle_tempr_porcentaje", $array["porcentaje_retencion"]);
      $query->bindParam(":detalle_tempr_idusu", $array["id_usuario"]);
      $query->bindParam(":detalle_tempr_emisor_id", $array["id_emisor"]);
      $query->bindParam(":detalle_tempr_total", $array["total"]);
      $query->execute();
      return true;

    }catch (\Throwable $ex){
        return $ex->getMessage();

    }
  }
  public static function obtenerDetalleTemp($data){
    try{
        $sql = "SELECT * FROM tbl_detalletemp_retencion as dt
        JOIN tbl_codrenta as ir on dt.detalle_tempr_tipo=ir.cod_renta_id
        WHERE dt.detalle_tempr_idusu=$data";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex){
        return $ex->getMessage();

    }
  }
  public static function obtenerSerie($emisor_id){
    try{
      $sql = "SELECT * FROM tbl_ptoemision as pe
      JOIN tbl_establecimiento as e on e.id=pe.establecimiento_id
      JOIN tbl_emisor as em on em.id=e.emisor_id WHERE em.id=$emisor_id";
    $query = Conexion::obtenerConexion()->prepare($sql);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);

  }catch (\Throwable $ex){
      return $ex->getMessage();

  }
  }
  public static function eliminarDetalletempId($id)
  {
    try {
      $sql = "DELETE FROM tbl_detalletemp_retencion
      WHERE detalle_tempr_id=:temp_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

}
