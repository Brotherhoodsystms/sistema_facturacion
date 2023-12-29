<?php
include dirname(dirname(__FILE__)) . "../../models/emisor.php";
//$logo = $_POST['emisor_logo'];

//var_dump($arrayName);
if (Emisor::validarRucEmisor(strtoupper($_POST["emisor_ruc"]))) {
  echo 1;
} else if (Emisor::validarSucursal($_POST["sucursal_id_d"])) {
  echo 3;
} else {
  if ($_POST["emisor_passFirma_first"] === $_POST["emisor_passFirma_second"]) {
    if ($_FILES["emisor_logo"]["error"] > 0) {
      echo "error en la carga del archivo";
    } else {
      // move_uploaded_file($_FILES['subir_archivo']['tmp_name'], $subir_archivo
      $permitidos = array("image/jpeg", "image/png");
      $limite_kb = 250;
      if (in_array($_FILES["emisor_logo"]["type"], $permitidos) && $_FILES["emisor_logo"]["size"] <= $limite_kb * 1024) {
        $ruta = '../../facturas/' . $_POST['emisor_ruc'] . '/';
        $ruta = '../../facturas/' . $_POST['emisor_ruc'] . '/';
        $rutaComprobantes = $ruta . 'comprobrantes/';
        $rutaautorizados
          = $rutaComprobantes . 'autorizados/';
        $rutano_autorizados
          = $rutaComprobantes . 'no_autorizados/';
        $rutapdf
          = $rutaComprobantes . 'pdf/';
        $rutasi_firmados
          = $rutaComprobantes . 'si_firmados/';
        $emisor_logo = $ruta . $_FILES["emisor_logo"]["name"];
        if (!file_exists($ruta)) {
          mkdir($ruta, 0777, true);
          mkdir($rutaComprobantes, 0777, true);
          mkdir($rutaautorizados, 0777, true);
          mkdir($rutano_autorizados, 0777, true);
          mkdir($rutapdf, 0777, true);
          mkdir($rutasi_firmados, 0777, true);
        }
        if (!file_exists($emisor_logo)) {
          $resultado = @move_uploaded_file($_FILES["emisor_logo"]["tmp_name"], $emisor_logo);
          if ($resultado) {
          } else {
            echo "El archivo no se logro guardar";
          }
        } else {
          echo "El archivo ya existe";
        }
      } else {
        echo "Archivo no permitido o excede el tamaño";
      }
    }
    //firma electronica 

    if ($_POST['emisor_regimenRimpe'] == 1) {
      $rimpe = 1;
      $rimpePopular = null;
      $rimpeEmprendedor = null;
    } else if ($_POST['emisor_regimenRimpe'] == 2) {
      $rimpePopular = 1;
      $rimpe = null;
      $rimpeEmprendedor = null;
    } else {
      $rimpeEmprendedor = null;
      $rimpe = 1;
      $rimpePopular = null;
    }
    $dir_subida
      = $emisor_firma = $ruta . $_FILES["emisor_firma"]["name"];
    $fichero_subido = $dir_subida . basename($_FILES['emisor_firma']['name']);
    $resultado = move_uploaded_file($_FILES['emisor_firma']['tmp_name'], $fichero_subido);
    //todo:array de la informacion del emisor 

    $arrayName = array(
      //'emisor_id' => $_POST['emisor_id'],
      'emisor_ruc' => $_POST['emisor_ruc'],
      'emisor_razon_social' => $_POST['emisor_razon_social'],
      'emisor_direcion' => strtoupper($_POST['emisor_direcion']),
      'emisor_ncomercial' => strtoupper($_POST['emisor_ncomercial']),
      'emisor_ambiente' => strtoupper($_POST['emisor_ambiente']),
      'emisor_tipoEmision' => strtoupper($_POST['emisor_tipoEmision']),
      'emisor_obligadoContabilidad' => strtoupper($_POST['emisor_obligadoContabilidad']),
      'emisor_contribuyenteEspecial' => strtoupper($_POST['emisor_contribuyenteEspecial']),
      'emisor_resolucionAgenteRetencion' => strtoupper($_POST['emisor_resolucionAgenteRetencion']),
      'emisor_passFirma_first' => strtoupper($_POST['emisor_passFirma_first']),
      'emisor_passFirma_second' => strtoupper($_POST['emisor_passFirma_second']),
      'emisor_regimenRimpe' => $rimpe,
      'emisor_regimenRimpe1'
      => $rimpePopular,
      'regimenRimpe2' => $rimpeEmprendedor,
      'emisor_logo' => $emisor_logo,
      'emisor_firma' => $emisor_firma,
      'id_sucursal' => $_POST['sucursal_id_d'],
      'rutaautorizados' => $rutaautorizados,
      'dirDocNoAutorizados' => $rutano_autorizados,
      'dirPdf' => $rutapdf,
      'dirsi_firmado' => $rutasi_firmados
    );
    echo json_encode(emisor::guardarEmisor($arrayName));
  } else {
    echo 2;
  }
}
