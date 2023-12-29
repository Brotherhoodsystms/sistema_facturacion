<?php

require_once "../models/procesos.grafico.php";
require_once "../controllers/procesos.grafico.php";
class AjaxProcesos{

public function ListarTiemposProcesos(){

    $respuesta=ProcesosController::ctrListarTiemposProcesos();


    echo json_encode($respuesta);

}
}

$procesos = new AjaxProcesos();
$procesos->ListarTiemposProcesos();
