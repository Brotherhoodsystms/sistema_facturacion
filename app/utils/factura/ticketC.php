<?php
$subtotal   = 0;
$iva      = 0;
$impuesto   = 0;
$tl_sniva   = 0;
$total     = 0;
$i=1;

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Comprobante de Salida</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php echo $anulada; ?>
  <div id="page_pdf">
    <table id="factura_head">
      <tr>
        <td class="info_empresa">
          <?php
          if ($reserva["notaventa_id"] > 0) {
            $iva = $reserva['notaventa_iva'];

          ?>
            <div>
              <p class="h2"><?php echo strtoupper($reserva['nombreComercial']); ?></p>
              <p><?php echo $reserva['direccionMatriz']; ?></p>

              <p>RUC: <?php echo $reserva['ruc']; ?></p>
              <p>Contribuyente Especial Nro:
                <?php echo $reserva['contribuyenteEspecial']; ?></p>
              <p>Obligado a Llevar Contabilidad: <?php echo $reserva['obligadoContabilidad']; ?></p>
              <span class="h3">Comprobante de salida</span>
            <p>No.:<strong><?php echo $establecimiento.'-'.$ptoEmision.'-'; ?><?php echo (str_pad($reserva['notaventa_serie'], 9, "0", STR_PAD_LEFT)); ?></strong></p>
            
            </div>
          <?php
          }
          ?>
        </td>

        <!--datos del la factura <p>Vendedor: <?php echo $reserva['notaventa_serie']; ?></p>-->
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
                </tr>
              <tr>
                <td><label>Identificación:</label>
                  <p><?php echo $reserva['cliente_ruc']; ?></p>
                </td>
              </tr>
              <tr>
                <td><label>Fecha Emisión:</label>
                  <p><?php echo date("d/m/Y", strtotime($reserva['notaventa_fechagenerada'])); ?></p>
                </td>
              </tr>
              <tr>
                <td><label>Dirección:</label>
                  <p><?php echo $reserva['cliente_direccion']; ?></p>
                </td>
              </tr>
            </table>
          </div>
        </td>

      </tr>
    </table>

    <table >
      <thead>
        <tr>


        <th width="50px">N°</th>
        <th width="50px">Cant.</th>
          <th  width="50px"class="textleft">Descripción</th>
          <th  width="50px"class="textright" width="150px">Precio Unitario.</th>
          <th width="50px"class="textright" width="150px"> Precio Total</th>
        </tr>
      </thead>
      </table>
      <table id="factura_detalle">
      <tbody id="detalle_productos">
        <?php
        foreach ($detalleTodos as $detalle) {
        ?>
          <tr>
          <td width="50px" class="textcenter"><?php echo $i; ?></td>
          <td  width="50px" class="textcenter"><?php echo $detalle['detanot_cantidad']; ?></td>
            <td width="50px"><?php echo $detalle['producto_descripcion']; ?></td>
            <td width="50px" class="textright"><?php echo $detalle['detanot_preciounitario']; ?></td>
            <td  width="50px" class="textright"><?php echo $detalle['detanot_total']; ?></td>
          </tr>
        <?php
        $i=$i+1;
        }
        ?>

        <!-- <tr>
          <td colspan="4" class="textright"><span>SUBTOTAL Q.</span></td>
          <td class="textright"><span><?php echo $reserva['notaventa_subtotal']; ?></span></td>
        </tr>
        <tr>
          <td colspan="4" class="textright"><span>IVA12%(<?php echo $iva; ?> )</span></td>
          <td class="textright"><span><?php echo $reserva['factura_iva12']; ?></span></td>
        </tr> -->
        <tr>
          <td colspan="4" class="textright"><span>TOTAL Q.</span></td>
          <td class="textright"><span><?php echo $reserva['notaventa_total']; ?></span></td>
        </tr>
        </tbody>
    </table>
    <div>
      <p class="label_gracias">Comprobante sin valor tributario su factura se emitira a su correo electronico caso contrario, <br>pongase en contacto con nombre, teléfono y Email</p>
      <h4 class="label_gracias">¡Gracias por su compra!</h4>
    </div>

  </div>

</body>



</html>