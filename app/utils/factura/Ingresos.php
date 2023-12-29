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
  <title>INGRESO MERCADERIA</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <?php //echo $anulada; 
  ?>
  <div id="page_pdf">
    <table id="factura_head">
      <tr>
        <td class="logo_factura">
          <div>
          <img src="<?php
         echo $reserva['dirLogo'];?>" width="75px" height="75px">
          </div>
        </td>
        <td class="info_empresa">
          <?php
          //if ($reserva["reserva_id"] > 0) {
          //   $iva = $reserva['reserva_iva'];

          ?>
          <div>
            <p class="h2">INGRESO DE MERCADERIA</p>
            <p><?php   // echo $reserva['direccionMatriz']; 
                ?></p>

          </div>
          <?php
          //  }
          ?>
        </td>

        <!--datos del la factura <p>Vendedor: <?php echo $reserva['reserva_numero']; ?></p>-->
        <td class="info_factura">
          <div class="round">
            <span class="h3">INGRESO MERCADERIA</span>
            <p>Ingreso #: <strong><?php echo $reserva['historial_tipo_proceso'];
                                  ?></strong></p>
            <p>Usuario:<strong><?php echo $reserva['usuario_nombres'];
                                ?></strong>
            </p>
            <p>
            </p>
            <p>Fecha y Hora: <strong><?php echo $reserva['historial_fecha'];
                                      ?></strong></p>
            <!--p>EMISÍON: <?php if ($reserva['ambiente'] == 1) {
                              //echo "NORMAL";
                            } ?></!--p>
            <p-- class="">ABONO: $<strong><?php //echo $reserva['reserva_abono']; 
                                          ?> --- SALDO PENDIENTE: $</strong><?php //echo $reserva['reserva_saldopendiente']; 
                                                                            ?> </p-->

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
            <!--  
            <tr>
                <td><label>PROVEEDOR:</label>
                  <p><?php
                      $row = $detalleTodos[0];
                     // echo $row['proveedor_razonsocial']; ?></p>
                </td>
              </tr>
            -->
              <tr>
                <td><label>FECHA:</label>
                  <p><?php echo $reserva['historial_fecha']; ?></p>
                </td>
              </tr>
              <tr>
                <td><label>SUCURSAL:</label>
                  <p><?php echo $row['sucursal_nombre']; ?></p>
                </td>
              </tr>
              <tr>
                <td><label>N° FACTURA:</label>
                  <p><?php
                      echo ($row['tem_factura_compra']); ?></p>
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


          <th width="50px">N°.</th>
          <th class="textleft">CODIGO</th>
          <th class="textleft" width="150px">PRODUCTO</th>
          <th class="textleft" width="50px">LOTE</th>
          <th class="textleft">CANTIDAD</th>
          <th class="textleft" width="50px">BODEGA</th>
          <th class="textleft" width="50px">UBICACÍON</th>
          <th class="textleft">FECHA ELAB</th>
          <th class="textleft">FECHA EXPIRA</th>
        </tr>
      </thead>
      <tbody id="detalle_productos">
        <?php
        $row = $detalleTodos[0];
        $i = 1;
        foreach ($detalleTodos as $detalle) {

        ?>
          <tr>
            <td class="textleft"><?php echo $i; ?></td>
            <td><?php echo $detalle['producto_codigoserial']; ?></td>
            <td class="textleft"><?php echo $detalle['producto_descripcion']; ?></td>
            <td class="textleft"><?php echo $detalle['lote_descripcion']; ?></td>
            <td class="textleft"><?php echo $detalle['tem_ubica_cantidad']; ?></td>
            <td><?php echo $detalle['bodega_descripcion']; ?></td>
            <td class="textleft"><?php echo $detalle['tem_ubica_descripcion']; ?></td>
            <td class="textleft"><?php echo $detalle['producto_fechaelaboracion']; ?></td>
            <td class="textleft"><?php echo $detalle['producto_fechaexpiracion']; ?></td>

          </tr>
        <?php
          $i++;
        }
        ?>

      </tbody>
      <table id="detalle_totales">
        <tr>
          <td width="300" colspan="3" class="textligth">
            <h2>ADMINISTRACION</h2><br>
            <h2>INGRESADO POR<?php //echo $iva;
                              ?> </h2>
          </td>
          <td width="300" colspan="3" class="textligth"><span>
              <h2>BODEGA</h2><br>
              <h2>REVISADO POR<?php //echo $iva;
                              ?> </h2>
          </td>

          <td class="textcenter">CANTIDAD DE BULTOS<br>
            <img src="../.././../public/images/cuadrado.JPG" width="10%" height="10%">
          </td>
        </tr>

        <tr>
          <td colspan="3" class="textligth"><span>NOMBRE: ____________________</span></td>
          <td class="textligth"><span>NOMBRE: ____________________</span></td>
          <td class="textcenter"></td>

        </tr>
        <tr>
          <td colspan="3" class="textligth"><span>FIRMA: _____________________</span></td>
          <td class="textligth"><span>FIRMA: _____________________</span></td>



        </tr>



      </table>
    </table>


  </div>

</body>

</html>