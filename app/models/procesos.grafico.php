<?php
require_once "../config/conexion.php";
class ProcesosModelo
{

    static public function mdListarTiemposProcesos()

    {
        $conexion = Conexion::obtenerConexion();
        $conexion->query("SET lc_time_names = 'es_ES'");
        $stat = $conexion->prepare(" CALL prc_ListarTiemposProcesos");
        $stat->execute();
        $resultados = $stat->fetchAll();
        $stat = null;
        $conexion = null;
        return $resultados;
    }


    static public function mdListarGastos()

    {
        $conexion = Conexion::obtenerConexion();
        $conexion->query("SET lc_time_names = 'es_ES'");
        $stat = $conexion->prepare(" CALL prc_ListarGastos");
        $stat->execute();
        $resultados = $stat->fetchAll();
        $stat = null;
        $conexion = null;
        return $resultados;
    }
}