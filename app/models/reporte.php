<?php
include dirname(dirname(__FILE__)) . '/config/conexion.php';
/**
* Consultas de modulo de Reporte
*
* @return boolean true si la direccion es correcta
* @param string $email direccion de correo
*/

class Reporte extends Conexion
{
    public static function obtenerReserva()
    {
        try {
            $sql =
                'SELECT * FROM tbl_reserva r JOIN tbl_cliente c ON r.cliente_id = c.cliente_id JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id JOIN tbl_formapago g ON r.formpago_id = g.formpago_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
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
    //todo::facturas por cliente /obtenerTotalFacturaCliente
    public static function obtenerFacturaCliente($parametro,$sucursal)
    {
        try {
            $sql ='SELECT * FROM tbl_factura f JOIN tbl_cliente c
            ON f.cliente_id = c.cliente_id JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            JOIN tbl_comprobante as com on com.comprobante_id=f.comprobante_id
            JOIN tbl_emisor as e on e.id=f.emisor_id
            WHERE c.cliente_ruc=:cliente_ruc AND f.emisor_id=:emisor_id AND f.factura_estado!="X"';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':cliente_ruc', $parametro);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalFacturaCliente($parametro,$sucursal)
    {
        try {
            $sql ='SELECT SUM(f.factura_total) as total FROM tbl_factura f JOIN tbl_cliente c
            ON f.cliente_id = c.cliente_id JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            JOIN tbl_comprobante as com on com.comprobante_id=f.comprobante_id
            JOIN tbl_emisor as e on e.id=f.emisor_id
            WHERE c.cliente_ruc=:cliente_ruc AND f.emisor_id=:emisor_id AND f.factura_estado!="X"';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':cliente_ruc', $parametro);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::listado de facturas totales por clientes
    //todo::se debe modificar para que nos traiga solo los datos especificos 
    public static function obtenerFacturaClienteTotal($parametro,$sucursal)
    {
        try {
            $sql ='SELECT * FROM tbl_factura as f
            JOIN tbl_formapago  as p ON f.formpago_id = p.formpago_id
            JOIN tbl_cliente as c ON f.cliente_id = c.cliente_id
            JOIN tbl_emisor as e on e.id=f.emisor_id where f.factura_estado!="X" AND c.cliente_ruc=:cliente_ruc AND f.emisor_id=:emisor_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':cliente_ruc', $parametro);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerFacturaClienteTotals($parametro,$sucursal)
    {
        try {
            $sql ='SELECT SUM(f.factura_total)as total, SUM(f.factura_base12) as base12, SUM(f.factura_iva12)as iva12, SUM(f.factura_base0)as base0
            FROM tbl_factura as f JOIN tbl_formapago as p ON f.formpago_id = p.formpago_id
            JOIN tbl_cliente as c ON f.cliente_id = c.cliente_id JOIN tbl_emisor as e on e.id=f.emisor_id
            where f.factura_estado!="X" AND c.cliente_ruc=:cliente_ruc AND f.emisor_id=:emisor_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':cliente_ruc', $parametro);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::reservas por cliente
    public static function obtenerReservaCliente($parametro)
    {
        try {
            $sql ='SELECT * FROM tbl_reserva r JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
            JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id JOIN tbl_formapago g ON
            r.formpago_id = g.formpago_id WHERE c.cliente_ruc =:cliente_ruc';
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
    //todo::por numero de factura
    public static function obtenerFacturaNumero($parametro,$emisor_id)
    {
        try {
            $sql = "SELECT * FROM tbl_factura f JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id WHERE f.factura_serie=:reserva_numero
            AND f.emisor_id =:emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_numero', $parametro);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerFacturaNumeroSuma($parametro,$sucursal){
        try {
            $sql = "SELECT SUM(f.factura_total)as total, SUM(f.factura_base12) as base12, SUM(f.factura_iva12)as iva12, SUM(f.factura_base0)as base0
            FROM tbl_factura f JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id WHERE f.factura_serie=:reserva_numero
            AND f.emisor_id =:emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_numero', $parametro);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }

    }
    //todo::por numor de reserva 
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
    //todo::obtener valores de forma de pago total
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

    //todo::obtenerFacturaFecha //obtenerTotalReservaFecha
    public static function obtenerReservaFecha($fecha_i, $fecha_f,$id_emisor)
    {
        try {
            $sql = "SELECT * FROM tbl_reserva r
      JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
      JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
      JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
      JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
      JOIN tbl_emisor e on e.id=r.emisor_id
      WHERE r.reserva_fechainicio>= :reserva_fechainicio AND r.reserva_fechainicio <= :reserva_fechafinal
      AND r.emisor_id=:id_emisor";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':id_emisor', $id_emisor);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalReservaFecha($fecha_i, $fecha_f,$id_emisor)
    {
        try {
            $sql = "SELECT SUM(r.reserva_total) as total FROM tbl_reserva r
      JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
      JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
      JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
      JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
      WHERE r.reserva_fechainicio>= :reserva_fechainicio AND r.reserva_fechainicio <= :reserva_fechafinal
      AND r.emisor_id=:id_emisor";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':id_emisor', $id_emisor);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::obtener factura detalle por emisor /obtenerTotalVentasFecha
    public static function obtenerFacturaFecha($fecha_i, $fecha_f,$emisor_id)
    {
        try {
            $sql = "SELECT * FROM tbl_factura f
            JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            join tbl_comprobante as com on com.comprobante_id=f.comprobante_id
            JOIN tbl_emisor as e on e.id=f.emisor_id
      WHERE f.factura_fechagenerada>= :reserva_fechainicio
      AND f.factura_fechagenerada <= :reserva_fechafinal AND f.emisor_id = :emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalVentasFecha($fecha_i, $fecha_f,$emisor_id)
    {
        try {
            $sql = "SELECT SUM(f.factura_total)as total FROM tbl_factura f
            JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            JOIN tbl_comprobante as com on com.comprobante_id=f.comprobante_id
            JOIN tbl_emisor as e on e.id=f.emisor_id
      WHERE f.factura_fechagenerada >= :reserva_fechainicio
      AND f.factura_fechagenerada <= :reserva_fechafinal AND f.emisor_id = :emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerFacturaFechaS($fecha_i, $fecha_f,$emisor_id)
    {
        try {
            $sql = "SELECT SUM(f.factura_total)as total, SUM(f.factura_base12) as base12, SUM(f.factura_iva12)as iva12, SUM(f.factura_base0)as base0
            FROM tbl_factura f
            JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            join tbl_comprobante as com on com.comprobante_id=f.comprobante_id
      WHERE f.factura_fechagenerada>= :reserva_fechainicio
      AND f.factura_fechagenerada <= :reserva_fechafinal AND f.emisor_id = :emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::obtener factura total detalle /
    public static function obtenerFacturaFechaTotal($fecha_i, $fecha_f,$emisor_id)
    {
        try {
            $sql = "SELECT * FROM tbl_factura f
            JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            JOIN tbl_comprobante as com on com.comprobante_id=f.comprobante_id
            JOIN tbl_emisor as e on e.id=f.emisor_id
      WHERE f.factura_fechagenerada>= :reserva_fechainicio
      AND f.factura_fechagenerada <= :reserva_fechafinal AND f.emisor_id=:emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerFacturaFechaTotalS($fecha_i, $fecha_f,$sucursal)
    {
        try {
            $sql = "SELECT SUM(f.factura_total)as total, SUM(f.factura_base12) as base12, SUM(f.factura_iva12)as iva12, SUM(f.factura_base0)as base0
            FROM tbl_factura f
            JOIN tbl_cliente c ON f.cliente_id = c.cliente_id
            JOIN tbl_formapago g ON f.formpago_id = g.formpago_id
            JOIN tbl_comprobante as com on com.comprobante_id=f.comprobante_id
            JOIN tbl_emisor as e on e.id=f.emisor_id
      WHERE f.factura_fechagenerada>= :reserva_fechainicio
      AND f.factura_fechagenerada <= :reserva_fechafinal AND f.emisor_id=:emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':reserva_fechainicio', $fecha_i);
            $query->bindParam(':reserva_fechafinal', $fecha_f);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::para la reporteria de Ventas /obtenerTotalFacturasA
    public static function obtenerFacturasActivas($emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_factura as f JOIN tbl_formapago as fp on fp.formpago_id=f.formpago_id
                JOIN tbl_cliente as c on c.cliente_id=f.cliente_id JOIN
                tbl_comprobante as com on com.comprobante_id=f.comprobante_id
                JOIN tbl_emisor as e on e.id=f.emisor_id WHERE  f.factura_estado!='X' AND f.emisor_id =:emisor_id ";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }

    public static function obtenerTotalFacturasA($emisor_id){
        try {
            $sql =
                "SELECT SUM(f.factura_total)as total FROM tbl_factura as f JOIN tbl_formapago as fp on fp.formpago_id=f.formpago_id
                JOIN tbl_cliente as c on c.cliente_id=f.cliente_id JOIN
                tbl_comprobante as com on com.comprobante_id=f.comprobante_id
                JOIN tbl_emisor as e on e.id=f.emisor_id WHERE  f.factura_estado!='X'";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function comprobante_salida($emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id
                JOIN tbl_emisor as e on e.id=n.emisor_id ";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComproA($emisor_id){
        try {
            $sql =
                "SELECT SUM(n.notaventa_total) as total FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id
                JOIN tbl_emisor as e on e.id=n.emisor_id ";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerReservas($emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id JOIN tbl_emisor as e
                on e.id=r.emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotolReser($emisor_id){
        try {
            $sql =
                "SELECT SUM(r.reserva_total) as total FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id JOIN tbl_emisor as e
                on e.id=r.emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::cliente  
    public static function comprobante_salidaCliente($cliente,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id WHERE n.emisor_id=:emisor_id
                AND c.cliente_ruc=:ruc_cliente";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':ruc_cliente', $cliente);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComprobanteCliente($cliente,$emisor_id){
        try {
            $sql =
                "SELECT SUM(n.notaventa_total) as total FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id WHERE n.emisor_id=:emisor_id
                AND c.cliente_ruc=:ruc_cliente";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':ruc_cliente', $cliente);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::reerva 
    public static function obtenerReservasCliente($cliente,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id WHERE r.emisor_id=:emisor_id
                AND c.cliente_ruc=:ruc_cliente";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':ruc_cliente', $cliente);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenertTotalReserva($cliente,$emisor_id){
        try {
            $sql =
                "SELECT SUM(reserva_total) as total FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id WHERE r.emisor_id=:emisor_id
                AND c.cliente_ruc=:ruc_cliente";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':ruc_cliente', $cliente);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::por fecha /
    public static function obtenerComprobante_salidaFecha($fechai,$fechaf,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_notaventa as n
                JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id
                JOIN tbl_formapago  as fp on fp.formpago_id=n.formpago_id
                JOIN tbl_emisor as e on e.id=n.emisor_id WHERE n.emisor_id=:emisor_id
                AND n.notaventa_fechagenerada>=:fechai AND n.notaventa_fechagenerada<=:fechaf";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':fechai', $fechai);
            $query->bindParam(':fechaf', $fechaf);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComproFecha($fechai,$fechaf,$emisor_id){
        try {
            $sql =
                "SELECT SUM(n.notaventa_total) as total FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id  JOIN tbl_emisor as e on e.id=n.emisor_id WHERE n.emisor_id=:emisor_id
                AND n.notaventa_fechagenerada>=:fechai AND n.notaventa_fechagenerada<=:fechaf";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':fechai', $fechai);
            $query->bindParam(':fechaf', $fechaf);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo:::por forma de pago /obtenerTotalFormaPagF
    public static function obtenerFacturaFormapago($forma_pago,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_factura as f JOIN tbl_formapago as fp on fp.formpago_id=f.formpago_id
                JOIN tbl_cliente as c on c.cliente_id=f.cliente_id JOIN
                tbl_comprobante as com on com.comprobante_id=f.comprobante_id
                JOIN tbl_emisor as e on e.id=f.emisor_id WHERE f.emisor_id =:emisor_id
                AND f.factura_estado!='X' AND f.formpago_id=:forma_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalFormaPagF($forma_pago,$emisor_id){
        try {
            $sql =
                "SELECT SUM(f.factura_total) as total FROM tbl_factura as f JOIN tbl_formapago as fp on fp.formpago_id=f.formpago_id
                JOIN tbl_cliente as c on c.cliente_id=f.cliente_id JOIN
                tbl_comprobante as com on com.comprobante_id=f.comprobante_id
                JOIN tbl_emisor as e on e.id=f.emisor_id WHERE f.emisor_id =:emisor_id
                AND f.factura_estado!='X' AND f.formpago_id=:forma_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::comprobande de salida por  forma de pago //obtenerTotalcomproForma
    public static function comprobante_salidaFormapago($forma_pago,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id WHERE n.emisor_id=:emisor_id JOIN tbl_emisor as e
                on e.id=n.emisor_id AND n.formpago_id=:forma_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalcomproForma($forma_pago,$emisor_id){
        try{
            $sql =
                "SELECT SUM(n.notaventa_total)as total FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id JOIN tbl_emisor as e
                on e.id=n.emisor_id WHERE n.emisor_id=:emisor_id  AND n.formpago_id=:forma_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);

        }catch(\Throwable $ex){
            return $ex->getMessage();
        }
    }
    //todo::obtenerTotalResFor
    public static function obtenerReservasFormapago($forma_pago,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id
                JOIN tbl_emisor as e on e.id=r.emisor_id WHERE r.emisor_id=:emisor_id
                AND r.formpago_id=:forma_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalResFor($forma_pago,$emisor_id){
        try {
            $sql =
                "SELECT SUM(r.reserva_total)as total FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id
                JOIN tbl_emisor as e on e.id=r.emisor_id WHERE r.emisor_id=:emisor_id
                AND r.formpago_id=:forma_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':forma_pago', $forma_pago);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::por tipo de comprobante /obtenertotalFacturaTC
    public static function obtenerFacturaTipoComprobante($tipoComprobante,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_factura as f JOIN tbl_formapago as fp on fp.formpago_id=f.formpago_id
                JOIN tbl_cliente as c on c.cliente_id=f.cliente_id JOIN
                tbl_comprobante as com on com.comprobante_id=f.comprobante_id WHERE f.emisor_id =:emisor_id
                AND f.factura_estado!='X' AND f.comprobante_id=:tipo_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':tipo_pago', $tipoComprobante);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenertotalFacturaTC($tipoComprobante,$emisor_id){
        try {
            $sql =
                "SELECT SUM(f.factura_total) as total FROM tbl_factura as f JOIN tbl_formapago as fp on fp.formpago_id=f.formpago_id
                JOIN tbl_cliente as c on c.cliente_id=f.cliente_id JOIN
                tbl_comprobante as com on com.comprobante_id=f.comprobante_id WHERE f.emisor_id =:emisor_id
                AND f.factura_estado!='X' AND f.comprobante_id=:tipo_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':tipo_pago', $tipoComprobante);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::comprobante obtenerComprTC

    public static function comprobante_salidaTipoComprobante($tipoComprobante,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id WHERE n.emisor_id=:emisor_id AND n.comprobante_id=:tipo_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':tipo_pago', $tipoComprobante);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerComprTC($tipoComprobante,$emisor_id){
        try {
            $sql =
                "SELECT SUM(n.notaventa_total) as total FROM tbl_notaventa as n JOIN tbl_cliente as c on c.cliente_id=n.cliente_id
                JOIN tbl_comprobante as com on com.comprobante_id=n.comprobante_id JOIN tbl_formapago
                as fp on fp.formpago_id=n.formpago_id WHERE n.emisor_id=:emisor_id AND n.comprobante_id=:tipo_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':tipo_pago', $tipoComprobante);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::
    public static function obtenerReservasTipoComprobante($tipoComprobante,$emisor_id){
        try {
            $sql =
                "SELECT * FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id WHERE r.emisor_id=:emisor_id
                AND r.reservas_comprobanteid=:tipo_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':tipo_pago', $tipoComprobante);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalResTC($tipoComprobante,$emisor_id){
        try {
            $sql =
                "SELECT SUM(r.reserva_total) as total FROM tbl_reserva as r JOIN tbl_cliente as c on c.cliente_id=r.cliente_id
                JOIN tbl_comprobante as comp on comp.comprobante_id=r.reservas_comprobanteid
                JOIN tbl_formapago as fp on fp.formpago_id=r.formpago_id WHERE r.emisor_id=:emisor_id
                AND r.reservas_comprobanteid=:tipo_pago";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->bindParam(':tipo_pago', $tipoComprobante);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
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
    public static function obtenerTotalFacurasAdm()
  {
    try {
      $sql = "SELECT SUM(f.factura_total)as total, SUM(f.factura_base12) as base12, SUM(f.factura_iva12)as iva12, SUM(f.factura_base0)as base0
      FROM tbl_factura as f
      JOIN tbl_formapago  as p ON f.formpago_id = p.formpago_id
      JOIN tbl_cliente as c ON f.cliente_id = c.cliente_id
      JOIN tbl_emisor as e on e.id=f.emisor_id where f.factura_estado!='X'";
      $query = Conexion::obtenerConexion()->prepare($sql);
      //$query->bindParam(":emisor_id", $emisor_id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

  public static function obtenerTotalFacurasUsuario($emisor_id)
  {
    try {
      $sql = "SELECT SUM(f.factura_total)as total, SUM(f.factura_base12) as base12, SUM(f.factura_iva12)as iva12, SUM(f.factura_base0)as base0
      FROM tbl_factura as f
      JOIN tbl_formapago  as p ON f.formpago_id = p.formpago_id
      JOIN tbl_cliente as c ON f.cliente_id = c.cliente_id
      JOIN tbl_emisor as e on e.id=f.emisor_id where f.factura_estado!='X' AND f.emisor_id=:emisor_id";
      $query = Conexion::obtenerConexion()->prepare($sql);
      $query->bindParam(":emisor_id", $emisor_id);
      $query->execute();
      return $query->fetch(PDO::FETCH_ASSOC);
    } catch (\Throwable $ex) {
      return $ex->getMessage();
    }
  }

    //todo::reporte de comisiones
    public static function obtenerComisiones($emisor_id){
        try {
            $sql =
                "SELECT c.id_comision,c.valor, c.fecha_ingreso,s.nombreComercial,f.factura_serie,
                v.vendedor_nombres,v.vendedor_dni,comp.comprobante_descripcion FROM tbl_comision as c JOIN
                tbl_vendedor as v on v.vendedor_id=c.id_vendedor JOIN tbl_factura as f on
                f.factura_id=c.if_factura JOIN tbl_comprobante as comp on
                comp.comprobante_id=c.tipo_comprobante JOIN tbl_emisor as s on
                s.id=c.comision_id_emisor where c.valor>0";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComisiones(){
        try {
            $sql =
                "SELECT SUM(c.valor) as total FROM tbl_comision as c JOIN
                tbl_vendedor as v on v.vendedor_id=c.id_vendedor JOIN tbl_factura as f on
                f.factura_id=c.if_factura JOIN tbl_comprobante as comp on
                comp.comprobante_id=c.tipo_comprobante JOIN tbl_emisor as s on
                s.id=c.comision_id_emisor where c.valor>0";
            $query = Conexion::obtenerConexion()->prepare($sql);
            //$query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerComisionVendedor($ruc_cliente,$sucursal){
        try {
            $sql="SELECT c.id_comision, c.valor,c.fecha_ingreso,f.factura_serie,
            v.vendedor_nombres,v.vendedor_dni,e.nombreComercial, com.comprobante_descripcion
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE v.vendedor_dni=:ruc_vendedor AND c.comision_id_emisor=:emisor_id
            AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':ruc_vendedor', $ruc_cliente);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalVendedor($ruc_cliente,$sucursal){
        try {
            $sql="SELECT SUM(c.valor) as total
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE v.vendedor_dni=:ruc_vendedor AND c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':ruc_vendedor', $ruc_cliente);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerComisionFactura($num_factura,$sucursal){
        try {
            $sql="SELECT c.id_comision, c.valor,c.fecha_ingreso,f.factura_serie,
            v.vendedor_nombres,v.vendedor_dni,e.nombreComercial, com.comprobante_descripcion
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE f.factura_serie=:num_factura AND c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':num_factura', $num_factura);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalFactura($num_factura,$sucursal){
        try {
            $sql="SELECT SUM(c.valor) as total
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE f.factura_serie=:num_factura AND c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':num_factura', $num_factura);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerComisionSucursal($emisor_id){
        try {
            $sql="SELECT c.id_comision, c.valor,c.fecha_ingreso,f.factura_serie,
            v.vendedor_nombres,v.vendedor_dni,e.nombreComercial, com.comprobante_descripcion
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalSucursal($emisor_id){
        try {
            $sql="SELECT SUM(c.valor) as total
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerComisionComprobante($comprobante_id,$sucursal){
        try {
            $sql="SELECT c.id_comision, c.valor,c.fecha_ingreso,f.factura_serie,
            v.vendedor_nombres,v.vendedor_dni,e.nombreComercial, com.comprobante_descripcion
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE c.tipo_comprobante=:comprobante_id AND c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':comprobante_id', $comprobante_id);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalComprobante($comprobante_id,$sucursal){
        try {
            $sql="SELECT SUM(c.valor) as total
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE c.tipo_comprobante=:comprobante_id AND c.comision_id_emisor=:emisor_id AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':comprobante_id', $comprobante_id);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerComisionFecha($fecha_i,$fecha_f,$sucursal){
        try {
            $sql="SELECT c.id_comision, c.valor,c.fecha_ingreso,f.factura_serie,
            v.vendedor_nombres,v.vendedor_dni,e.nombreComercial, com.comprobante_descripcion FROM
            tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor JOIN
            tbl_emisor as e on e.id=c.comision_id_emisor JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante JOIN tbl_factura as f on f.factura_id=c.if_factura
            WHERE c.fecha_ingreso>:fecha_i AND c.comision_id_emisor=:emisor_id AND c.fecha_ingreso<:fecha_f
            AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':fecha_i', $fecha_i);
            $query->bindParam(':emisor_id', $sucursal);
            $query->bindParam(':fecha_f', $fecha_f);
             $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalFecha($fecha_i,$fecha_f,$sucursal){
        try {
            $sql="SELECT SUM(c.valor) as total
            FROM tbl_comision as c JOIN tbl_vendedor as v on v.vendedor_id=c.id_vendedor
            JOIN tbl_emisor as e on e.id=c.comision_id_emisor  JOIN tbl_comprobante as com on
            com.comprobante_id=c.tipo_comprobante  JOIN tbl_factura as f on
            f.factura_id=c.if_factura WHERE c.fecha_ingreso>:fecha_i  AND c.comision_id_emisor=:emisor_id AND c.fecha_ingreso<:fecha_f AND c.valor >0";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':fecha_i', $fecha_i);
            $query->bindParam(':emisor_id', $sucursal);
            $query->bindParam(':fecha_f', $fecha_f);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }



}
