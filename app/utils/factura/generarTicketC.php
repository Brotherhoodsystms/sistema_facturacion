<?php
/*
print_r($_REQUEST);
exit;
echo base64_encode('2');
exit;*/


include dirname(dirname(__FILE__)) . "../../config/conexion.php";
require_once '../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
  echo "No es posible generar el comprobante.";
} else {
  $codCliente = $_REQUEST['cl'];
  $noFactura = $_REQUEST['f'];
  $anulada = '';

  $sql = "SELECT * FROM tbl_notaventa as notaventa INNER JOIN tbl_cliente as cliente on
  notaventa.cliente_id=cliente.cliente_id INNER JOIN tbl_emisor as emisor on notaventa.emisor_id=emisor.id
  WHERE notaventa.notaventa_id=:reserva_numero";

  $query = Conexion::obtenerConexion()->prepare($sql);
  $query->bindParam(":reserva_numero", $noFactura);
  $datos = $query->execute();



  if ($datos > 0) {
    $reserva =
      $query->fetch(PDO::FETCH_ASSOC);
  }
  $sql2 = "SELECT * FROM tbl_detallenventa as dn
  INNER JOIN tbl_producto as p on p.producto_id=dn.producto_id WHERE dn.factura_id=:reserva_id";
  $query2 = Conexion::obtenerConexion()->prepare($sql2);
  $query2->bindParam(":reserva_id", $noFactura);
  $detalleTodos =
    $query2->execute();
  if ($detalleTodos > 0) {

    $detalleTodos = $query2->fetchAll(PDO::FETCH_ASSOC);
    //$no_factura = $factura['nofactura'];


    if ($reserva['notaventa_estado'] != "A") {
      $anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
    }

/* datos para el emisor */
$sql4 = "SELECT es.codigo as codigo_es, pt.codigo as codigo_pto,em.* FROM tbl_establecimiento as es
JOIN tbl_ptoemision as pt on pt.establecimiento_id=es.id
JOIN tbl_emisor as em on em.id=es.emisor_id WHERE es.emisor_id=:reserva_numero";
    $query4 = Conexion::obtenerConexion()->prepare($sql4);
    $query4->bindParam(':reserva_numero', $reserva['emisor_id']);
    $query4->execute();
    $datos_punto_emision =$query4->fetch(PDO::FETCH_ASSOC);
    $establecimiento=$datos_punto_emision['codigo_es'];
    $ptoEmision=$datos_punto_emision['codigo_pto'];
/* datos para el punto de emision y factura */
    ob_start();
    include(dirname('__FILE__') . '/ticketC.php');
    $html = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'portrait');
    $dompdf->setPaper('b7', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream('Comprobante_Salida_' . $noFactura . '.pdf', array('Attachment' => 0));
    exit;
  }
}
