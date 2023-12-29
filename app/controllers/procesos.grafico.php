<?php

class ProcesosController
{

    static public function ctrListarTiemposProcesos()
    {


        $respuesta = ProcesosModelo::mdListarTiemposProcesos();

        return $respuesta;
    }


    static public function ctrListarGastos()
    {


        $res = ProcesosModelo::mdListarGastos();

        return $res;
    }
}
