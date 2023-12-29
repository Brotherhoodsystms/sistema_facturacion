<?php
include dirname(dirname(__FILE__)) . "/config/conexion.php";
class Factura extends Conexion
{
  public static function obtenerFacturas()
  {
    try {
      $sql = "SELECT * FROM tbl_factura f
      JOIN tbl_formapago p ON f.formpago_id = p.formpago_id 
      JOIN tbl_cliente c ON f.cliente_id = c.cliente_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerFacturasActivas($emisor_id)
  {
    try {
      $sql = "SELECT * FROM tbl_factura f
      JOIN tbl_formapago p ON f.formpago_id = p.formpago_id
      JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
      JOIN tbl_emisor as e on e.id=f.emisor_id where f.emisor_id=:emisor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":emisor_id", $emisor_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::los datos para reporte total de facturas
  public static function obtenerFacturaTotal()
  {
    try {
      $sql = "SELECT * FROM tbl_factura as f
      JOIN tbl_formapago  as p ON f.formpago_id = p.formpago_id
      JOIN tbl_cliente as c ON f.cliente_id = c.cliente_id
      JOIN tbl_emisor as e on e.id=f.emisor_id where f.factura_estado!='X'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":emisor_id", $emisor_id);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerFacturasInactivas()
  {
    try {
      $sql = "SELECT * FROM tbl_factura f
      JOIN tbl_formapago p ON f.formpago_id = p.formpago_id
      JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
      WHERE f.factura_estado = 'I'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function ObterFacturaID($id)
  {

    try {
      $sql = "SELECT * FROM tbl_factura as factura INNER JOIN tbl_emisor as emisor on emisor.id=factura.emisor_id INNER JOIN tbl_cliente as cliente on factura.cliente_id=cliente.cliente_id WHERE factura.factura_id=:reserva_numero";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_numero", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function ObtenerDetalleFactura($id_factura)
  {
    try {
      $sql = "SELECT * FROM tbl_detallefactura as detafactura
      INNER JOIN tbl_producto as producto on
      detafactura.producto_id=producto.producto_id
      INNER JOIN tbl_codimpu AS ci on
      ci.codimp_id=producto.producto_tipo_imp
      INNER JOIN tbl_tarifaiva as ti on
      ti.tarifaiva_id=producto.producto_porcentaje
      WHERE detafactura.factura_id=:reserva_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_id", $id_factura);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo::impuestos codigos no repetidos
  public static function obtenerDetalleFacturaImp($id_factura)
  {
    try {
      $sql = "SELECT * FROM tbl_detallefactura as detafactura
      INNER JOIN tbl_producto as producto on
      detafactura.producto_id=producto.producto_id
      INNER JOIN tbl_codimpu AS ci on
      ci.codimp_id=producto.producto_tipo_imp
      INNER JOIN tbl_tarifaiva as ti on
      ti.tarifaiva_id=producto.producto_porcentaje
      INNER JOIN tbl_factura as factura on
      factura.factura_id=detafactura.factura_id
      WHERE detafactura.factura_id=:reserva_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_id", $id_factura);
      $query->execute();
      $datos2 = $query->fetchAll(PDO::FETCH_ASSOC);
      $impuesto = 0.00;
      $result = array();
      foreach ($datos2 as $t) {
        $repeat = false;
        for ($i = 0; $i < count($result); $i++) {
          if ($result[$i]['codimp_codigo'] == $t['codimp_codigo'] && $result[$i]['tarifaiva_codigo'] == $t['tarifaiva_codigo']) {
            $result[$i]['detafact_total'] += $t['detafact_total'];
            $impuesto = ($result[$i]['tarifaiva_porcentaje'] * $result[$i]['detafact_total']) / 100;
            $impuesto = number_format($impuesto, 2, ".", "");
            $result[$i]['impuesto'] = $impuesto;
            $repeat = true;
            break;
          }
        }
        if ($repeat == false) {
          $impuesto = (($t['tarifaiva_porcentaje'] * $t['detafact_total']) / 100);
          $impuesto = number_format($impuesto, 2, ".", "");
          $result[] = array(
            'tarifaiva_codigo' => $t['tarifaiva_codigo'],
            'detafact_total' => $t['detafact_total'],
            'tarifaiva_porcentaje' => $t['tarifaiva_porcentaje'],
            'codimp_codigo' => $t['codimp_codigo'],
            'detafact_total' => $t['detafact_total'],
            'impuesto' => $impuesto
          );
        }
      }
      return $result;
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function  ObterNotaVentaID($id)
  {

    try {
      $sql = "SELECT * FROM tbl_notaventa as notaventa INNER JOIN tbl_cliente as
      cliente on notaventa.cliente_id=cliente.cliente_id INNER JOIN tbl_emisor as emisor
      on notaventa.emisor_id=emisor.id WHERE notaventa.notaventa_id=:reserva_numero";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_numero", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function ObtenerDetalleNotaVenta($id_factura)
  {
    try {
      $sql = "SELECT * FROM tbl_detallenventa as detallenventa INNER JOIN tbl_producto as producto on detallenventa.producto_id=producto.producto_id WHERE factura_id=:reserva_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_id", $id_factura);
      $query->execute();
      return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  //todo::datos para Reporteria
  public static function obtenerFacturaProducto($parametro)
  {
    try {
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerFacturaCliente($parametro)
  {
    try {
      $sql = "SELECT *FROM factura WHERE factura_id=:id_factura";
      $query = Conexion::obtenerConexion()->query($sql);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  public static function obtenerFacturaVendedor($parametro)
  {
  }
  public static function obtenerFacturaNumero($parametro)
  {
  }
  public static function obtenerFacturaFormaPago($parametro)
  {
  }
  //ENLACE A FIRMA ELECTRONICA
  public static function obtenerEmisor($factura_id)
  {
    try {
      $sql = "SELECT * FROM tbl_factura as factura
      INNER JOIN tbl_emisor as emisor on emisor.id=factura.emisor_id
      INNER JOIN tbl_cliente as cliente on factura.cliente_id=cliente.cliente_id
      INNER JOIN tb_tipodocumento as td on td.id_tipdoc=cliente.id_tipodoc
      INNER JOIN tbl_formapago as fp on fp.formpago_id=factura.formpago_id
      WHERE factura.factura_id=:reserva_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_id", $factura_id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }
  //todo datos del establecimiento y el punto de emision deacuerdo a a la bodega
  public static function obtenerBodegaEsta($id_bodega)
  {
    try {
      $sql = "SELECT pte.codigo as codPtemi, esta.* from
      tbl_ptoemision as pte INNER JOIN
      tbl_establecimiento as esta on pte.establecimiento_id=esta.id
      WHERE pte.ptemision_bodegaid=:id_bodega";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":id_bodega", $id_bodega);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizacion de factura enviada y autorizada en la tabla
  public static function actualizacionEstado($id_factura, $estado)
  {
    try {
      $estado = $estado;
      $sql = "UPDATE tbl_factura SET factura_estado=:factura_estado
      WHERE factura_id=:factura_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":factura_estado", $estado);
      $query->bindParam(":factura_id", $id_factura);
      $query->execute();
      return true;
    } catch (Exception $ex) {
      return $ex->getMessage();
    }
  }
  //todo::actualizar factura con clave de acceso e iva 12 y 0actualizarFactura
  public static function actualizarFactura($datos)
  {
    try {
      $sql = "UPDATE tbl_factura SET factura_clave=:factura_clave,
      factura_autorizacion=:factura_autorizacion,factura_base12=:factura_base12,
      factura_iva12=:factura_iva12,
      factura_base0=:factura_base0,
      factura_iva0=:factura_iva0
      WHERE factura_id=:factura_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":factura_clave", $datos['clave_acceso']);
      $query->bindParam(":factura_autorizacion", $datos['clave_acceso']);
      $query->bindParam(":factura_base12", $datos['base_12']);
      $query->bindParam(":factura_iva12", $datos['iva_12']);
      $query->bindParam(":factura_base0", $datos['base_0']);
      $query->bindParam(":factura_iva0", $datos['iva_0']);
      $query->bindParam(":factura_id", $datos['id_factura']);
      $query->execute();
      return true;
    } catch (Exception $ex) {
      return $ex->getMessage();
    }
  }
  //todo::obtener total de descuento
  public static function obtenerTotalDescuento($factura_id){
    try {
      $sql = "SELECT SUM(detafact_descuento) as total FROM tbl_detallefactura WHERE
      factura_id=:factura_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":factura_id", $factura_id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
      return $ex->getMessage();
    }

  }
  //todo::obtener impuesto factura
  public static function obtenerImpuestoTotal($factura_id){
    try {
      $sql = "SELECT factura_iva FROM tbl_factura WHERE
      factura_id=:factura_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":factura_id", $factura_id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $ex) {
      return $ex->getMessage();
    }

  }
  //todo::obtener codigos par la  imprecion de archivos
  public static function obtenerCodigoFactura($id)
  {
    try {
      $sql = "SELECT e.*,es.codigo as cod_esta, pt.codigo as cod_pto FROM tbl_emisor as e INNER JOIN tbl_establecimiento as es on es.emisor_id=e.id
INNER JOIN tbl_ptoemision as pt on pt.establecimiento_id=es.id WHERE e.id=:reserva_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":reserva_id", $id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $ex) {
      return $ex->getMessage();
    }
  }
  //todo::para anular la factura solo el estado de factura anulada
  public static function anularFactura($id){
    try {
      $sql = "UPDATE tbl_factura SET factura_estado='X' WHERE factura_id=:factura_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":factura_id", $id);
      $query->execute();
      return true;
    } catch (\Exception $ex) {
      return $ex->getMessage();
    }
  }
  //todo::sobre Proforma
  public static function ObterProformaID($id)
    {
        try {
            $sql = "SELECT * FROM tbl_proforma as proforma INNER JOIN tbl_emisor as emisor
        on emisor.id=proforma.proforma_emisor_id
        INNER JOIN tbl_cliente as cliente on proforma.proforma_cliente_id=cliente.cliente_id
        WHERE proforma.proforma_id=:proforma_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':proforma_id', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function ObtenerDetalleProforma($id)
    {
        try {
            $sql = "SELECT * FROM tbl_detalleproforma as detalleProforma
            INNER JOIN tbl_producto as producto on detalleProforma.producto_id=producto.producto_id
            WHERE detalleProforma.proforma_id=:proforma_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':proforma_id', $id);
            $query->execute();
            return $query->fetchall(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerCodigoEsta($id)
    {
      try {
        $sql = "SELECT e.*,es.codigo as cod_esta, pt.codigo as cod_pto FROM tbl_emisor as e
    INNER JOIN tbl_establecimiento as es on es.emisor_id=e.id
    INNER JOIN tbl_ptoemision as pt on pt.establecimiento_id=es.id WHERE e.id=:emisor_id"; /*  */
        $query = Conexion::obtenerConexion()->prepare($sql);
        $query->bindParam(':emisor_id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Exception $ex) {
        return $ex->getMessage();
    }
    }
}
