<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Notaventa extends Conexion
{
  public static function obtenerMercaderia($emisor_id)
  {
    try {
      $sql = "SELECT * FROM tbl_notaventa as n INNER JOIN tbl_formapago as fp on fp.formpago_id=n.formpago_id
      JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id
      JOIN tbl_cliente as c on c.cliente_id=n.cliente_id WHERE n.emisor_id = $emisor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
      return $ex->getMessage();
    }
  }
}
