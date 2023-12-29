<?php
$subtotal   = 0;
$iva      = 0;
$impuesto   = 0;
$tl_sniva   = 0;
$total     = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>RESERVA</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php echo $anulada; ?>
  <div id="page_pdf">
    <table id="factura_head">
      <tr>
        <td class="logo_factura">
          <div>
          <img src="<?php
         echo $reserva['dirLogo'];

          ?>" width="75px" height="75px">
          </div>
        </td>
        <td class="info_empresa">
          <?php
          if ($reserva["reserva_id"] > 0) {
            $iva = $reserva['reserva_iva'];

          ?>
            <div>
              <p class="h2"><?php echo strtoupper($reserva['nombreComercial']); ?></p>
              <p><?php echo $reserva['direccionMatriz']; ?></p>

              <p>RUC: <?php echo $reserva['ruc']; ?></p>
              <p>Contribuyente Especial Nro:
                <?php echo $reserva['contribuyenteEspecial']; ?></p>
              <p>Obligado a Llevar Contabilidad: <?php echo $reserva['obligadoContabilidad']; ?></p>
            </div>
          <?php
          }
          ?>
        </td>

        <!--datos del la factura <p>Vendedor: <?php echo $reserva['reserva_numero']; ?></p>-->
        <td class="info_factura">
          <div class="round">
            <span class="h3">RESERVA</span>
            <p>No. Reserva: <strong><?php echo $reserva['reserva_numero']; ?></strong></p>
            <p>Fecha inicio:<strong><?php echo $reserva['reserva_fechainicio']; ?></strong>
            </p>
            <p>
            </p>
            <p>Fecha Final : <strong><?php echo $reserva['reserva_fechafinal']; ?></strong></p>
            <p>EMISÍON: <?php if ($reserva['ambiente'] == 1) {
                          echo "NORMAL";
                        } ?></p>
            <p class="">ABONO: $<strong><?php echo $reserva['reserva_abono']; ?> --- SALDO PENDIENTE: $</strong><?php echo $reserva['reserva_saldopendiente']; ?> </p>

          </div>
        </td>
      </tr>
    </table>
    <!--datos del la cliente-->
    <table id="factura_cliente">
      <tr>
        <td class="info_cliente">
          <div class="round">

            <table class="datos_cliente">
              <tr>
                <td><label>Razón Social:</label>
                  <p><?php echo $reserva['cliente_razonsocial']; ?></p>
                </td>
                <td><label>Identificación:</label>
                  <p><?php echo $reserva['cliente_ruc']; ?></p>
                </td>
              </tr>
              <tr>
                <td><label>Fecha Emisión:</label>
                  <p><?php echo $reserva['reserva_fechainicio']; ?></p>
                </td>
                <td><label>Dirección:</label>
                  <p><?php echo $reserva['cliente_direccion']; ?></p>
                </td>
              </tr>
            </table>
          </div>
        </td>

      </tr>
    </table>

    <table id="factura_detalle">
      <thead>
        <tr>


          <th width="50px">Cant.</th>
          <th class="textleft">Descripción</th>
          <th class="textright" width="150px">Precio Unitario.</th>
          <th class="textright" width="150px"> Precio Total</th>
        </tr>
      </thead>
      <tbody id="detalle_productos">
        <?php
        $row = $detalleTodos[0];
        foreach ($detalleTodos as $detalle) {

        ?>
          <tr>
            <td class="textcenter"><?php echo $detalle['detareserv_cantidad']; ?></td>
            <td><?php echo $detalle['producto_descripcion']; ?></td>
            <td class="textright"><?php echo $detalle['detareserv_preciounitario']; ?></td>
            <td class="textright"><?php echo $detalle['detareserv_total']; ?></td>
          </tr>
        <?php
        }
        ?>

      </tbody>
      <tfoot id="detalle_totales">
        <tr>
          <td colspan="3" class="textright"><span>SUBTOTAL Q.</span></td>
          <td class="textright"><span><?php echo $reserva['reserva_subtotal']; ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>IVA (<?php echo $iva; ?> %)</span></td>
          <td class="textright"><span><?php echo $reserva['reserva_iva'];; ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>IVA (12.00%)</span></td>
          <td class="textright"><span><?php if ($reserva['reserva_subtotal'] != $reserva['reserva_total']) {
                                        echo ($reserva['reserva_total'] - $reserva['reserva_subtotal']);
                                      } else {
                                        echo ('0.00');
                                      }; ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="textright"><span>TOTAL Q.</span></td>
          <td class="textright"><span><?php echo $reserva['reserva_total'] ?></span></td>
        </tr>
      </tfoot>
    </table>
    <div>
      <p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
      <h4 class="label_gracias">¡Gracias por su compra!</h4>
    </div>

  </div>

</body>

</html>