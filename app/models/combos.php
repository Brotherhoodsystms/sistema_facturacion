<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Combos extends Conexion
{
  public static function obtenerDetalleTempCombos($id_usuario)
  {
    try {
      $sql = "SELECT * FROM tbl_detalletemp_combos c INNER JOIN tbl_producto p ON c.temp_combos_productoid = p.producto_id WHERE temp_combos_usuarioid=$id_usuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerDetalleCombos($idProducto)
  {
    try {
      $sql = "SELECT * FROM tbl_combos c INNER JOIN tbl_producto p ON c.producto_id = p.producto_id WHERE combo_id=:idProducto";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":idProducto", $idProducto);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerCombos()
  {
    try {
      $sql = "SELECT * FROM tbl_producto p INNER JOIN tbl_categoria c ON p.categoria_id = c.categoria_id WHERE p.producto_tipo='C' AND producto_status=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarTemporalCombos($idProducto,$idUsuario)
  {
    try {
      $sql = "SELECT COUNT(*) FROM tbl_detalletemp_combos
      WHERE temp_combos_productoid=:temp_combos_productoid
      AND temp_combos_usuarioid=:temp_combos_usuarioid";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_combos_productoid", $idProducto);
      $query->bindParam(":temp_combos_usuarioid", $idUsuario);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
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
  
  //todo::datos de detalle de factura por  id factura
  public static function obtenerDetalleFactura($id_factura)
  {
    try {
      $sql = "SELECT * FROM tbl_detallefactura as detafact inner join tbl_producto as produc
      on detafact.producto_id=produc.producto_id WHERE detafact.factura_id=$id_factura";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarDetalleTemp($data)
  {
    try {
      $sql = "INSERT INTO tbl_detalletemp_combos(temp_combos_productoid,temp_combos_cantidad,temp_combos_precio,temp_combos_total,
      temp_combos_usuarioid,temp_combos_bodegaid,temp_combos_descripcion_u)
      VALUES(:temp_combos_productoid,:temp_combos_cantidad,:temp_combos_precio,:temp_combos_total,:temp_combos_usuarioid,:temp_combos_bodega_id,
      :temp_combos_descripcion_u)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_combos_productoid", $data["temp_combos_productoid"]);
      $query->bindParam(":temp_combos_cantidad", $data["temp_combos_cantidad"]);
      $query->bindParam(":temp_combos_precio", $data["temp_combos_precio"]);
      $query->bindParam(":temp_combos_total", $data["temp_combos_total"]);
      $query->bindParam(":temp_combos_usuarioid", $data["temp_combos_usuarioid"]);
      $query->bindParam(":temp_combos_bodega_id", $data["temp_combos_bodega_id"]);
      $query->bindParam(":temp_combos_descripcion_u", $data["temp_combos_descripcion_u"]);

      $query->execute();
      return 1;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::guardar datos de detalle temporal de servicio 
  public static function guardarDetalleTempServicio($data)
  {
    try {
      $sql = "INSERT INTO tbl_detalletemporal(temp_serialproducto,temp_descripcion,temp_cantvender,temp_precio,temp_descuento,temp_total,temp_idproducto,temp_idusuario) VALUES(:temp_serialproducto,:temp_descripcion,:temp_cantvender,:temp_precio,:temp_descuento,:temp_total,:temp_idproducto,:temp_idusuario)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_serialproducto", $data["temp_serialproducto"]);
      $query->bindParam(":temp_descripcion", $data["temp_descripcion"]);
      $query->bindParam(":temp_cantvender", $data["temp_cantvender"]);
      $query->bindParam(":temp_precio", $data["temp_precio"]);
      $query->bindParam(":temp_descuento", $data["temp_descuento"]);
      $query->bindParam(":temp_total", $data["temp_total"]);
      $query->bindParam(":temp_idproducto", $data["temp_idproducto"]);
      $query->bindParam(":temp_idusuario", $data["temp_idusuario"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function eliminarDetalletempId($id)
  {
    try {
      $sql = "DELETE FROM tbl_detalletemp_combos
      WHERE temp_combos_id=:temp_combos_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_combos_id", $id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerDescripcionStockDirecta($idProducto,$idBodega)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion
      WHERE producto_id=:producto_id AND bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $idProducto);
      $query->bindParam(":bodega_id", $idBodega);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarCliente($id,$razonsocial,$ruc,$direccion,$correo)
  {
    try {
      $sql = "UPDATE tbl_cliente SET cliente_razonsocial=:cliente_razonsocial, cliente_ruc=:cliente_ruc,cliente_direccion=:cliente_direccion,cliente_email=:cliente_email
      WHERE cliente_id=:cliente_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_id", $id);
      $query->bindParam(":cliente_razonsocial", $razonsocial);
      $query->bindParam(":cliente_ruc", $ruc);
      $query->bindParam(":cliente_direccion", $direccion);
      $query->bindParam(":cliente_email", $correo);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function actualizarDetalletempIdCombos($id,$nuevacantidad,$total)
  {
    try {
      $sql = "UPDATE tbl_detalletemp_combos SET temp_combos_cantidad=:temp_combos_cantidad , temp_combos_total=:temp_combos_total
      WHERE temp_combos_id=:temp_combos_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_combos_id", $id);
      $query->bindParam(":temp_combos_cantidad", $nuevacantidad);
      $query->bindParam(":temp_combos_total", $total);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::eliminar detalle de factura con id
  public static function eliminarDetalleFacturaId($id, $producto_id)
  {
    try {
      $sql = "DELETE FROM tbl_detallefactura
      WHERE factura_id=:temp_id AND producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_id", $id);
      $query->bindParam(":producto_id", $producto_id);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function sumarDetalleTempCombos($id_usuario)
  {
    try {
      $sql = "SELECT SUM(temp_combos_precio) as total FROM tbl_detalletemp_combos where temp_combos_usuarioid=:temp_idusuario";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_idusuario", $id_usuario);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::detallefactura
  public static function sumarDetalleFactura($factura_id)
  {
    try {
      $sql = "SELECT factura_total as total, factura_subtotal as subtotal FROM tbl_factura where factura_id=$factura_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
    // todo: producto models //actualizarProductoStockIdProductos
    public static function listaProductoBodega($idProducto,$idBodega,$uDescripcion)
    {
      try {
        $sql = "SELECT * FROM tbl_ubicacion where producto_id=:producto_id AND bodega_id =:bodega_id AND ubicacion_descripcion=:ubicacion_descripcion'";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":producto_id", $idProducto);
        $query->bindParam(":bodega_id", $idBodega);
        $query->bindParam(":ubicacion_descripcion",$uDescripcion);
        $query->execute();
        return  $query->fetchAll(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
  // todo: producto models //actualizarProductoStockIdProductos
  public static function actualizarProductoStockId($datos)
  {
    try {
      $sql = "UPDATE tbl_ubicacion SET ubicacion_cantidad=:producto_stock WHERE producto_id=:producto_id
      AND bodega_id=:bodega_id
      AND ubicacion_descripcion=:ubicacion_descripcion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_stock", $datos['nuevo_stock']);
      $query->bindParam(":producto_id", $datos['producto_id']);
      $query->bindParam(":bodega_id", $datos['bodega_id']);
      $query->bindParam(":ubicacion_descripcion", $datos['ubicacion_descripcion']);
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
  //todo::actualizarSerieFactura
  public static function actualizarSerieFactura($data)
  {
    $serie = $data['factura_serie'] + 1;
    try {
      $sql = "UPDATE tbl_ptoemision SET secuencialFactura =:serie  WHERE id = :id_ptoestablecimiento AND establecimiento_id=:id_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":serie", $serie);
      $query->bindParam(":id_ptoestablecimiento", $data['pto_emision_id']);
      $query->bindParam(":id_establecimiento", $data['id_establecimiento']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizar tabla temporal de servicio
  public static function actualizarDetalleTempServicio($data)
  {
    try {
      $sql = "UPDATE tbl_detalletemporal SET temp_cantvender =:temp_cantvender,temp_total=:temp_total
      WHERE temp_id = :temp_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_cantvender", $data['temp_cantvender']);
      $query->bindParam(":temp_total", $data['temp_total']);
      $query->bindParam(":temp_id", $data['temp_id']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizarSerieNotaVenta
  public static function actualizarSerieNotaVenta($data)
  {
    $serie = $data['factura_serie'] + 1;
    try {
      $sql = "UPDATE tbl_ptoemision SET secuencialLiquidacionCompra =:serie  WHERE id = :id_ptoestablecimiento AND establecimiento_id=:id_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":serie", $serie);
      $query->bindParam(":id_ptoestablecimiento", $data['pto_emision_id']);
      $query->bindParam(":id_establecimiento", $data['id_establecimiento']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizarSerieReserva
  public static function actualizarSerieReserva($data)
  {
    $serie = $data['reserva_numero'] + 1;
    try {
      $sql = "UPDATE tbl_ptoemision SET secuencia_reserva =:serie  WHERE id = :id_ptoestablecimiento AND establecimiento_id=:id_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":serie", $serie);
      $query->bindParam(":id_ptoestablecimiento", $data['pto_emision_id']);
      $query->bindParam(":id_establecimiento", $data['id_establecimiento']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  
  public static function obtenerDescripcionStock($idProducto,$idBodega,$idUbicacion)
  {
    try {
      $sql = "SELECT * FROM tbl_ubicacion
      WHERE producto_id=:producto_id AND bodega_id=:bodega_id AND ubicacion_id=:ubicacion_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $idProducto);
      $query->bindParam(":bodega_id", $idBodega);
      $query->bindParam(":ubicacion_id", $idUbicacion);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  

  public static function obtenerProductoStockId($id)
  {
    try {
      $sql = "SELECT producto_stock,producto_descripcion FROM tbl_producto
      WHERE producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::obtener stock producto desde la ubicacion para eliminar 
  public static function obtenerProductoStockIdU($data)
  {
    try {
      $sql = "SELECT ubicacion_cantidad FROM tbl_ubicacion
      WHERE producto_id=:producto_id AND bodega_id=:bodega_id
      AND ubicacion_descripcion=:ubicacion_descripcion";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $data['producto_id']);
      $query->bindParam(":bodega_id", $data['bodega_id']);
      $query->bindParam(":ubicacion_descripcion", $data['ubicacion_descripcion']);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::validar si existe en la tabla temporal
  public static function validarTemporal()
  {
    try {
      $sql = "SELECT * FROM tbl_detalletemporal
      WHERE temp_idproducto=:temp_idproducto
      AND temp_bodegaid_o=:temp_bodegaid_o
      AND temp_descripcionu=:temp_descripcionu";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":temp_idproducto", $temp_producto);
      $query->bindParam(":temp:bodegaid_o", $temp_bodegaid_o);
      $query->bindParam(":temp_descripcionu", $temp_descripcionu);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::validar temporal de servicio
  public static function validarTemporalServicio($codigo_serie)
  {
    try {
      $sql = "SELECT * FROM tbl_detalletemporal WHERE temp_serialproducto=:codigo_serie";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":codigo_serie", $codigo_serie);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductosCombos()
  {
    try {
      $sql = "SELECT producto_id,producto_codigoserial,producto_descripcion,ROUND(producto_precio_menor,2) AS producto_precio_menor,producto_precio_mayor,ROUND(producto_stock,2) AS producto_stock,producto_tipo,producto_codigoreferencia,producto_imagen FROM tbl_producto WHERE producto_status='1' AND producto_tipo='P'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  /*desarrollado por CREDP-S SOLUCIONES CIVILES Y TECNOLOGICAS TEL:0987139033*/
  public static function obtenerListaDocumentos()
  {
    try {
      $sql = "SELECT * FROM tb_tipodocumento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchall(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerClientesVenta()
  {
    try {
      $sql = "SELECT * FROM tbl_cliente";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return  $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerListaVendedores()
  {
    try {
      $sql = "SELECT * FROM tbl_vendedor WHERE vendedor_estado ='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();;
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  /*funcion de ingreso de producto desde la barra de <venta></venta>*/
  public static function guardarProductos($data)
  {
    $fecha_creacion = date("Y-m-d");
    $fecha_expiracion = date("Y-m-d");
    try {
      $sql = "INSERT INTO tbl_producto(producto_codigoserial,producto_descripcion,producto_precio_menor,producto_precio_mayor,producto_stock,producto_fechaelaboracion,producto_fechaexpiracion) VALUES(:producto_codigoserial,:producto_descripcion,:producto_precioxMe,:producto_precioxMa,:producto_stock,:producto_fechaelaboracion,:producto_fechaexpiracion)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $data["temp_serialproducto"]);
      $query->bindParam(":producto_descripcion", $data["temp_descripcion"]);
      $query->bindParam(":producto_precioxMe", $data["temp_precioxMe"]);
      $query->bindParam(":producto_precioxMa", $data["temp_precioxMa"]);
      $query->bindParam(":producto_stock", $data["temp_cantvender"]);
      $query->bindParam(":producto_fechaelaboracion",     $fecha_creacion);
      $query->bindParam(":producto_fechaexpiracion", $fecha_expiracion);
      // $query->bindParam(":categoria_id", $data["categoria_id"]);
      //$query->bindParam(":lote_id", $data["temp_lote"]);
      //$query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::guardar prodcuto servicios
  public static function guardarProductoServ($data)
  {
    $fecha_creacion = date("Y-m-d");
    $fecha_expiracion = date("Y-m-d");
    $tipo = 'S';
    try {
      $sql = "INSERT INTO tbl_producto(producto_codigoserial,
      producto_descripcion,producto_precio_menor,producto_precio_mayor,
      producto_stock,producto_fechaelaboracion,producto_fechaexpiracion,
      producto_tipo,producto_tipo_imp,producto_porcentaje) VALUES(:producto_codigoserial,:producto_descripcion,
      :producto_precioxMe,:producto_precioxMa,:producto_stock,
      :producto_fechaelaboracion,:producto_fechaexpiracion,
      :producto_tipo,:producto_tipo_imp,:producto_porcentaje)";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $data["temp_serialproducto"]);
      $query->bindParam(":producto_descripcion", $data["temp_descripcion"]);
      $query->bindParam(":producto_precioxMe", $data["temp_precioxMe"]);
      $query->bindParam(":producto_precioxMa", $data["temp_precioxMa"]);
      $query->bindParam(":producto_stock", $data["temp_cantvender"]);
      $query->bindParam(":producto_fechaelaboracion",     $fecha_creacion);
      $query->bindParam(":producto_fechaexpiracion", $fecha_expiracion);
      $query->bindParam(":producto_tipo", $tipo);
      $query->bindParam(":producto_tipo_imp", $data["producto_tipo_imp"]);
      $query->bindParam(":producto_porcentaje", $data["producto_porcentaje"]);
      //$query->bindParam(":proveedor_id", $data["proveedor_id"]);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductoBycodigo($id)
  {
    try {
      $sql = "SELECT producto_id FROM tbl_producto
      WHERE producto_codigoserial=:producto_codigoserial";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::datos de id producto
  public static function obtenerProdcutoId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto
      WHERE producto_id=:producto_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_id", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::para  producto de servicio
  public static function obtenerProductoBycodigoServicio($id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto
      WHERE producto_codigoserial=:producto_codigoserial AND producto_tipo='S'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //obtener datos de producto para la tabla
  public static function obtenerProductoBycodigotodo($id, $bodega_id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto as p
      JOIN tbl_ubicacion as ub on p.producto_id=ub.producto_id
      WHERE p.producto_codigoserial=:producto_codigoserial
      AND UB.bodega_id=:bodega_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $id);
      $query->bindParam(
        ":bodega_id",
        $bodega_id
      );
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::se modifico tener en mente si llegara a dañarse el proceso modificar en una nueva funcion
  public static function obtenerProductoBycodigotodosinBodega($id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto as p
      JOIN tbl_ubicacion as ub on p.producto_id=ub.producto_id
      WHERE p.producto_codigoserial=:producto_codigoserial AND p.producto_tipo='P' AND p.producto_status=1";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
    //todo::se modifico tener en mente si llegara a dañarse el proceso modificar en una nueva funcion
    public static function obtenerClienteBycodigoRUC($id)
    {
      try {
        $sql = "SELECT * FROM tbl_cliente WHERE cliente_ruc=:cliente_ruc";
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(":cliente_ruc", $id);
        $query->execute();
        return  $query->fetch(PDO::FETCH_ASSOC);
      } catch (\Throwable $ex) {
        return $ex->getMessage();
      }
    }
  //obtencion de cliente obtenerClienteId
  public static function obtenerClienteId($id)
  {
    try {
      $sql = "SELECT * FROM tbl_cliente
      WHERE cliente_ruc=:cliente_ruc";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":cliente_ruc", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarProducto($data)
  {
    try {
      $dbh = Conexion::obtenerConexion();
      $sql = "INSERT INTO tbl_producto(producto_codigoserial,producto_descripcion,producto_precio_menor,producto_precio_mayor,producto_stock,
      proveedor_id,categoria_id,producto_tipo,producto_tipo_imp,producto_porcentaje,producto_ca)
       VALUES(:codigoserial_producto_combo,:descripcion_producto_combo,:combos_compra,:combos_total,:combos_stock,
       :combos_proveedorid,:combos_categoriaid,:combos_productotipo,:tipo_impuesto_id,:porcentaje_iva,:producto_ca)";
      $query = $dbh->prepare($sql);
      $query->bindParam(":codigoserial_producto_combo", $data["codigoserial_producto_combo"]);
      $query->bindParam(":descripcion_producto_combo", $data["descripcion_producto_combo"]);
      $query->bindParam(":combos_compra", $data["combos_compra"]);
      $query->bindParam(":combos_total", $data["combos_total"]);
      $query->bindParam(":combos_stock", $data["combos_stock"]);
      $query->bindParam(":combos_proveedorid", $data["combos_proveedorid"]);
      $query->bindParam(":combos_categoriaid", $data["combos_categoriaid"]);
      $query->bindParam(":combos_productotipo", $data["combos_productotipo"]);
      $query->bindParam(":tipo_impuesto_id", $data["tipo_impuesto_id"]);
      $query->bindParam(":porcentaje_iva", $data["porcentaje_iva"]);
      $query->bindParam(":producto_ca", $data["producto_ca"]);
      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function validarCodigoseriaCombo($codigo)
  {
    try {
      $sql = "SELECT producto_codigoserial FROM tbl_producto WHERE producto_codigoserial=:producto_codigoserial AND producto_tipo='C'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":producto_codigoserial", $codigo);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function guardarDetalleFactura($data)
  {
    try {
      $dbh = Conexion::obtenerConexion(); //DELETE FROM tbl_detalletemporal WHERE temp_idusuario=1
      $sql = "INSERT INTO tbl_combos(combo_id,
      producto_id,cantidad)SELECT
      :id_producto,temp_combos_productoid,temp_combos_cantidad FROM tbl_detalletemp_combos WHERE temp_combos_usuarioid=:id_usuario";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_producto", $data["id_producto"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      if ($query->execute() == true) {
        $sql2 = "DELETE FROM tbl_detalletemp_combos WHERE temp_combos_usuarioid=:id_usuario";
        $query = Conexion::obtenerConexion()->prepare($sql2);
        $query->bindParam(":id_usuario", $data["id_usuario"]);
        $query->execute();
        return true;
      }
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //guardarNotaVenta guardado de nota de venta en la base de datos
  public static function guardarNotaVenta($data)
  {
    try {
      $dbh = Conexion::obtenerConexion();
      $iva=0;

      $sql = "INSERT INTO tbl_notaventa(notaventa_serie,
      notaventa_fechagenerada,notaventa_subtotal,notaventa_iva,
      notaventa_total,formpago_id,cliente_id,comprobante_id,emisor_id,notaventa_usuario_id)
       VALUES(:factura_serie,:factura_fechagenerada,:factura_subtotal,
       :factura_iva,:factura_total,:formpago_id,:cliente_id,:comprobante_id,
       :emisor_id,:notaventa_usuario_id)";
      $query = $dbh->prepare($sql);
      $query->bindParam(":factura_serie", $data["factura_serie"]);
      $query->bindParam(":factura_fechagenerada", $data["factura_fechagenerada"]);
      $query->bindParam(":factura_subtotal", $data["factura_subtotal"]);
      $query->bindParam(":factura_iva", $iva);
      $query->bindParam(":factura_total", $data["factura_total"]);
      $query->bindParam(":formpago_id", $data["forma_id"]);
      $query->bindParam(":cliente_id", $data["id_cliente"]);
      $query->bindParam(":comprobante_id", $data["comprobante_id"]);
      $query->bindParam(":emisor_id", $data["emisor_id"]);
      $query->bindParam(":notaventa_usuario_id", $data['id_usuario']);
      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //guardarDetalleNotaVenta

  public static function guardarDetalleNotaVenta($data)
  {
    try {
      $destinoProducto = 'NV-' . $data['id_factura'];
      $dbh = Conexion::obtenerConexion(); //DELETE FROM tbl_detalletemporal WHERE temp_idusuario=1
      $sql = "INSERT INTO tbl_detallenventa(detanot_cantidad,detanot_preciounitario,
      detanot_descuento,detanot_total,factura_id,producto_id)
      SELECT temp_cantvender,temp_precio,temp_descuento,temp_total,
      :id_factura,temp_idproducto FROM tbl_detalletemporal
      WHERE temp_idusuario=:id_usuario";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_factura", $data["id_factura"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      $sqlkar = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,
      temp_ubica_descripciono,temp_bodegaid_origen,temp_ubica_productoid,
      tem_ubica_cantidad,tem_ubica_usuario,tem_factura_compra)SELECT :destino,temp_descripcionu,temp_bodegaid_o,
      temp_idproducto,temp_cantvender,temp_idusuario,:id_factura FROM tbl_detalletemporal
       WHERE temp_idusuario=:id_usuario;";
      $query2 = $dbh->prepare($sqlkar);
      $query2->bindParam(":destino", $destinoProducto);
      $query2->bindParam(":id_factura", $data["id_factura"]);
      $query2->bindParam(":id_usuario", $data["id_usuario"]);
      $query2->execute();
      if ($query->execute() == true) {
        $sql2 = "DELETE FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
        $query = Conexion::obtenerConexion()->prepare($sql2);
        $query->bindParam(":id_usuario", $data["id_usuario"]);
        $query->execute();
        return true;
      }
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //guardarReserva
  public static function guardarReserva($data)
  {
    try {
      $dbh = Conexion::obtenerConexion();

      $iva=0;
      $sql = "INSERT INTO tbl_reserva(reserva_numero, reserva_fechainicio, reserva_fechafinal, reserva_abono,
      reserva_saldopendiente, reserva_subtotal, reserva_iva, reserva_total,
      vendedor_id,formpago_id, cliente_id, reservas_comprobanteid,emisor_id,reserva_usuario_id)
       VALUES(:reserva_numero,:factura_fechagenerada,:reserva_fechafinal,:reserva_abono,
       :reserva_saldopendiente,:reserva_subtotal,:reserva_iva,:factura_total,:vendedor_id,
       :formpago_id,:cliente_id,:comprobante_id,:emisor_id,:reserva_usuario_id)";
      $query = $dbh->prepare($sql);
      $query->bindParam(":reserva_numero", $data["reserva_numero"]);
      $query->bindParam(":factura_fechagenerada", $data["factura_fechagenerada"]);
      $query->bindParam(":reserva_fechafinal", $data["reserva_fechafinal"]);
      $query->bindParam(":reserva_abono", $data["reserva_abono"]);
      $query->bindParam(":reserva_saldopendiente", $data["reserva_saldopendiente"]);
      $query->bindParam(":reserva_subtotal", $data["factura_subtotal"]);
      $query->bindParam(":reserva_iva", $iva);
      $query->bindParam(":factura_total", $data["factura_total"]);
      $query->bindParam(":vendedor_id", $data["id_vendedor"]);
      $query->bindParam(":formpago_id", $data["forma_id"]);
      $query->bindParam(":cliente_id", $data["id_cliente"]);
      $query->bindParam(":comprobante_id", $data["comprobante_id"]);
      $query->bindParam(":emisor_id", $data["emisor_id"]);
      $query->bindParam(":reserva_usuario_id",$data["id_usuario"]);
      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //guardarDetalleReserva

  public static function guardarDetalleReserva($data)
  {
    try {

      $destinoProducto = 'RESE-' . $data['id_factura'];
      $dbh = Conexion::obtenerConexion(); //DELETE FROM tbl_detalletemporal WHERE temp_idusuario=1

      $sql = "INSERT INTO tbl_detallereserva(detareserv_cantidad,
      detareserv_preciounitario,
      detareserv_descuento,
      detareserv_total,
      reserva_id,producto_id,reserva_bodega_ori,reserva_ubicacion_ori)
      SELECT temp_cantvender,temp_precio,temp_descuento,
      temp_total,:id_factura,temp_idproducto,temp_bodegaid_o,temp_descripcionu
      FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_factura", $data["id_factura"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      $sqlkar = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,
      temp_ubica_descripciono,temp_bodegaid_origen,temp_ubica_productoid,
      tem_ubica_cantidad,tem_ubica_usuario,tem_factura_compra)SELECT :destino,temp_descripcionu,temp_bodegaid_o,
      temp_idproducto,temp_cantvender,temp_idusuario,:id_factura FROM tbl_detalletemporal
       WHERE temp_idusuario=:id_usuario;";
      $query2 = $dbh->prepare($sqlkar);
      $query2->bindParam(":destino", $destinoProducto);
      $query2->bindParam(":id_factura", $data["id_factura"]);
      $query2->bindParam(":id_usuario", $data["id_usuario"]);
      $query2->execute();
      if ($query->execute() == true) {
        $sql2 = "DELETE FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
        $query = Conexion::obtenerConexion()->prepare($sql2);
        $query->bindParam(":id_usuario", $data["id_usuario"]);
        $query->execute();
        return true;
      }
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerProductoById($id)
  {
    try {
      $sql = "SELECT * FROM tbl_producto as p INNER JOIN tbl_codimpu as ci on p.producto_tipo_imp=ci.codimp_id INNER JOIN tbl_tarifaiva as ti on p.producto_porcentaje=ti.tarifaiva_id WHERE p.producto_id=:id_producto";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_producto", $id);
      $query->execute();
      return  $query->fetch(PDO::FETCH_ASSOC);
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
  public static function obtenersumaFactura($id_factura)
  {
    try {
      $sql = "SELECT sum(detafact_cantidad) FROM tbl_detallefactura
      WHERE factura_id=:id_user";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_user", $id_factura);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable  $ex) {
      return $ex->getMessage();
    }
  }
  public static function ingresoComision($data, $id_factura)
  {
    try {
      $dbh = Conexion::obtenerConexion();
      $sql = "INSERT INTO tbl_comision(id_vendedor, valor,if_factura,tipo_comprobante,comision_id_emisor)
      VALUES (:id_vendedor, :valor,:if_factura,:tipo_comprobante,:comision_id_emisor)";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_vendedor", $data['id_vendedor']);
      $query->bindParam(":valor", $data['comision_vende']);
      $query->bindParam(":if_factura", $id_factura);
      $query->bindParam(":tipo_comprobante", $data['comprobante_id']);
      $query->bindParam(":comision_id_emisor",$data['emisor_id']);

      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable  $ex) {
      return $ex->getMessage();
    }
  }
  //todo::para ingreso de datos a la tabla historial
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
  public static function actualizacionReferencia($datos, $id_historial)
  {
    try {
      $sql = "UPDATE tbl_tempubicacion SET tmp_estado='I', tem_idtransaccion =:id_referencia WHERE tem_ubica_id =:tem_ubica_id AND tem_ubica_usuario=:idusuario AND tmp_estado='A'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_referencia", $id_historial);
      $query->bindParam(":tem_ubica_id", $datos["tem_ubica_id"]);
      $query->bindParam(":idusuario", $datos['idusuario']);
      $resultado = $query->execute();
      return $datos;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::proforma
  public static function guardarProforma($data)
  {
    try {
      $dbh = Conexion::obtenerConexion();
      //todo::se debe modificar el emisor ya que esta funcionando como un valor estatico

      $emisor = $data['emisor_id'];
      $iva = 0; //todo no modificar solo el emisor que venga por defecto

      $sql = "INSERT INTO tbl_proforma(proforma_serie,proforma_fechagenerada,proforma_subtotal
      ,proforma_total,proforma_formpago_id,proforma_cliente_id,proforma_comprobante_id,proforma_emisor_id,
      proforma_usuario_id)
       VALUES(:factura_serie,:factura_fechagenerada,:factura_subtotal,:factura_total,
       :formpago_id,:cliente_id,:comprobante_id,:emisor_id,:factura_usuario_id)";
      $query = $dbh->prepare($sql);
      $query->bindParam(":factura_serie", $data["factura_serie"]);
      $query->bindParam(":factura_fechagenerada", $data["factura_fechagenerada"]);
      $query->bindParam(":factura_subtotal", $data["factura_subtotal"]);
      $query->bindParam(":factura_total", $data["factura_total"]);
      $query->bindParam(":formpago_id", $data["forma_id"]);
      $query->bindParam(":cliente_id", $data["id_cliente"]);
      $query->bindParam(":comprobante_id", $data["comprobante_id"]);
      $query->bindParam(":emisor_id", $emisor);
      $query->bindParam(":factura_usuario_id", $data["id_usuario"]);
      $query->execute();
      $id = $dbh->lastInsertId();
      return  $id;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function guardarDetalleProforma($data)
  {
    try {
      $destinoProducto = 'PROF-' . $data['id_factura'];
      $estado = 'A';
      $dbh = Conexion::obtenerConexion(); //DELETE FROM tbl_detalletemporal WHERE temp_idusuario=1
      $sql = "INSERT INTO tbl_detalleproforma(detaprof_cantidad,
      detaprof_preciounitario,detaprof_descuento,detaprof_total,
      proforma_id,producto_id)SELECT
      temp_cantvender,temp_precio,temp_descuento,temp_total,:id_factura,
      temp_idproducto FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
      $query = $dbh->prepare($sql);
      $query->bindParam(":id_factura", $data["id_factura"]);
      $query->bindParam(":id_usuario", $data["id_usuario"]);
      $sqlkar = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,
      temp_ubica_descripciono,temp_bodegaid_origen,temp_ubica_productoid,
      tem_ubica_cantidad,tem_ubica_usuario,tem_factura_compra)SELECT :destino,temp_descripcionu,temp_bodegaid_o,
      temp_idproducto,temp_cantvender,temp_idusuario,:id_factura FROM tbl_detalletemporal
      WHERE temp_idusuario=:id_usuario;";
      $query2 = $dbh->prepare($sqlkar);
      $query2->bindParam(":destino", $destinoProducto);
      $query2->bindParam(":id_factura", $data["id_factura"]);
      $query2->bindParam(":id_usuario", $data["id_usuario"]);
      $query2->execute();
      if ($query->execute() == true) {
        $sql2 = "DELETE FROM tbl_detalletemporal WHERE temp_idusuario=:id_usuario";
        $query = Conexion::obtenerConexion()->prepare($sql2);
        $query->bindParam(":id_usuario", $data["id_usuario"]);
        $query->execute();
        return true;
      }
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
   public static function actualizarSerieProforma($data)
  {
    $serie = $data['factura_serie'] + 1;
    try {
      $sql = "UPDATE tbl_ptoemision SET secuencial_proforma =:serie  WHERE id =:id_ptoestablecimiento
      AND establecimiento_id=:id_establecimiento";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":serie", $serie);
      $query->bindParam(":id_ptoestablecimiento", $data['pto_emision_id']);
      $query->bindParam(":id_establecimiento", $data['id_establecimiento']);
      $query->execute();
      return true;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenersumaProforma($id_factura)
  {
    try {
      $sql = "SELECT sum(detaprof_cantidad) FROM tbl_detalleproforma
      WHERE proforma_id=:id_user";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_user", $id_factura);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable  $ex) {
      return $ex->getMessage();
    }
  }
}
