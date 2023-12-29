<?php
include dirname(dirname(__FILE__)) . '../../config/conexion.php';
require_once '../pdf/vendor/autoload.php';
require_once '../../Helpers/Helpers.php';
use Dompdf\Dompdf;

//const RUTA_ABSOLUTA ='C:\xampp\htdocs\seli_logistics_inventario2';
if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
    echo 'No es posible generar la factura.';
} else {
    $codCliente = $_REQUEST['cl'];
    $noFactura = $_REQUEST['f'];
    $anulada = '';

    $sql = "SELECT * FROM tbl_proforma as proforma INNER JOIN tbl_emisor as emisor on
  emisor.id=proforma.proforma_emisor_id INNER JOIN tbl_cliente as cliente on
  proforma_cliente_id=cliente.cliente_id WHERE proforma.proforma_id=:reserva_numero";
    $query = Conexion::obtenerConexion()->prepare($sql);
    $query->bindParam(':reserva_numero', $noFactura);
    $datos = $query->execute();

    if ($datos > 0) {
        $reserva = $query->fetch(PDO::FETCH_ASSOC);
    }
    $sql2 = "SELECT * FROM tbl_detalleproforma as detalleProforma INNER JOIN tbl_producto as producto on
  detalleProforma.producto_id=producto.producto_id WHERE detalleProforma.proforma_id=:reserva_id";
    $query2 = Conexion::obtenerConexion()->prepare($sql2);
    $query2->bindParam(':reserva_id', $noFactura);
    $detalleTodos = $query2->execute();
    if ($detalleTodos > 0) {
        $detalleTodos = $query2->fetchAll(PDO::FETCH_ASSOC);
        //$no_factura = $factura['nofactura'];

        if ($reserva['proforma_estado'] != 'A') {
            $anulada =
                '<img class="anulada" src="img/anulado.png" alt="Anulada">';
        }
/* datos para el emisor */
$sql4 = "SELECT es.codigo as codigo_es, pt.codigo as codigo_pto,em.* FROM tbl_establecimiento as es
JOIN tbl_ptoemision as pt on pt.establecimiento_id=es.id
JOIN tbl_emisor as em on em.id=es.emisor_id WHERE es.emisor_id=:reserva_numero";
    $query4 = Conexion::obtenerConexion()->prepare($sql4);
    $query4->bindParam(':reserva_numero', $reserva['proforma_emisor_id']);
    $query4->execute();
    $datos_punto_emision =$query4->fetch(PDO::FETCH_ASSOC);
/* datos para el punto de emision y factura */
        ob_start();
        include dirname('__FILE__') . '/proforma.php';
        $html = ob_get_clean();

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $dompdf->loadHtml($html);
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('letter', 'portrait');
        //$dompdf->setPaper('b7', 'portrait');//eliminar es par aun ticket
        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Proforma_' . $noFactura . '.pdf', ['Attachment' => 0]);
        $output = $dompdf->output();
        $rutaGuardado = RUTA_ABSOLUTA . '\app\facturas\proformas/';
        file_put_contents(
            $rutaGuardado . 'Proforma_'.$datos_punto_emision['ruc'].'_'.$datos_punto_emision['codigo_es'].'_'.$datos_punto_emision['codigo_pto'].'_'. $reserva['proforma_serie']. '.pdf',
            $output
        );
        exit();
    }
}
