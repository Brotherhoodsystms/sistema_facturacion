<?php
include dirname(dirname(__FILE__)) . '/config/conexion.php';
class Proforma extends Conexion
{
    public static function obtenerFacturasActivas($emisor_id)
    {
        try {
            $sql = "SELECT * FROM tbl_proforma pr JOIN tbl_formapago p
      ON pr.proforma_formpago_id = p.formpago_id JOIN tbl_cliente c
      ON pr.proforma_cliente_id = c.cliente_id WHERE pr.proforma_emisor_id=:emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':emisor_id', $emisor_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    //todo::obtener codigos par la  imprecion de archivos
    public static function obtenerCodigoFactura($id)
    {
        try {
            $sql = "SELECT e.*,es.codigo as cod_esta, pt.codigo as cod_pto FROM tbl_emisor as e
        INNER JOIN tbl_establecimiento as es on es.emisor_id=e.id
        INNER JOIN tbl_ptoemision as pt on pt.establecimiento_id=es.id WHERE e.id=:proforma_id"; /*  */
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':proforma_id', $id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    /*  */
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
}
