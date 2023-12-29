<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Ubicacion extends Conexion
{
  public static function obtenerUbicacion()
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_tipobodega t ON b.tipobodega_id = t.tipobodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::listado de ubicaciones
  public static function obtenerUbicacionR()
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionTemporal($datos)
  {
    try {
      $sql = "SELECT * FROM tbl_tempubicacion as tu
      INNER JOIN tbl_bodega as b on tu.tem_ubica_bodegaid=b.bodega_id
      INNER JOIN tbl_producto as p on p.producto_id=tu.temp_ubica_productoid
      WHERE tem_ubica_usuario=:id_usuario AND tu.tmp_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_usuario", $datos);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_tipobodega t ON b.tipobodega_id = t.tipobodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id
      WHERE u.ubicacion_id =:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionIdParaProdu($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_tipobodega t ON b.tipobodega_id = t.tipobodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id
      WHERE u.ubicacion_id =:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionIdParaProduU($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_tipobodega t ON b.tipobodega_id = t.tipobodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id
      WHERE u.producto_id =:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionIdParaProduCantidad($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_tipobodega t ON b.tipobodega_id = t.tipobodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id
      WHERE u.ubicacion_id =:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionIdproducto($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u
      JOIN tbl_producto p ON u.producto_id = p.producto_id
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      JOIN tbl_sucursal s ON b.sucursal_id = s.sucursal_id
      WHERE p.producto_codigoserial =:ubicacion_id AND producto_status=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionParametros($datos)
  {
    // WHERE u.bodega_id=:ubicacion_id AND
    try {
      $sql = "SELECT *from tbl_ubicacion as u INNER JOIN
      tbl_producto as p on u.producto_id=p.producto_id INNER JOIN
      tbl_bodega as b on b.bodega_id=u.bodega_id WHERE
        p.producto_codigoserial=:codigo_producto";
      $query = Conexion::obtenerConexion()->prepare($sql);
      //$query->bindParam(":ubicacion_id", $datos['bodega_id']);
      $query->bindParam(":codigo_producto", $datos['producto_codigo']);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerUbicacionParametrosU($datos)
  {
    // WHERE u.bodega_id=:ubicacion_id AND
    try {
      $sql = "SELECT *from tbl_ubicacion as u INNER JOIN
      tbl_producto as p on u.producto_id=p.producto_id INNER JOIN
      tbl_bodega as b on b.bodega_id=u.bodega_id WHERE
        p.producto_codigoserial=:codigo_producto AND b.bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      //$query->bindParam(":ubicacion_id", $datos['bodega_id']);
      $query->bindParam(":codigo_producto", $datos['producto_codigo']);
      $query->bindParam(":bodega_id", $datos['bodega_id']);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //solo para ver la cantidad de para el llenado de tabla temporal
  public static function obtenerUbicacionParametrosIndividual($datos)
  {
    try {
      $sql = "SELECT *from tbl_ubicacion as u
       INNER JOIN tbl_producto as p
        on u.producto_id=p.producto_id
        WHERE u.bodega_id=:ubicacion_id AND u.ubicacion_descripcion=:ubicacion_descripcion AND
        p.producto_codigoserial=:codigo_producto";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $datos['bodega_id']);
      $query->bindParam(":ubicacion_descripcion", $datos['description']);
      $query->bindParam(":codigo_producto", $datos['producto_codigo']);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
    //solo para ver la cantidad de producto
    public static function obtenerUbicacionParametrosIndividualVenta($datos)
    {
      try {
        $sql = "SELECT * FROM tbl_sucursal s INNER JOIN tbl_bodega b ON s.sucursal_id=b.sucursal_id INNER JOIN tbl_ubicacion u ON b.bodega_id = u.bodega_id INNER JOIN tbl_producto p ON p.producto_id = u.producto_id WHERE p.producto_id = :cod_id AND u.ubicacion_cantidad != 0";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":cod_id", $datos['producto_id']);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
  //obterner datos de la ubiacion de acuerdo al id bodega y id producto, descripcion de producto
  public static function obtenerUbicacionParametrosbpdes($datos)
  {
    try {
      $sql = "SELECT *from tbl_ubicacion as u
       INNER JOIN tbl_producto as p
        on u.producto_id=p.producto_id
        WHERE u.bodega_id=:ubicacion_id AND u.ubicacion_descripcion=:ubicacion_descripcion AND
        p.producto_id=:codigo_producto";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $datos['bodega_origen']);
      $query->bindParam(":ubicacion_descripcion", $datos['descriptiono']);
      $query->bindParam(":codigo_producto", $datos['producto_codigo']);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }


  public static function guardarUbicacion($data)
  {
    try {
      $sql = "INSERT INTO tbl_ubicacion(ubicacion_descripcion, bodega_id, producto_id) VALUES (:ubicacion_descripcion, :bodega_id, :producto_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->bindParam(":producto_id", $data["producto_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarUbicacionTemporal($data)
  {
    try {
      $sql = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,temp_ubica_descripciono,temp_bodegaid_origen, tem_ubica_bodegaid, temp_ubica_productoid, tem_ubica_cantidad, tem_ubica_usuario)
      VALUES (:ubicacion_descripcion,:ubicacion_descripcion_o,:bodega_id_o, :ubicacion_bodega_r, :producto_idE, :producto_comprar, :id_usuario)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion"]);
      $query->bindParam(":ubicacion_descripcion_o", $data['ubicacion_descripcion_o']);
      $query->bindParam(":bodega_id_o", $data["bodega_id_o"]);
      $query->bindParam(":ubicacion_bodega_r", $data["ubicacion_bodega_r"]);
      $query->bindParam(":producto_idE", $data["producto_idE"]);
      $query->bindParam(":producto_comprar", $data["producto_comprar"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //actualizacion de cantidad en la tabla accion eliminar
  public static function actualizarUbicacionStockId($id_ubicacion, $cantidad)
  {

    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:ubicacion_cantidad WHERE ubicacion_id=:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_cantidad", $cantidad);
      $query->bindParam(":ubicacion_id", $id_ubicacion);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //eliminar fila de la tabla detalle temporal
  public static function eliminarDetalletempId($id_ubicacion)
  {
    try {
      $sql = "DELETE FROM tbl_tempubicacion WHERE tem_ubica_id = :id_ubicacion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(':id_ubicacion', $id_ubicacion);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarIngresoTemporal($data)
  {
    try {
      $sql = "SELECT *FROM tbl_tempubicacion
      WHERE tem_ubica_descripcion=:ubicacion_descripcion AND tem_ubica_bodegaid=:ubicacion_bodega_r AND temp_ubica_productoid=:producto_idE
      AND tem_ubica_usuario=:tem_ubica_usuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion"]);
      $query->bindParam(":ubicacion_bodega_r", $data["ubicacion_bodega_r"]);
      $query->bindParam(":producto_idE", $data["producto_idE"]);
      $query->bindParam(":tem_ubica_usuario", $data["id_usuario"]);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarUbicacionTemporal($data)
  {
    try {
      $sql = "UPDATE tbl_tempubicacion SET tem_ubica_cantidad=:cantidad WHERE tem_ubica_id=:temporal_bodega";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cantidad", $data["temporal_cantidad"]);
      $query->bindParam(":temporal_bodega", $data["tempo_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarProductoOrigen($data)
  {
    $cantidad = $data["producto_stock"] - $data["producto_comprar"];
    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:cantidad WHERE ubicacion_descripcion=:ubicacion_descripcion AND bodega_id=:bodega_id AND producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cantidad", $cantidad);
      $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion_o"]);
      $query->bindParam(":bodega_id", $data["bodega_id_o"]);
      $query->bindParam(":producto_id", $data["producto_idE"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarUbicacion($data)
  {
    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_descripcion=:ubicacion_descripcion, bodega_id=:bodega_id WHERE ubicacion_id=:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->bindParam(":ubicacion_id", $data["ubicacion_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function eliminarUbicacion($id)
  {
    try {
      $sql = "DELETE FROM tbl_ubicacion WHERE ubicacion_id =:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarDescripcionUbicacion($descripcion, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_ubicacion u
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      WHERE b.bodega_id =:bodega_id AND u.ubicacion_descripcion =:ubicacion_descripcion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $descripcion);
      $query->bindParam(":bodega_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarDescripcionActualizarUbicacion($data)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_ubicacion u
      JOIN tbl_bodega b ON u.bodega_id = b.bodega_id
      WHERE b.bodega_id =:bodega_id AND u.ubicacion_descripcion =:ubicacion_descripcion
      OR u.ubicacion_id =:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $data['ubicacion_descripcion']);
      $query->bindParam(":bodega_id", $data['bodega_id']);
      $query->bindParam(":ubicacion_id", $data['ubicacion_id']);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
