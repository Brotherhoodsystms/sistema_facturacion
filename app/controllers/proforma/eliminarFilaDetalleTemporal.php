<?php
include dirname(dirname(__FILE__)) . "../../models/venta.php";

    if (Venta::eliminarDetalletempId($_POST['temp_id'])) {
      echo 1;
    }
