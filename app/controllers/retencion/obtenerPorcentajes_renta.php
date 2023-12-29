<?php
include dirname(dirname(__FILE__)) . "../../models/retencion.php";
if($_POST['tipo_renta']==1){
    $data = Retencion::obtenerRetencionesIva();

}else if($_POST['tipo_renta']==2){
    $data = Retencion::obtenerRetencionesRenta();
}else if($_POST['tipo_renta']==3){
    $data = Retencion::obtenerRetencionesIsd();
}

echo json_encode($data);
