<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Trazabilidad extends Conexion
{
  public static function obtenerTrazabilidades()
  {
    try {
      $sql = "SELECT * FROM tbl_tempubicacion as tb
    INNER JOIN tbl_historial as h on tb.tem_idtransaccion=h.historial_id
    INNER JOIN tbl_producto as p on p.producto_id=tb.temp_ubica_productoid
    INNER JOIN tbl_usuario as u on u.usuario_id=tb.tem_ubica_usuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerBodegaDestino($id_bodega)
  {
    try {
      $sql = "SELECT b.bodega_descripcion from tbl_bodega as b WHERE b.bodega_id=:id_bodega";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':id_bodega', $id_bodega);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
