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
    /*
    $query_productos = mysqli_query($conection, "SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.nofactura = dt.nofactura
														INNER JOIN producto p
														ON dt.codproducto = p.codproducto
														WHERE f.nofactura = $no_factura ");
    $result_detalle = mysqli_num_rows($query_productos);
*/
    ob_start();
    include(dirname('__FILE__') . '/notaventa.php');
    $html = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'portrait');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => 0));
    exit;
  }
}
