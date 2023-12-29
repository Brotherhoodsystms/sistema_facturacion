<?php
/*
print_r($_REQUEST);
exit;
echo base64_encode('2');
exit;*/

session_start();


include dirname(dirname(__FILE__)) . "../../config/conexion.php";
//include dirname(dirname(__FILE__)) . "../../app/controllers/reserva/obtenerReservaParametro.php";
require_once '../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
  echo "No es posible generar la factura.";
} else {
  if (!empty($_REQUEST['fi'])) {
    $parametro2 = $_REQUEST['fi'];
  }
  $parametro = $_REQUEST['cl'];
  $noFactura = $_REQUEST['f'];
  $anulada = '';
  $idUser = $_SESSION['idUser'];
  $sql = "SELECT * FROM tbl_usuario WHERE usuario_id=$idUser";
  $query = Conexion::obtenerConexion()->query($sql);
  $query->execute();
  $datos_usuario
    = $query->fetch(PDO::FETCH_ASSOC);

  if ($noFactura == 1) {
    $sql2 = "SELECT * FROM tbl_detallereserva as detallereserva INNER JOIN tbl_producto as producto on detallereserva.producto_id=producto.producto_id WHERE reserva_id=:reserva_id";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(":reserva_id", $parametro);
    $detalleTodos =
      $query2->execute();
  } else if ($noFactura == 2) {
    $sql2 = "SELECT * FROM tbl_reserva r JOIN tbl_cliente c ON r.cliente_id = c.cliente_id JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id JOIN tbl_formapago g ON r.formpago_id = g.formpago_id WHERE c.cliente_ruc =:reserva_id";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(":reserva_id", $parametro);
    $detalleTodos =
      $query2->execute();
  } else if ($noFactura == 3) {
    $sql2 = "SELECT * FROM tbl_reserva r
      JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
      JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
      JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
      WHERE v.vendedor_dni=:reserva_id";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(":reserva_id", $parametro);
    $detalleTodos =
      $query2->execute();
  } else if ($noFactura == 4) {
    $sql2 = "SELECT * FROM tbl_reserva r
      JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
      JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
      JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
      WHERE r.reserva_numero=:reserva_id";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(":reserva_id", $parametro);
    $detalleTodos =
      $query2->execute();
  } else if ($noFactura == 5) {
    $sql2 = "SELECT * FROM tbl_detallereserva as detallereserva INNER JOIN tbl_producto as producto on detallereserva.producto_id=producto.producto_id WHERE reserva_id=:reserva_id";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(":reserva_id", $parametro);
    $detalleTodos =
      $query2->execute();
  } else if ($noFactura == 6) {
    $sql2 = "SELECT * FROM tbl_reserva r
      JOIN tbl_cliente c ON r.cliente_id = c.cliente_id
      JOIN tbl_vendedor v ON r.vendedor_id = v.vendedor_id
      JOIN tbl_formapago g ON r.formpago_id = g.formpago_id
      WHERE r.reserva_fechainicio>= :reserva_fechainicio AND r.reserva_fechainicio <= :reserva_fechafinal
    ";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(":reserva_fechainicio", $parametro2);
    $query2->bindParam(":reserva_fechafinal", $parametro);
    $detalleTodos =
      $query2->execute();
  }

  if ($detalleTodos > 0) {

    $detalleTodos = $query2->fetchAll(PDO::FETCH_ASSOC);

    ob_start();
    include(dirname('__FILE__') . '/ReporteReserva.php');
    $html = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream('Reporte_Reserva_' . $noFactura . '.pdf', array('Attachment' => 0));
    $output = $dompdf->output();

    exit;
  }
}
