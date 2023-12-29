<?php
include dirname(dirname(__FILE__)) . "../../models/permisos.php";
if ($_POST) {
  $intIdrol = intval($_POST['id_rol']);
  $modulos = $_POST['modulos'];
  $eliminar = Permisos::eliminarPermisos($intIdrol);
  foreach ($modulos as $modulo) {
    $idModulo = $modulo['id_modulo'];
    if (isset($modulo['r'])) {
      $r = '1';
    } else {
      $r = '0';
    }
    if (isset($modulo['w'])) {
      $w = '1';
    } else {
      $w = '0';
    }
    if (isset($modulo['u'])) {
      $u = '1';
    } else {
      $u = '0';
    }
    if (isset($modulo['d'])) {
      $d = '1';
    } else {
      $d = '0';
    }
    if (isset($modulo['i'])) {
      $i = '1';
    } else {
      $i = '0';
    }

    $ingresoPermiso = (Permisos::insertarPermisos($intIdrol, $idModulo, $r, $w, $u, $d, $i));
  }
  echo json_encode($ingresoPermiso);
}
