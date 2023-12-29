<?php
include dirname(dirname(__FILE__)) . "../../config/conexion.php";
require_once '../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
  echo "No es posible generar la factura.";
} else {
  $codCliente = $_REQUEST['cl'];
  $noIngreso = $_REQUEST['f'];
  $anulada = '';

  $sql = "SELECT * FROM tbl_historial as h INNER JOIN tbl_usuario as u on u.usuario_id=h.historial_idusuario WHERE h.historial_id=:reserva_numero";

  $query = Conexion::obtenerConexion()->prepare($sql);
  $query->bindParam(":reserva_numero", $noIngreso);
  $datos = $query->execute();



  if ($datos > 0) {
    $reserva =
      $query->fetch(PDO::FETCH_ASSOC);
  }
  $sql2 = "SELECT * FROM `tbl_tempubicacion` as tu INNER JOIN tbl_producto as p on p.producto_id=tu.temp_ubica_productoid INNER JOIN tbl_categoria as c on c.categoria_id=p.categoria_id INNER JOIN tbl_proveedor as pro on pro.proveedor_id=p.proveedor_id INNER JOIN tbl_bodega as b on b.bodega_id=tu.tem_ubica_bodegaid INNER JOIN tbl_sucursal as s on s.sucursal_id=b.sucursal_id WHERE tu.tem_idtransaccion=:reserva_id";
  $query2 = Conexion::obtenerConexion()->prepare($sql2);
  $query2->bindParam(":reserva_id", $noIngreso);
  $detalleTodos =
    $query2->execute();
  if ($detalleTodos > 0) {

    $detalleTodos = $query2->fetchAll(PDO::FETCH_ASSOC);
    //$no_factura = $factura['noIngreso'];


    /*if ($reserva['historial_estado'] != "A") {
      $anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
    }*/
    /*
    $query_productos = mysqli_query($conection, "SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.noIngreso = dt.noIngreso
														INNER JOIN producto p
														ON dt.codproducto = p.codproducto
														WHERE f.noIngreso = $no_factura ");
    $result_detalle = mysqli_num_rows($query_productos);
*/
    ob_start();
    include(dirname('__FILE__') . '/Ingresos.php');
    $html = ob_get_clean();

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);
    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('letter', 'landscape');
    // Render the HTML as PDF
    $dompdf->render();
    // Output the generated PDF to Browser
    $dompdf->stream('Ingreso' . $noIngreso . '.pdf', array('Attachment' => 0));
    $output = $dompdf->output();
    //$rutaGuardado = 'C:\laragon\www\seli_logistics_inventario\app\comprobantes\autorizados\ingresos/';

    exit;
  }
}
