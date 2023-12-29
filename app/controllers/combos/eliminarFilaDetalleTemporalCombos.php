<?php
include dirname(dirname(__FILE__)) . "../../models/combos.php";

  if (Combos::eliminarDetalletempId($_POST['temp_combos_id'])) {
    echo 1;
  }