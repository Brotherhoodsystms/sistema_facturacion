<?php
include dirname(dirname(__FILE__)) . "../../models/reserva.php";
//include  "../../controllers/reserva/generarPdf.php";
include dirname(dirname(__FILE__)) . "../../../public/fpdf/fpdf.php";
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFillColor(232, 232, 232);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(70, 6, 'Forma de pago', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Código producto', 1, 0, 'C', 1);
$pdf->Cell(20, 6, 'Producto nombre', 1, 0, 'C', 1);
$pdf->Cell(70, 6, 'Cliente', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Vendedor', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Numero reserva', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Reserva fecha inicio', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Reserva fecha final', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Reserva cantidad', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Reserva comisión', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Reserva abono', 1, 1, 'C', 1);
$pdf->Cell(70, 6, 'Reserva saldo pendiente', 1, 1, 'C', 1);

$pdf->SetFont('Arial', '', 8);

$data = Reserva::obtenerReserva($_POST["valor"]);

foreach ($data as $key => $value) {
  $pdf->Cell(70, 6, utf8_decode('formpago_descripcion'), 1, 0, 'C');
  $pdf->Cell(20, 6, 'producto_codigoserial', 1, 0, 'C');
  $pdf->Cell(70, 6, utf8_decode('producto_descripcion'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('cliente_ruc'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('vendedor_nombres'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('reserva_fechainicio'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('reserva_fechafinal'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('reserva_cantidad'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('reserva_comision'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('reserva_abono'), 1, 1, 'C');
  $pdf->Cell(70, 6, utf8_decode('reserva_saldopendiente'), 1, 1, 'C');
}
$pdf->Output();
file_put_contents($_POST["valor"] . '.pdf', $output);

echo json_encode($_POST);
