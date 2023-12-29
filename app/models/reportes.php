<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Reportes extends Conexion
{
    public static function obtenerProductosKardexID($producto_id)
    {
      try {
        $sql = "SELECT p.producto_codigoserial,p.producto_id,p.producto_descripcion,
        s.sucursal_nombre,b.bodega_descripcion,ub.ubicacion_descripcion,
        p.producto_precio_menor,p.producto_precio_mayor,ub.ubicacion_cantidad,
       ub.ubicacion_id FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on
        s.sucursal_id=b.sucursal_id ";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->execute();
        return  $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function obtenerTotalKarx(){
      try {
        $sql = "SELECT SUM(ub.ubicacion_cantidad) as total FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on
        s.sucursal_id=b.sucursal_id ";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->execute();
        return  $query->fetch(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function obtenerCierresCaja()
    {
      try {
        $sql = "SELECT * FROM tbl_cierrecaja c INNER JOIN tbl_sucursal s ON c.sucursal_id = s.sucursal_id INNER JOIN 
        tbl_usuario u ON u.usuario_id = c.cierrecaja_usuarioid";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->execute();
        return  $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function obtenerStockCodigo($codigo,$sucursal){
      try{
        $sql = "SELECT p.producto_codigoserial,p.producto_id,p.producto_descripcion,
        s.sucursal_nombre,b.bodega_descripcion,ub.ubicacion_descripcion,
        p.producto_precio_menor,p.producto_precio_mayor,ub.ubicacion_cantidad,
       ub.ubicacion_id FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE p.producto_codigoserial=:codigo
        AND s.sucursal_id=:sucursal";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(':codigo', $codigo);
        $query->bindParam(':sucursal', $sucursal);
         $query->execute();
         return  $query->fetchAll(PDO::FETCH_ASSOC);

      }catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function obtenerTotalStock($codigo,$sucursal){
      try{
        $sql = "SELECT SUM(ub.ubicacion_cantidad) as total FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE p.producto_codigoserial=:codigo
        AND s.sucursal_id=:sucursal";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(':codigo', $codigo);
        $query->bindParam(':sucursal', $sucursal);
         $query->execute();
         return  $query->fetch(PDO::FETCH_ASSOC);

      }catch (\Throwable $ex) {
        return $ex->getMessage();
      }

    }
    public static function obtenerStockUbicacion($ubicacion,$sucursal){
      try{
        $sql = "SELECT p.producto_codigoserial,p.producto_id,p.producto_descripcion,
        s.sucursal_nombre,b.bodega_descripcion,ub.ubicacion_descripcion,
        p.producto_precio_menor,p.producto_precio_mayor,ub.ubicacion_cantidad,
       ub.ubicacion_id FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE ub.ubicacion_id=:ubicacion
        AND s.sucursal_id=:sucursal";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(':ubicacion', $ubicacion);
        $query->bindParam(':sucursal', $sucursal);
         $query->execute();
         return  $query->fetchAll(PDO::FETCH_ASSOC);

      }catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function obtenerTotalubicacion($ubicacion,$sucursal){
      try{
        $sql = "SELECT SUM(ub.ubicacion_cantidad)as total FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE ub.ubicacion_id=:ubicacion
        AND s.sucursal_id=:sucursal";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(':ubicacion', $ubicacion);
        $query->bindParam(':sucursal', $sucursal);
         $query->execute();
         return  $query->fetch(PDO::FETCH_ASSOC);

      }catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function obtenerFacturaVenta($ubicacion,$sucursal){
      try{
        $sql = "SELECT SUM(ub.ubicacion_cantidad)as total FROM tbl_ubicacion as ub JOIN tbl_producto p
        ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
        JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE ub.ubicacion_id=:ubicacion
        AND s.sucursal_id=:sucursal";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(':ubicacion', $ubicacion);
        $query->bindParam(':sucursal', $sucursal);
         $query->execute();
         return  $query->fetch(PDO::FETCH_ASSOC);

      }catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
  public  static function obtenerStockFecha($fecha_i,$fecha_f,$sucursal){
    try{
      $sql = "SELECT p.producto_codigoserial,p.producto_id,p.producto_descripcion,
      s.sucursal_nombre,b.bodega_descripcion,ub.ubicacion_descripcion,
      p.producto_precio_menor,p.producto_precio_mayor,ub.ubicacion_cantidad,
     ub.ubicacion_id FROM tbl_ubicacion as ub JOIN tbl_producto p
      ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
      JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE ub.ubicacion_fecha_i >:fecha_i
      AND ub.ubicacion_fecha_i <:fecha_f
      AND s.sucursal_id=:sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':fecha_i', $fecha_i);
      $query->bindParam(':fecha_f', $fecha_f);
      $query->bindParam(':sucursal', $sucursal);
       $query->execute();
       return  $query->fetchAll(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }

  }
  public  static function obtenerCierresFecha($fecha_i,$fecha_f,$sucursal){
    try{
      $sql = "SELECT * FROM tbl_cierrecaja c INNER JOIN tbl_sucursal s ON c.sucursal_id = s.sucursal_id INNER JOIN 
      tbl_usuario u ON u.usuario_id = c.cierrecaja_usuarioid WHERE c.cierrecaja_fecha_asignacion >:fecha_i
      AND c.cierrecaja_fecha_asignacion <:fecha_f
      AND c.sucursal_id=:sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':fecha_i', $fecha_i);
      $query->bindParam(':fecha_f', $fecha_f);
      $query->bindParam(':sucursal', $sucursal);
       $query->execute();
       return  $query->fetchAll(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }

  }
  public  static function obtenerVentaProducto($fecha_i,$fecha_f,$idcliente){
    try{
      $sql = "SELECT df.factura_id,df.detafatc_fecha_i,p.producto_codigoserial,p.producto_descripcion,ROUND(df.detafact_cantidad,2) AS detafact_cantidad,ROUND(df.detafact_total,2) 
      AS detafact_total FROM tbl_detallefactura df INNER JOIN tbl_factura f ON df.factura_id=f.factura_id INNER JOIN tbl_cliente c
      ON f.cliente_id=c.cliente_id INNER JOIN tbl_producto p ON p.producto_id = df.producto_id  WHERE c.cliente_ruc=:valor
      AND f.factura_fecha_i >:fecha_i
      AND f.factura_fecha_i <:fecha_f";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':fecha_i', $fecha_i);
      $query->bindParam(':fecha_f', $fecha_f);
      $query->bindParam(':valor', $idcliente);
       $query->execute();
       return  $query->fetchAll(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }

  }
  public static function obtenerTotalFecha($fecha_i,$fecha_f,$sucursal){
    try{
      $sql = "SELECT SUM(ub.ubicacion_cantidad)as total FROM tbl_ubicacion as ub JOIN tbl_producto p
      ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
      JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE ub.ubicacion_fecha_i >:fecha_i
      AND ub.ubicacion_fecha_i<:fecha_f
      AND s.sucursal_id=:sucursal";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':fecha_i', $fecha_i);
      $query->bindParam(':fecha_f', $fecha_f);
      $query->bindParam(':sucursal', $sucursal);
       $query->execute();
       return  $query->fetch(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}