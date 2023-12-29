<?php
include dirname(dirname(__FILE__)) . '/config/conexion.php';
class Reserva extends Conexion
{
    public static function obtenerReserva($emisor_id)
    {
        try {
            $sql =
                'SELECT * FROM tbl_reserva r JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
                JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
                JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
                WHERE r.emisor_id=:emisor_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerReservaProducto($parametro)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
            JOIN tbl_producto p ON r.producto_id = p.producto_id
            JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
            JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
            JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
            WHERE p.producto_codigoserial =:producto_codigoserial";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':producto_codigoserial', $parametro);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerReservaCliente($parametro)
    {
        try {
            $sql =
            'SELECT * FROM tbl_reserva r JOIN tbl_cliente c ON r.cliente_id = c.cliente_id JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id JOIN tbl_formapago g ON r.formpago_id = g.formpago_id WHERE c.cliente_ruc =:cliente_ruc';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':cliente_ruc', $parametro);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    public static function obtenerReservaVendedor($parametro)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
            JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
            JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
            JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
            WHERE v.vendedor_dni=:vendedor_dni";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':vendedor_dni', $parametro);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    public static function obtenerReservaNumero($parametro)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
            JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
            JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
            JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
      WHERE r.reserva_numero=:reserva_numero";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_numero', $parametro);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::reserva id
    public static function obtenerReservaProductoId($parametro)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
      WHERE r.reserva_id =:reserva_numero";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_numero', $parametro);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //donde suma el valor del abono
    public static function actualizarReservaAbono($data)
    {
        $dato_reserva = Reserva::obtenerReservaProductoId($data['reserva_id']);
        $abono = $data['valor_abonar'] + $dato_reserva['reserva_abono'];
        $saldo_pendiente = $dato_reserva['reserva_total'] - $abono;
        try {
            $sql =
                'UPDATE tbl_reserva SET reserva_abono=:reserva_abono,reserva_saldopendiente=:saldo_pendiente WHERE reserva_id=:reserva_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_abono', $abono);
            $query->bindParam(':saldo_pendiente', $saldo_pendiente);
            $query->bindParam(':reserva_id', $data['reserva_id']);
            $query->execute();
            return true;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerReservaFormaPago($parametro)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
            JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
            JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
            JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
            WHERE g.formpago_descripcion  =:formpago_descripcion";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':formpago_descripcion', $parametro);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    //todo::

    public static function obtenerReservaFecha($fecha_i, $fecha_f)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
            JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
            JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
            JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
            WHERE r.reserva_fechainicio>= :reserva_fechainicio AND r.reserva_fechainicio <= :reserva_fechafinal";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    public static function guardarReserva($data)
    {
        try {
            $sql =
                'INSERT INTO tbl_reserva (reserva_numero,reserva_fechainicio,reserva_fechafinal,reserva_cantidad,reserva_comision,reserva_abono,reserva_saldopendiente,reserva_total,vendedor_id,formpago_id,cliente_id,producto_id) VALUES(:reserva_numero,:reserva_fechainicio,:reserva_fechafinal,:reserva_cantidad,:reserva_comision,:reserva_abono,:reserva_saldopendiente,:reserva_total,:vendedor_id,:formpago_id,:cliente_id,:producto_id)';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_numero', $data['reserva_numero']);
            $query->bindParam(
                ':reserva_fechainicio',
                $data['reserva_fechainicio']
            );
            $query->bindParam(
                ':reserva_fechafinal',
                $data['reserva_fechafinal']
            );
            $query->bindParam(':reserva_cantidad', $data['reserva_cantidad']);
            $query->bindParam(':reserva_comision', $data['reserva_comision']);
            $query->bindParam(':reserva_abono', $data['reserva_abono']);
            $query->bindParam(
                ':reserva_saldopendiente',
                $data['reserva_saldopendiente']
            );
            $query->bindParam(':reserva_total', $data['reserva_total']);
            $query->bindParam(':vendedor_id', $data['vendedor_id']);
            $query->bindParam(':formpago_id', $data['formpago_id']);
            $query->bindParam(':cliente_id', $data['cliente_id']);
            $query->bindParam(':producto_id', $data['producto_id']);
            $query->execute();
            return true;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function actualizarProductoStockId($id, $stock)
    {
        try {
            $sql =
            'UPDATE tbl_producto SET producto_stock=:producto_stock WHERE producto_id=:producto_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':producto_stock', $stock);
            $query->bindParam(':producto_id', $id);
            $query->execute();
            return true;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function eliminarReserva($id)
    {
        try {
            $sql = 'DELETE FROM tbl_reserva WHERE reserva_id=:reserva_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_id', $id);
            $query->execute();
            return true;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::respecto a facturar la reserva desde el ingreso de la factura  hasta el detalle de la impresion
    //todo::detalle de la factura recordar que el emisor va a darnos el secuencial para la factura
    public static function obtenerSecuencial($id)
    {
        try {
            $sql = "SELECT pe.* FROM tbl_reserva as r INNER JOIN
            tbl_establecimiento as es on es.emisor_id=r.emisor_id
            INNER JOIN tbl_ptoemision as pe on pe.establecimiento_id=es.id
            WHERE r.reserva_id=:reserva_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_id', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    public static function guardarFactura($data)
    {
        try {
            $dbh = Conexion::obtenerConexion();

            $iva = 0;
            $fecha = date('Y-m-d');
            $reserva_comprobanteid = 1;
            $sql = "INSERT INTO tbl_factura(factura_serie,factura_fechagenerada,factura_subtotal,
            factura_iva,factura_total,formpago_id,cliente_id,comprobante_id,emisor_id,factura_usuario_id)
            SELECT :secuencialFactura,:fecha,reserva_subtotal,:iva,reserva_total,formpago_id,cliente_id,:reserva_comprobanteid,
            emisor_id,reserva_usuario_id
            FROM tbl_reserva WHERE reserva_id=:reserva_numero";
            $query = $dbh->prepare($sql);
            $query->bindParam(':secuencialFactura', $data['secuencialFactura']);
            $query->bindParam(':fecha', $fecha);
            $query->bindParam(':iva', $iva);
            $query->bindParam(':reserva_comprobanteid', $reserva_comprobanteid);
            $query->bindParam(':reserva_numero', $data['id_reserva']);
            $query->execute();
            $id = $dbh->lastInsertId();
            return $id;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    public static function guardarDetalleFactura($data)
    {
        try {
            $destinoProducto = 'FACT-' . $data['id_factura'];
            $estado = 'A';
            $dbh = Conexion::obtenerConexion(); //DELETE FROM tbl_detalletemporal WHERE temp_idusuario=1
            $sql = "INSERT INTO tbl_detallefactura(detafact_cantidad,
            detafact_preciounitario,detafact_descuento,detafact_total,
            factura_id,producto_id)SELECT
            detareserv_cantidad,detareserv_preciounitario,detareserv_descuento,detareserv_total,:id_factura,
            producto_id FROM tbl_detallereserva WHERE reserva_id=:id_reserva";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id_factura', $data['id_factura']);
            $query->bindParam(':id_reserva', $data['id_reserva']);
            $sqlkar = "INSERT INTO tbl_tempubicacion(tem_ubica_descripcion,temp_ubica_descripciono,temp_bodegaid_origen
          ,temp_ubica_productoid,tem_ubica_cantidad,tem_ubica_usuario,tem_factura_compra)SELECT :destino,reserva_ubicacion_ori,reserva_bodega_ori,
          producto_id,detareserv_cantidad,:id_usuario,:id_factura FROM tbl_detallereserva
           WHERE reserva_id=:id_reserva;";
            $query2 = $dbh->prepare($sqlkar);
            $query2->bindParam(':destino', $destinoProducto);
            $query2->bindParam(':id_factura', $data['id_factura']);
            $query2->bindParam(':id_usuario', $data['id_usuario']);
            $query2->bindParam(':id_reserva', $data['id_reserva']);
            $query2->execute();

            if ($query->execute() == true) {
                //todo::modificar para que la reserva cambie de estado a inactivo tener en cuenta que es una
                //todo::tabla relacional
                $sql2 =
                    'DELETE FROM tbl_detallereserva WHERE reserva_id=:id_reserva';
                $query = Conexion::obtenerConexion()->prepare($sql2);
                $query->bindParam(':id_reserva', $data['id_reserva']);
                $query->execute();
                return true;
            }
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::actualizarSerieFactura
    public static function actualizarSerieFactura($data)
    {
        $serie = $data['factura_serie'] + 1;
        try {
            $sql =
                'UPDATE tbl_ptoemision SET secuencialFactura =:serie  WHERE id = :id_ptoestablecimiento AND establecimiento_id=:id_establecimiento';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':serie', $serie);
            $query->bindParam(
                ':id_ptoestablecimiento',
                $data['pto_emision_id']
            );
            $query->bindParam(
                ':id_establecimiento',
                $data['id_establecimiento']
            );
            $query->execute();
            return true;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenersumaFactura($id_factura)
    {
        try {
            $sql =
                'SELECT factura_total FROM tbl_factura WHERE factura_id=:id_user';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':id_user', $id_factura);
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
            $query->bindParam(':accion', $datos['accion']);
            $query->bindParam('idtransaccion', $datos['idtransaccion']);
            $query->bindParam('usuario', $datos['usuario']);
            $query->execute();
            $id = $dbh->lastInsertId();
            return $id;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::para ingreso de datos a la tabla historial
    public static function obtenerUbicacionesTemporal($datos)
    {
        try {
            $sql =
                "SELECT * FROM tbl_tempubicacion WHERE tem_ubica_usuario=:id_usuario AND tmp_estado='A'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':id_usuario', $datos);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function actualizacionReferencia($datos, $id_historial)
    {
        try {
            $sql =
                "UPDATE tbl_tempubicacion SET tmp_estado='I', tem_idtransaccion =:id_referencia WHERE tem_ubica_id =:tem_ubica_id AND tem_ubica_usuario=:idusuario AND tmp_estado='A'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':id_referencia', $id_historial);
            $query->bindParam(':tem_ubica_id', $datos['tem_ubica_id']);
            $query->bindParam(':idusuario', $datos['idusuario']);
            $resultado = $query->execute();
            return $datos;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    //todo::para eliminar los detalles de la reserva y que regrese a stock
    public static function ontenerDetalleReserva($id_reserva)
    {
        try {
            $sql =
                'SELECT * FROM `tbl_detallereserva` WHERE reserva_id=:id_reserva';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':id_reserva', $id_reserva);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $echo) {
            echo $echo->getMessage();
        }
    }
    public static function obtenerUbicacionReserva($data)
    {
        try {
            $sql = "SELECT * FROM tbl_ubicacion WHERE ubicacion_descripcion=:ubicacion_descripcion
      AND bodega_id=:bodega_id AND producto_id=:producto_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(
                ':ubicacion_descripcion',
                $data['reserva_ubicacion_ori']
            );
            $query->bindParam(':bodega_id', $data['reserva_bodega_ori']);
            $query->bindParam(':producto_id', $data['producto_id']);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    } /*  */
    public static function actualizarUbicacion($data)
    {
        try {
            $sql ='UPDATE tbl_ubicacion SET ubicacion_cantidad=:ubicacion_cantidad
            WHERE ubicacion_descripcion=:ubicacion AND bodega_id=:bodega_id AND producto_id=:producto_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':ubicacion_cantidad',$data['cantidad']);
            $query->bindParam(':ubicacion',$data['ubicacion']);
            $query->bindParam(':bodega_id', $data['bodega_id']);
            $query->bindParam(':producto_id', $data['producto_id']);
            $query->execute();
            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    public static function eliminarDetalleReserva($id)
    {
        try {
            $sql = 'DELETE FROM tbl_detallereserva WHERE detareserv_id=:detareserv_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':detareserv_id', $id);
            $query->execute();
            return true;
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

}
