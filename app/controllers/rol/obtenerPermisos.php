<?php
include dirname(dirname(__FILE__)) . "../../models/permisos.php";
include dirname(dirname(__FILE__)) . "../../models/modelos.php";


$rolId = $_POST["id_rol"];

if ($rolId > 0) {
  $modulos = Modelos::obtenerModelos();
  $permisosByRole = Permisos::obtenerPermisoId($_POST["id_rol"]);
  //$roles = Modelos::obtenerRolId($_POST["id_rol"]);
  $permisos = ['r' => 0, 'w' => 0, 'u' => 0, 'd' => 0, 'i' => 0,];
  $accesosByRoles = ['id_rol' => $rolId];

  if (empty($permisosByRole)) {
    for (
      $i = 0;
      $i < count($modulos);
      $i++
    ) {
      $modulos[$i]['accesos'] = $permisos;
    }
  } else {
    for (
      $i = 0;
      $i < count($modulos);
      $i++
    ) {
      $permisos = ['r' => 0, 'w' => 0, 'u' => 0, 'd' => 0, 'i' => 0];
      if (isset($permisosByRole[$i])) {
        $permisos = ['r' => $permisosByRole[$i]['r'], 'w' => $permisosByRole[$i]['w'], 'u' => $permisosByRole[$i]['u'], 'd' => $permisosByRole[$i]['d'], 'i' => $permisosByRole[$i]['i']];
      }
      $modulos[$i]['accesos'] = $permisos;
    }
  }

  $accesosByRoles['paginas'] = $modulos;
}
//var_dump($accesosByRoles);

echo json_encode($accesosByRoles);
