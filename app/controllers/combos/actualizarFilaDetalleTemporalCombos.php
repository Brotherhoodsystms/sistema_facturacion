<?php
include dirname(dirname(__FILE__)) . "../../models/combos.php";

if(empty($_POST['cantidadnueva_combos'])){
    $cantidad = $_POST['cantidadactual_combos'];
}else{
    $cantidad = $_POST['cantidadnueva_combos'];
}

$total = $cantidad * $_POST['temp_combos_precio_add'];

if (Combos::actualizarDetalletempIdCombos($_POST['temp_combos_id_add'],$cantidad,$total)) {
        echo 1;
}
  



