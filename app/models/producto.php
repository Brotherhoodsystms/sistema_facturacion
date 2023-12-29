<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Producto extends Conexion
{

  public static function obtenerProductosKardex()
  {
    try {
      $sql = "SELECT p.producto_codigoserial,p.producto_id,p.producto_descripcion,
      s.sucursal_nombre,b.bodega_descripcion,ub.ubicacion_descripcion,
      p.producto_precio_menor,p.producto_precio_mayor,ub.ubicacion_cantidad,
     ub.ubicacion_id FROM tbl_ubicacion as ub JOIN tbl_producto p
      ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
      JOIN tbl_sucursal as s on
      s.sucursal_id=b.sucursal_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::detalle de ubicacion por producto
  public static function obtenerProductosKardexID($producto_id)
  {
    try {
      $sql = "SELECT p.producto_codigoserial,p.producto_id,p.producto_descripcion,
      s.sucursal_nombre,b.bodega_descripcion,ub.ubicacion_descripcion,
      p.producto_precio_menor,p.producto_precio_mayor,ub.ubicacion_cantidad,
     ub.ubicacion_id FROM tbl_ubicacion as ub JOIN tbl_producto p
      ON ub.producto_id=p.producto_id JOIN tbl_bodega as b on b.bodega_id=ub.bodega_id
      JOIN tbl_sucursal as s on
      s.sucursal_id=b.sucursal_id WHERE ub.producto_id=$producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductos()
  {
    try {
      $sql = "SELECT * FROM  tbl_producto WHERE producto_tipo='P' AND producto_status=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::eliminar tiempo de ejecucion
  public static function obtenerProductoskardex2()
  {
    try {
      $sql = "SELECT producto_id, producto_codigoserial,producto_descripcion
      FROM  tbl_producto WHERE producto_tipo='P' AND producto_status='1'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerImpuesto()
  {
    try {
      $sql = "SELECT * FROM tbl_codimpu";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerPorcentajeImpuestoIva($id_impuesto)
  {
    try {
      $sql = "SELECT * FROM tbl_tarifaiva";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
    //todo::detalleproducto
    public static function sumarDetalleProducto($id_usuario)
    {
      try {
        $sql = "SELECT ROUND(SUM(temp_producto_stock*temp_producto_precio_menor),2) AS total_factura_producto FROM tbl_producto_temp WHERE temp_pro_idusuario =:usuario_id";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":usuario_id", $id_usuario);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
  public static function obtenerCategoriaId($id_producto)
  {
    try {
      $sql = "SELECT * FROM tbl_producto p INNER JOIN tbl_categoria c ON p.categoria_id = c.categoria_id WHERE p.producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id_producto);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  
  public static function obtenerProductoId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto p
      JOIN tbl_categoria c ON p.categoria_id=c.categoria_id
      JOIN tbl_lote l ON p.lote_id=l.lote_id
      JOIN tbl_proveedor f ON p.proveedor_id=f.proveedor_id
      WHERE p.producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      $datos = $query->fetch(PDO::FETCH_ASSOC);
      $sql2 = "SELECT suc.sucursal_id, bod.bodega_id, ub.ubicacion_descripcion 
      FROM tbl_ubicacion as ub 
      INNER JOIN tbl_bodega as bod on ub.bodega_id=bod.bodega_id 
      INNER JOIN tbl_sucursal as suc on bod.sucursal_id=suc.sucursal_id 
      WHERE ub.producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql2);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      $datos2 = $query->fetch(PDO::FETCH_ASSOC);
      if (!empty($datos2)) {
        $datos['bodega_id'] = $datos2['bodega_id'];
        $datos['sucursal_id'] = $datos2['sucursal_id'];
        $datos['ubicacion_descripcion'] = $datos2['ubicacion_descripcion'];
      }
      return   $datos;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductoStockId($id)
  {
    try {
      $sql = "SELECT ubicacion_cantidad FROM tbl_ubicacion
      WHERE ubicacion_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductoStockDetalleId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion u INNER JOIN tbl_producto p ON u.producto_id = p.producto_id WHERE u.ubicacion_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductoSerial($serial)
  {
    try {
      $sql = "SELECT * FROM tbl_producto p
      JOIN tbl_lote l ON p.lote_id=l.lote_id
      JOIN tbl_ubicacion u ON p.producto_id =u.producto_id
      JOIN tbl_bodega b ON u.bodega_id=b.bodega_id
      WHERE p.producto_codigoserial =:producto_codigoserial AND p.producto_status=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $serial);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarProductos($data)
  {
    try {
      $sql = "INSERT INTO tbl_producto(producto_codigoserial,producto_descripcion,producto_precio_menor,producto_precio_mayor,producto_stock,producto_fechaelaboracion,producto_fechaexpiracion,categoria_id,lote_id,proveedor_id) VALUES(:producto_codigoserial,:producto_descripcion,:producto_precioxMe,:producto_precioxMa,:producto_stock,:producto_fechaelaboracion,:producto_fechaexpiracion,:categoria_id,:lote_id,:proveedor_id)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $data["producto_codigoserial"]);
      $query->bindParam(":producto_descripcion", $data["producto_descripcion"]);
      $query->bindParam(":producto_precioxMe", $data["producto_precioxMe"]);
      $query->bindParam(":producto_precioxMa", $data["producto_precioxMa"]);
      $query->bindParam(":producto_stock", $data["producto_stock"]);
      $query->bindParam(":producto_fechaelaboracion", $data["producto_fechaelaboracion"]);
      $query->bindParam(":producto_fechaexpiracion", $data["producto_fechaexpiracion"]);
      $query->bindParam(":categoria_id", $data["categoria_id"]);
      $query->bindParam(":lote_id", $data["lote_id"]);
      $query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarProductos($data)
  {
    try {
      $sql = "UPDATE tbl_producto SET producto_codigoserial=:producto_codigoserial,producto_descripcion=:producto_descripcion,producto_precio_menor=:producto_precio,producto_stock=:producto_stock,producto_fechaelaboracion=:producto_fechaelaboracion,producto_fechaexpiracion=:producto_fechaexpiracion,categoria_id=:categoria_id,lote_id=:lote_id,proveedor_id=:proveedor_id WHERE producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $data["producto_codigoserial"]);
      $query->bindParam(":producto_descripcion", $data["producto_descripcion"]);
      $query->bindParam(":producto_precio", $data["producto_precio"]);
      $query->bindParam(":producto_stock", $data["producto_stock"]);
      $query->bindParam(":producto_fechaelaboracion", $data["producto_fechaelaboracion"]);
      $query->bindParam(":producto_fechaexpiracion", $data["producto_fechaexpiracion"]);
      $query->bindParam(":categoria_id", $data["categoria_id"]);
      $query->bindParam(":lote_id", $data["lote_id"]);
      $query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->bindParam(":producto_id", $data["producto_id"]);
      $query->execute();
      return true;
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
  public static function validarCodigoserialProducto($codigo)
  {
    try {
      $sql = "SELECT producto_codigoserial FROM tbl_producto WHERE producto_codigoserial=:producto_codigoserial";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $codigo);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function validarCodigoserialActualizarProducto($codigo, $id)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_producto WHERE producto_codigoserial=:producto_codigoserial OR producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $codigo);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerCodigoProductoUbicacion($id)
  {
    try {
      $sql = "SELECT p.producto_codigoserial, p.producto_id FROM tbl_producto p
      JOIN tbl_ubicacion m ON p.producto_id = m.producto_id
      WHERE m.producto_id =:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function actualizarProductoStockId($id, $stock)
  {
    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:producto_stock WHERE ubicacion_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_stock", $stock);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerIdproducto($codigo_produto)
  {
    try {
      $sql = "SELECT producto_id FROM tbl_producto
      WHERE producto_codigoserial =:codigo_produto";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":codigo_produto", $codigo_produto);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarUbicacion($data)
  {
    try {
      $sql = "INSERT INTO tbl_ubicacion(ubicacion_descripcion, bodega_id, producto_id,ubicacion_cantidad) VALUES (:ubicacion_descripcion, :bodega_id, :producto_id,:producto_stock)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $data["ubicacion_descripcion"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->bindParam(":producto_id", $data["producto_id"]);
      $query->bindParam(":producto_stock", $data["producto_stock"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::los datos de ubicacion por cada producto
  public static function obtenerUbicacion($id_ubicacion)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion WHERE ubicacion_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id_ubicacion);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
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
  public static function ingresartempUbi($datos)
  {
    try {
      $sql = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,
      tem_ubica_bodegaid,temp_ubica_productoid,tem_ubica_cantidad,
      tem_ubica_usuario,tmp_estado,tem_idtransaccion)
      VALUES(:tem_ubica_descripcion,:tem_ubica_bodegaid,
      :temp_ubica_productoid,:tem_ubica_cantidad,:tem_ubica_usuario,
      :tmp_estado,:tem_idtransaccion)";
      $estado = 'I';
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tem_ubica_descripcion", $datos["ubicacion_descripcion"]);
      $query->bindParam(":tem_ubica_bodegaid", $datos["bodega_id"]);
      $query->bindParam(":temp_ubica_productoid", $datos["producto_id"]);
      $query->bindParam(":tem_ubica_cantidad", $datos["cantidad"]);
      $query->bindParam(":tem_ubica_usuario", $datos["idUsuario"]);
      $query->bindParam(":tmp_estado", $estado);
      $query->bindParam(":tem_idtransaccion", $datos["idtransaccion"]);

      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  //todo::datos temporales de  ingreso producto
  public static function obtenerUbicacionTemporal($datos)
  {
    try {
      $sql = "SELECT * FROM tbl_producto_temp as tp INNER JOIN tbl_bodega as b on b.bodega_id=tp.temp_pro_bodegaid WHERE tp.temp_pro_idusuario=:usuario_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":usuario_id", $datos);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::para ingreso de producto
  public static function obtenerUbicacionTemporalparaIngreso($datos)
  {
    try {
      $sql = "SELECT * FROM tbl_producto_temp WHERE temp_pro_idusuario=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $datos);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
     //todo::se modifico tener en mente si llegara a dañarse el proceso modificar en una nueva funcion
     public static function obtenerProveedorBycodigoRUC($id)
     {
       try {
         $sql = "SELECT * FROM tbl_proveedor WHERE proveedor_ruc=:proveedor_ruc";
         $query = Conexion::obtenerConexion()->prepare($sql);
         $query->bindParam(":proveedor_ruc", $id);
         $query->execute();
         return  $query->fetch(PDO::FETCH_ASSOC);
       } catch (\Throwable $ex) {
         return $ex->getMessage();
       }
     }
  
  //todo::validar si el codigo de producto existe
  public static function validarProducto($id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto WHERE producto_codigoserial=:producto_id AND producto_tipo='P'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return   $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::validar ubicacion de  producto en tabla ubicacion
  public static function validarUbicacion($id_bodega, $ubicacion, $id_productp)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion WHERE ubicacion_descripcion=:ubicacion_descripcion AND bodega_id=:bodega_id AND producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_descripcion", $ubicacion);
      $query->bindParam(":bodega_id", $id_bodega);
      $query->bindParam(":producto_id", $id_productp);
      $query->execute();
      $datos = $query->fetch(PDO::FETCH_ASSOC);

      return   $datos;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarProductoImagen($datos)
  {
    try {
      $sql = "UPDATE tbl_producto SET producto_precio_menor=:producto_precio_menor,producto_precio_mayor=:producto_precio_mayor,
      producto_stock=:producto_stock,producto_imagen=:producto_imagen WHERE producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_precio_menor", $datos['precio_menor']);
      $query->bindParam(":producto_precio_mayor", $datos['precio_mayor']);
      $query->bindParam(":producto_stock", $datos['cantidad_producto']);
      $query->bindParam(":producto_id", $datos['id_producto']);
      $query->bindParam(":producto_imagen", $datos['producto_imagen']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizar cantidad de producto
  public static function actualizarProducto($datos)
  {
    try {
      $sql = "UPDATE tbl_producto SET producto_precio_menor=:producto_precio_menor,producto_precio_mayor=:producto_precio_mayor,
      producto_stock=:producto_stock WHERE producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_precio_menor", $datos['precio_menor']);
      $query->bindParam(":producto_precio_mayor", $datos['precio_mayor']);
      $query->bindParam(":producto_stock", $datos['cantidad_producto']);
      $query->bindParam(":producto_id", $datos['id_producto']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizar cantidad en ubicacacion
  public static function actualizarUbicacion($datos)
  {
    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:ubicacion_cantidad WHERE ubicacion_id=:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":ubicacion_cantidad", $datos['cantidad_ubicacion']);
      $query->bindParam(":ubicacion_id", $datos['idubicacion']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::guardar ubicacion temporal desde productos
  public static function guardarUbicacionTemporal($datos)
  {
    try {
      $sql = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,
      tem_ubica_bodegaid,temp_ubica_productoid,tem_ubica_cantidad,
      tem_ubica_usuario,tmp_estado,tem_factura_compra,temp_totalfactura)
      VALUES(:tem_ubica_descripcion,:tem_ubica_bodegaid,
      :temp_ubica_productoid,:tem_ubica_cantidad,:tem_ubica_usuario,:tmp_estado,
      :id_facturaCompra,:temp_totalfactura)";
      $estado = 'A';
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":tem_ubica_descripcion", $datos["temp_pro_ubicaccion"]);
      $query->bindParam(":tem_ubica_bodegaid", $datos["temp_pro_bodegaid"]);
      $query->bindParam(":temp_ubica_productoid", $datos["id_productiP"]);
      $query->bindParam(":tem_ubica_cantidad", $datos["temp_producto_stock"]);
      $query->bindParam(":tem_ubica_usuario", $datos["id_usuario"]);
      $query->bindParam(":tmp_estado", $estado);
      $query->bindParam(":id_facturaCompra", $datos["id_facturaCompra"]);
      $query->bindParam(":temp_totalfactura", $datos["total_factura"]);

      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarProductosTemporales($data)
  {
    try {
      $sql = "INSERT INTO tbl_producto_temp(temp_producto_codigoserial,
      temp_producto_descripcion, temp_producto_precio_menor,
      temp_producto_precio_mayor, temp_producto_stock,
      temp_producto_fechaelaboracion, temp_producto_fechaexpiracion,
      temp_proveedor_id, temp_categoria_id, temp_lote_id, temp_pro_idusuario,
      temp_pro_bodegaid, temp_pro_ubicaccion,temp_producto_totalfactura
      ,temp_producto_tipoimpuesto,temp_producto_porcentajeimp,temp_producto_codigoreferencia,temp_producto_ca,temp_producto_imagen)
      VALUES(:temp_producto_codigoserial,:temp_producto_descripcion
      ,:temp_producto_precio_menor,:temp_producto_precio_mayor,:temp_producto_stock
      ,:producto_fechaelaboracion,:producto_fechaexpiracion,:proveedor_id
      ,:categoria_id,:lote_id,:id_usuario,:bodega_id,:ubicacion,:temp_producto_totalfactura,
      :temp_producto_tipoimpuesto,:temp_producto_porcentajeimp,:temp_producto_codigoreferencia,:temp_codigoAutomatico,:temp_producto_imagen)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_producto_codigoserial", $data["producto_codigoserial"]);
      $query->bindParam(":temp_producto_descripcion", $data["producto_descripcion"]);
      $query->bindParam(":temp_producto_precio_menor", $data["producto_precioxMe"]);
      $query->bindParam(":temp_producto_precio_mayor", $data["producto_precioxMa"]);
      $query->bindParam(":temp_producto_stock", $data["producto_stock"]);
      $query->bindParam(":producto_fechaelaboracion", $data["producto_fechaelaboracion"]);
      $query->bindParam(":producto_fechaexpiracion", $data["producto_fechaexpiracion"]);
      $query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->bindParam(":categoria_id", $data["categoria_id"]);
      $query->bindParam(":lote_id", $data["lote_id"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      $query->bindParam(":bodega_id", $data["bodega_id"]);
      $query->bindParam(":ubicacion", $data["descripcion_ubicacion"]);
      $query->bindParam(":temp_producto_totalfactura", $data["total_factura"]);
      $query->bindParam(":temp_producto_tipoimpuesto", $data["id_tipo_impuesto"]);
      $query->bindParam(":temp_producto_porcentajeimp", $data["id_porcentajeimpuesto"]);
      $query->bindParam(":temp_producto_codigoreferencia", $data["codigoReferenciaProducto"]);
      $query->bindParam(":temp_codigoAutomatico", $data["codigoAutomatico"]);
      $query->bindParam(":temp_producto_imagen", $data["producto_imagen"]);
      
      $query->execute();
      $sql2 = "SELECT sum(temp_producto_precio_menor*temp_producto_stock) as VALOR FROM tbl_producto_temp WHERE temp_pro_idusuario=:id_usuario";
      $query = Conexion::obtenerConexion()->prepare($sql2);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
      //return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //obtener suma de temporal de ubicacion
  public static function obtenerUbicacionTemporalcantidad($data)
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
  public static function eliminarDetalletempId($id_temp_producto, $id_usuario)
  {
    try {
      $sql = "DELETE FROM tbl_producto_temp WHERE temp_producto_id =:id_emisor AND temp_pro_idusuario=:temp_pro_idusuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_emisor", $id_temp_producto);
      $query->bindParam(":temp_pro_idusuario", $id_usuario);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::guardado de los productos
  public static function guardarProductoIn($id_usuario)
  {
    try {
      $dbh = Conexion::obtenerConexion();
      $sql = "INSERT INTO tbl_producto(producto_codigoserial,producto_descripcion
      ,producto_precio_menor,producto_precio_mayor,producto_stock,proveedor_id,
      categoria_id,lote_id,producto_total_f,producto_tipo_imp,producto_porcentaje,producto_codigoreferencia,producto_ca,producto_imagen)
      SELECT temp_producto_codigoserial,temp_producto_descripcion,temp_producto_precio_menor
      ,temp_producto_precio_mayor,temp_producto_stock,temp_proveedor_id,temp_categoria_id,temp_lote_id,
      temp_producto_totalfactura,temp_producto_tipoimpuesto,temp_producto_porcentajeimp,temp_producto_codigoreferencia,temp_producto_ca,temp_producto_imagen
      FROM tbl_producto_temp WHERE temp_producto_id =:id_producto";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_producto", $id_usuario);
      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable  $ex) {
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
  public static function validarUbicacion2($datos)
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
  public static function obtenerProductoStockIdProductos($id)
  {
    try {
      $sql = "SELECT producto_stock FROM tbl_producto
      WHERE producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizacion de prodcutos en stocl tabla productos
  public static function actualizarProductoDetalle($id_producto,$codigoProducto,$codigoReferencia,$descripcion,$precioCompra,$precioVenta,$categoria,$tipoimpuesto,$porcentajeimpuesto)
  {
    try {
      $sql = "UPDATE tbl_producto SET categoria_id =:producto_categoria,producto_tipo_imp =:producto_tipoimpuesto,producto_porcentaje =:producto_porcentajeimpuesto,producto_codigoserial =:producto_codigoserial,producto_descripcion =:producto_descripcion,producto_precio_menor =:producto_precio_menor,producto_precio_mayor =:producto_precio_mayor,producto_codigoreferencia =:producto_codigoreferencia
       WHERE producto_id =:producto_id;";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoreferencia", $codigoReferencia);
      $query->bindParam(":producto_precio_mayor", $precioVenta);
      $query->bindParam(":producto_precio_menor", $precioCompra);
      $query->bindParam(":producto_descripcion", $descripcion);
      $query->bindParam(":producto_codigoserial", $codigoProducto);
      $query->bindParam(":producto_categoria", $categoria);
      $query->bindParam(":producto_tipoimpuesto", $tipoimpuesto);
      $query->bindParam(":producto_porcentajeimpuesto", $porcentajeimpuesto);
      $query->bindParam(":producto_id", $id_producto);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizacion de prodcutos en stocl tabla productos
  public static function actualizarProductoStockIdProductos($id_producto,$cantidad)
  {
    try {
      $sql = "UPDATE tbl_producto SET producto_stock =:producto_stock
       WHERE producto_id =:producto_id;";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_stock", $cantidad);
      $query->bindParam(":producto_id", $id_producto);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function eliminarProductoTemporal($id_temp_producto)
  {
    try {
      $sql = "DELETE FROM tbl_producto_temp WHERE temp_producto_id =:temp_pro_idusuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_pro_idusuario", $id_temp_producto);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerUltimoCodigoAuto(){
    try{
      // $sql = "SELECT MAX(producto_codigoserial) AS ultimo FROM tbl_producto WHERE producto_ca=1 AND producto_tipo='P';";
      //$sql = "SELECT producto_id, (producto_codigoserial) AS ultimo FROM `tbl_producto` WHERE producto_tipo = 'P' AND producto_ca='1' AND producto_id = (SELECT MAX(producto_id) FROM tbl_producto)";
      $sql = "SELECT producto_id, (producto_codigoserial) AS ultimo FROM `tbl_producto` WHERE producto_tipo = 'P' AND producto_ca='1' AND producto_id =(SELECT MAX(producto_id) FROM tbl_producto  WHERE producto_tipo = 'P' AND producto_ca='1')";
      $query = Conexion::obtenerConexion()->prepare($sql);
      //$query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

   //todo::Datos de producto general
   public static function obtenerUltimoCodigo(){
    try{
      $sql = "SELECT MAX(producto_id) AS ultimo FROM tbl_producto ORDER BY producto_id DESC";
      $query = Conexion::obtenerConexion()->prepare($sql);
      //$query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo:prodcuto_id
  public static function obtenerCodigoSerial($id_producto){
    try{
      $sql = "SELECT *FROM tbl_producto where producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id_producto);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerCodigoSerialValUltimo($id_producto){
    try{
      $sql = "SELECT *FROM tbl_producto where producto_codigoserial=:producto_id AND producto_tipo='P'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id_producto);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerCodigoSerialValUltimoTemp(){
    try{
      $sql = "SELECT MAX(temp_producto_codigoserial) AS ultimo FROM tbl_producto_temp WHERE temp_producto_ca=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id_producto);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static  function obtenerProductoSerialUl($serial){
    try{
      $sql = "SELECT *FROM tbl_producto where producto_codigoserial=:serial";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":serial", $serial);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);

    }catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
}
