<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Servicios extends Conexion
{
  public static function guardarServicio($data)
  {
    $fecha_creacion = date("Y-m-d");
    $fecha_expiracion = date("Y-m-d");
    $tipo = 'S';
    try {
      $sql = "INSERT INTO tbl_producto(producto_codigoserial,
      producto_descripcion,producto_precio_menor,producto_precio_mayor,
      producto_stock,producto_fechaelaboracion,producto_fechaexpiracion,
      producto_tipo,producto_tipo_imp,producto_porcentaje) VALUES(:producto_codigoserial,
      :producto_descripcion,:producto_precioxMe,:producto_precioxMa,
      :producto_stock,:producto_fechaelaboracion,:producto_fechaexpiracion,
      :producto_tipo,:producto_tipo_imp,:producto_porcentaje)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $data["producto_codigoserial"]);
      $query->bindParam(":producto_descripcion", $data["producto_descripcion"]);
      $query->bindParam(":producto_precioxMe", $data["producto_precioxMa"]);
      $query->bindParam(":producto_precioxMa", $data["producto_precioxMa"]);
      $query->bindParam(":producto_stock", $data["producto_stock"]);
      $query->bindParam(":producto_fechaelaboracion",     $fecha_creacion);
      $query->bindParam(":producto_fechaexpiracion", $fecha_expiracion);
      $query->bindParam(":producto_tipo", $tipo);
      $query->bindParam(":producto_tipo_imp", $data["id_tipo_impuesto"]);
      $query->bindParam(":producto_porcentaje", $data["id_porcentajeimpuesto"]);
      //$query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarServicio($data)
  {

    $fecha_creacion = date("Y-m-d");
    $fecha_expiracion = date("Y-m-d");
    $tipo = 'S';
    try {
      $sql = "UPDATE tbl_producto SET
    producto_descripcion =:producto_descripcion,
     producto_precio_menor =:producto_precioxMe,
      producto_precio_mayor =:producto_precioxMa,
       producto_stock =:producto_stock,
        producto_tipo_imp=:producto_tipo_imp,
         producto_porcentaje =:producto_porcentaje
          WHERE tbl_producto.producto_id = :producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_descripcion", $data["producto_descripcion"]);
      $query->bindParam(":producto_precioxMe", $data["producto_precioxMa"]);
      $query->bindParam(":producto_precioxMa", $data["producto_precioxMa"]);
      $query->bindParam(":producto_stock", $data["producto_stock"]);
      $query->bindParam(":producto_tipo_imp", $data["id_tipo_impuesto"]);
      $query->bindParam(":producto_porcentaje", $data["id_porcentajeimpuesto"]);
      $query->bindParam(":producto_id", $data["producto_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerServicios()
  {
    try {
      $sql = "SELECT * FROM tbl_producto as p INNER JOIN
      tbl_codimpu as ci on ci.codimp_id=p.producto_tipo_imp
      INNER JOIN tbl_tarifaiva as ti on
      ti.tarifaiva_id=p.producto_porcentaje WHERE p.producto_tipo='S' AND p.producto_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
