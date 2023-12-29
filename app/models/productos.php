<?php
include dirname(dirname(__FILE__)) . '/config/conexion.php';
class Productos extends Conexion
{
    public static function obtenerProductos()
    {
        try {
            $sql = "SELECT p.producto_id,p.producto_codigoserial,p.producto_descripcion,ROUND(p.producto_precio_menor,2) as producto_precio_menor, 
                    ROUND(producto_precio_mayor,2) as producto_precio_mayor, ROUND(p.producto_stock,2) as producto_stock , c.categoria_descripcion,
                    p.producto_fechaelaboracion,p.producto_fechaexpiracion, p.producto_imagen FROM  tbl_producto  p INNER JOIN tbl_proveedor as pro on pro.proveedor_id=p.proveedor_id
        inner JOIN tbl_categoria as c on c.categoria_id=p.categoria_id
        WHERE p.producto_tipo!='M' AND p.producto_status = 1";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->execute();
           return $query->fetchAll(PDO::FETCH_ASSOC);
           //return base64_encode($query["producto_imagen"]);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerProductoId($id)
    {
        try {
            $sql =
                'SELECT * FROM tbl_producto WHERE producto_id = :id_producto ';

            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':id_producto', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function actualizarProductos($data)
    {
        try{
        $sql = "UPDATE tbl_producto SET producto_codigoserial=:producto_codigoserial,producto_descripcion=:producto_descripcion,
        producto_precio_menor=:producto_precio_menor,
        producto_precio_mayor=:producto_precio_mayor,
        producto_fechaelaboracion=:producto_fechaelaboracion,producto_fechaexpiracion=:producto_fechaexpiracion,
        producto_tipo_imp=:tipo_impuesto_id,producto_porcentaje=:porcentaje_iva,producto_imagen=:producto_imagen WHERE producto_id=:producto_id";
                $query = Conexion::obtenerConexion()->prepare($sql);
                $query->bindParam(":producto_codigoserial", $data["codigo_producto"]);
                $query->bindParam(":producto_descripcion", $data["producto_descripcion"]);
                $query->bindParam(":producto_precio_menor", $data["producto_precio_compra"]);
                $query->bindParam(":producto_precio_mayor", $data["producto_precio_venta"]);
                $query->bindParam(":producto_fechaelaboracion", $data["producto_fechaelaboracion"]);
                $query->bindParam(":producto_fechaexpiracion", $data["producto_fechaexpiracion"]);
                $query->bindParam(":tipo_impuesto_id",$data["tipo_impuesto_id"]);
                $query->bindParam(":porcentaje_iva",$data["porcentaje_iva"]);
                $query->bindParam(":producto_imagen",$data["producto_imagen"]);
                $query->bindParam(":producto_id", $data["producto_id"]);
                $query->execute();
                return true;
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
    public static function actualizarCantidadUbicacion($data){
        try{
            $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:cantidadNueva WHERE
            ubicacion_id=:ubicacion_id";
                    $query = Conexion::obtenerConexion()->prepare($sql);
                    $query->bindParam(":cantidadNueva", $data["cantidad"]);
                    $query->bindParam(":ubicacion_id", $data["ubicacion_id"]);
                    $query->execute();
                    return true;
            } catch (\Throwable $ex) {
                return $ex->getMessage();
            }
    }
    public static function actualizarCantidadProducto($producto_id,$cantidad){
        try{
            $sql = "UPDATE tbl_producto SET producto_stock=:producto_stock WHERE producto_id=:producto_id";
                    $query = Conexion::obtenerConexion()->prepare($sql);
                    $query->bindParam(":producto_stock", $cantidad);
                    $query->bindParam(":producto_id", $producto_id);
                    $query->execute();
                    return true;
            } catch (\Throwable $ex) {
                return $ex->getMessage();
            }
    }
    public static function validarCodigoserialProducto($codigo,$producto_id)
    {
      try {
        $sql = "SELECT producto_codigoserial FROM tbl_producto WHERE producto_codigoserial=:producto_codigoserial AND producto_tipo='P'
        AND producto_id=:producto_id";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":producto_codigoserial", $codigo);
        $query->bindParam(":producto_id", $producto_id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function validarCodigoserial($codigo)
    {
      try {
        $sql = "SELECT COUNT(*) FROM tbl_producto WHERE producto_codigoserial=:producto_codigoserial AND producto_tipo='P'";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":producto_codigoserial", $codigo);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
    public static function eliminarProductos($idProducto)
    {
      try {
        $sql = "UPDATE tbl_producto SET producto_status = 0 WHERE producto_id=:producto_id";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":producto_id", $idProducto);
        $query->execute();
        return true;
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
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

      //todo:ingreso de gastos compra
  public static function guardarGastos($data)
  {
      try {
          $sql = "INSERT INTO tbl_gastos (gastos_factura, gastos_descripcion, gastos_total,
          gasto_tipo,gastos_usuario,historial_idIngreso,gastos_emisor_id)
          VALUES (:gasto_factura,:gastos_descripcion,:gastos_total,:tipo_gasto,:id_usuario,
          :historial_idIngreso,:emisor_id);";
          $query = Conexion::obtenerConexion()->prepare($sql);
          $query->bindParam(':gasto_factura', $data['gasto_factura']);
          $query->bindParam(
              ':gastos_descripcion',
              $data['gastos_descripcion']
          );
          $query->bindParam(':gastos_total', $data['gastos_total']);
          $query->bindParam(':tipo_gasto', $data['tipo_gasto']);
          $query->bindParam(':id_usuario', $data['id_usuario']);
          $query->bindParam(':historial_idIngreso',$data['historial_id']);
          $query->bindParam(':emisor_id',$data['emisor_id']);
          $query->execute();
          return true;
      } catch (\Exception $ex) {
          return $ex->getMessage();
      }
  }

    public static function agregarUbicacionProductos($data)
    {
      try {
        $sql = "INSERT INTO tbl_ubicacion(ubicacion_descripcion,bodega_id,producto_id,ubicacion_cantidad) VALUES (:ubicacion_descripcion,:bodega_id,:producto_id,:ubicacion_cantidad)";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":producto_id", $data["producto_id"]);
        $query->bindParam(":bodega_id", $data["bodega_id"]);
        $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion"]);
        $query->bindParam(":ubicacion_cantidad", $data["ubicacion_cantidad"]);
        $query->execute();
        return true;
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }

    public static function guardarProductos($data)
    {
      try {
        $sql = "INSERT INTO tbl_producto(proveedor_id,categoria_id,producto_codigoserial,producto_descripcion,producto_precio_menor,producto_precio_mayor,producto_fechaelaboracion,producto_fechaexpiracion,producto_stock,producto_tipo_imp,producto_porcentaje,producto_ca,producto_imagen) VALUES(:proveedor_id,:categoria_id,:producto_codigoserial,:producto_descripcion,:producto_precio_menor,:producto_precio_mayor,:producto_fechaelaboracion,:producto_fechaexpiracion,:producto_stock,:tipo_impuesto_id,:porcentaje_iva,:producto_ca,:producto_imagen)";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":proveedor_id", $data["proveedor_id"]);
        $query->bindParam(":categoria_id", $data["categoria_id"]);
        $query->bindParam(":producto_codigoserial", $data["codigo_producto"]);
        $query->bindParam(":producto_descripcion", $data["producto_descripcion"]);
        $query->bindParam(":producto_precio_menor", $data["producto_precio_compra"]);
        $query->bindParam(":producto_precio_mayor", $data["producto_precio_venta"]);
        $query->bindParam(":producto_fechaelaboracion", $data["producto_fechaelaboracion"]);
        $query->bindParam(":producto_fechaexpiracion", $data["producto_fechaexpiracion"]);
        $query->bindParam(":producto_stock", $data["producto_stock"]);
        $query->bindParam(":tipo_impuesto_id",$data["tipo_impuesto_id"]);
        $query->bindParam(":porcentaje_iva",$data["porcentaje_iva"]);
        $query->bindParam(":producto_ca",$data["producto_ca"]);
        $query->bindParam(":producto_imagen",$data["producto_imagen"]);
        $query->execute();
        $sql2 = "SELECT * FROM tbl_producto WHERE producto_codigoserial=:producto_codigoserial";
        $query2 = Conexion::obtenerConexion()->prepare($sql2);
        $query2->bindParam(":producto_codigoserial", $data["codigo_producto"]);
        $query2->execute();
      return  $query2->fetch(PDO::FETCH_ASSOC);
      //  return true;
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }



}
