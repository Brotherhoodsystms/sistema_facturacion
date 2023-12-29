<?php
include dirname(dirname(__FILE__)) . '/config/conexion.php';
class Reportec extends Conexion
{
    public static function obtenerCompras($emisor_id){
        try {
            $sql =
                "SELECT g.gastos_id, g.gastos_factura,g.gastos_descripcion,g .gasto_tipo,
                g.gastos_fecha_i,u.usuario_nombres, u.usuario_dni,g.gastos_total,e.nombreComercial
                FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
                JOIN tbl_emisor as e on e.id=g.gastos_emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerTotalCompras(){
        try {
            $sql =
                "SELECT SUM(g.gastos_total) as total FROM tbl_gastos as g JOIN tbl_usuario as u
                on u.usuario_id=g.gastos_usuario
                JOIN tbl_emisor as e on e.id=g.gastos_emisor_id";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerComprasVendedor($ruc_cliente,$sucursal){
        try {
            $sql="SELECT g.gastos_id, g.gastos_factura,g.gastos_descripcion,g .gasto_tipo,
            g.gastos_fecha_i,u.usuario_nombres, u.usuario_dni,g.gastos_total,e.nombreComercial
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE u.usuario_dni=:ruc_vendedor AND e.id=:emisor_id";
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
            $sql="SELECT SUM(g.gastos_total) as total
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE u.usuario_dni=:ruc_vendedor AND e.id=:emisor_id";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':ruc_vendedor', $ruc_cliente);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerComprasSucursal($emisor_id){
        try {
            $sql="SELECT c.id_comision, c.valor,c.fecha_ingreso,f.factura_serie,
            v.vendedor_nombres,e.nombreComercial, com.comprobante_descripcion
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
    public static function obtenerComprasFactura($num_factura,$sucursal){
        try {
            $sql="SELECT g.gastos_id, g.gastos_factura,g.gastos_descripcion,g .gasto_tipo,
            g.gastos_fecha_i,u.usuario_nombres, u.usuario_dni,g.gastos_total,e.nombreComercial
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE g.gastos_factura=:num_factura AND e.id=:emisor_id";
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
            $sql="SELECT SUM(g.gastos_total) as total
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE g.gastos_factura=:num_factura AND e.id=:emisor_id";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':num_factura', $num_factura);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerComprasComprobante($comprobante_id,$sucursal){
        try {
            $sql="SELECT g.gastos_id, g.gastos_factura,g.gastos_descripcion,g .gasto_tipo,
            g.gastos_fecha_i,u.usuario_nombres, u.usuario_dni,g.gastos_total,e.nombreComercial
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE g.gasto_tipo=:comprobante_id AND e.id=:emisor_id";
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
            $sql="SELECT SUM(g.gastos_total) as total
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE g.gasto_tipo=:comprobante_id AND e.id=:emisor_id";
            $query=Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':comprobante_id', $comprobante_id);
            $query->bindParam(':emisor_id', $sucursal);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }catch (\Throwable  $ex){
            return $ex->getMessage();
        }
    }
    public static function obtenerCompraFecha($fecha_i,$fecha_f,$sucursal){
        try {
            $sql="SELECT g.gastos_id, g.gastos_factura,g.gastos_descripcion,g .gasto_tipo,
            g.gastos_fecha_i,u.usuario_nombres, u.usuario_dni,g.gastos_total,e.nombreComercial
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE g.gastos_fecha_i>:fecha_i
            AND e.id=:emisor_id AND g.gastos_fecha_i<:fecha_f";
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
            $sql="SELECT SUM(g.gastos_total) as total
            FROM tbl_gastos as g JOIN tbl_usuario as u on u.usuario_id=g.gastos_usuario
            JOIN tbl_emisor as e on e.id=g.gastos_emisor_id WHERE g.gastos_fecha_i>:fecha_i
            AND e.id=:emisor_id AND g.gastos_fecha_i<:fecha_f";
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
