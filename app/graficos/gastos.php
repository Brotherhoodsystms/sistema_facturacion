<?php

require_once "../models/procesos.grafico.php";
require_once "../controllers/procesos.grafico.php";
class AjaxProcesos{

public function ListarTiemposProcesos(){


    $res=ProcesosController::ctrListarGastos();

    echo json_encode($res);

}
}

$procesos = new AjaxProcesos();
$procesos->ListarTiemposProcesos();