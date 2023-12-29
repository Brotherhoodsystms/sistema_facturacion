<?php
include dirname(dirname(__FILE__)) . '/config/conexion.php';
class Gastos extends Conexion
{
    public static function obtenerGastos()
    {
        try {
            $sql = 'SELECT g.*, e.nombreComercial FROM tbl_gastos as g JOIN tbl_emisor as e on e.id=g.gastos_emisor_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Throwable $ex) {
            return $ex->getMessage();
        }
    }
    public static function guardarGastos($data)
    {
        try {
            $sql = "INSERT INTO tbl_gastos (gastos_factura, gastos_descripcion, gastos_total, gasto_tipo,gastos_usuario,gastos_emisor_id)
            VALUES (:gasto_factura,:gastos_descripcion,:gastos_total,:tipo_gasto,:id_usuario,:emisor_id);";
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':gasto_factura', $data['gasto_factura']);
            $query->bindParam(':gastos_descripcion',$data['gastos_descripcion']);
            $query->bindParam(':gastos_total', $data['gastos_total']);
            $query->bindParam(':tipo_gasto', $data['tipo_gasto']);
            $query->bindParam(':id_usuario', $data['id_usuario']);
            $query->bindParam(':emisor_id',$data['id_emisor']);
            $query->execute();
            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    public static function obtenerGastoId($id_gastos)
    {
        try {
            $sql = 'SELECT * FROM tbl_gastos WHERE gastos_id = :id_gastos';

            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':id_gastos', $id_gastos);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    public static function actualizarGastos($data)
    {
        try {
            $sql = 'UPDATE tbl_gastos SET gastos_factura = :gasto_factura, gastos_descripcion =
            :gastos_descripcion, gastos_total = :gastos_total, gasto_tipo =:tipo_gasto, gastos_usuario=:id_usuario
            WHERE gastos_id = :gastos_id';

            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':gasto_factura', $data['gasto_factura']);
            $query->bindParam(
                ':gastos_descripcion',
                $data['gastos_descripcion']
            );
            $query->bindParam(':gastos_total', $data['gastos_total']);
            $query->bindParam(':tipo_gasto', $data['tipo_gasto']);
            $query->bindParam(':id_usuario', $data['id_usuario']);
            $query->bindParam(':gastos_id', $data['gastos_id']);
            $query->execute();
            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
    public static function EliminarGasto($id_gasto)
    {
        try {
            $sql = 'DELETE FROM tbl_gastos WHERE gastos_id = :gastos_id';
            $query = Conexion::obtenerConexion()->prepare($sql);
            $query->bindParam(':gastos_id', $id_gasto);
            $query->execute();
            return true;
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
