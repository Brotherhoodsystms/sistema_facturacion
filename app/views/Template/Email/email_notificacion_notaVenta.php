<?php

$orden = $data['notaVenta'];
$detalle = $data['detalle_NotaVenta'];

const SMONEY = "$";
//var_dump($detalle);
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Orden</title>
  <style type="text/css">
    p {
      font-family: arial;
      letter-spacing: 1px;
      color: #7f7f7f;
      font-size: 12px;
    }

    hr {
      border: 0;
      border-top: 1px solid #CCC;
    }

    h4 {
      font-family: arial;
      margin: 0;
    }

    table {
      width: 100%;
      max-width: 600px;
      margin: 10px auto;
      border: 1px solid #CCC;
      border-spacing: 0;
    }

    table tr td,
    table tr th {
      padding: 5px 10px;
      font-family: arial;
      font-size: 12px;
    }

    #detalleOrden tr td {
      border: 1px solid #CCC;
    }

    .table-active {
      background-color: #CCC;
    }

    .text-center {
      text-align: center;
    }

    .text-right {
      text-align: right;
    }

    @media screen and (max-width: 470px) {
      .logo {
        width: 90px;
      }

      p,
      table tr td,
      table tr th {
        font-size: 9px;
      }
    }
  </style>
</head>


<body>
  <div id="page_pdf">
    
    <p class="text-center">Estimado(a),

      <?php echo $orden['cliente_razonsocial']; ?></p>
    <p>

      Esta es una notificacion automatica de un documento tributario electronico emitido por <?php echo strtoupper($orden['nombreComercial']); ?>

    </p>
    <p>Tipo de Comprobante: Comprobante de Salida

    </p>
    <p>Nro de Comprobante:<?php echo $orden['notaventa_id']; ?>

    </p>
    <p>Valor Total: <?php echo $orden['notaventa_total']; ?>

    </p>
    <p> Los detalles generales del comprobante pueden ser consultados en el archivo pdf adjunto en este correo.
    </p>
    <p>
      Atentamente,
    </p>
    <p>

      <?php echo strtoupper($orden['nombreComercial']); ?></p>
    
    <hr>
    
    <table id="factura_head">
      <tr>
        <td class="logo_factura">
          <div>
            <img src="../../../utils/factura/img/logo.png">
          </div>
        </td>
        <td class="info_empresa">
          <?php
          if ($orden["notaventa_id"] > 0) {
            $iva = $orden['notaventa_iva'];

          ?>
            <div>
              <p class="h2"><?php echo strtoupper($orden['nombreComercial']); ?></p>
              <p><?php echo $orden['direccionMatriz']; ?></p>

              <p>RUC: <?php echo $orden['ruc']; ?></p>
              <p>Contribuyente Especial Nro:
                <?php echo $orden['contribuyenteEspecial']; ?></p>
              <p>Obligado a Llevar Contabilidad: <?php echo $orden['obligadoContabilidad']; ?></p>
            </div>
          <?php
          }
          ?>
        </td>

        <!--datos del la factura <p>Vendedor: <?php echo $orden['orden_numero']; ?></p>-->
        <td class="info_factura">
          <div class="round">
            <span class="h3">Comprobante de Salida</span>
            <p>No:<strong><?php echo $orden['notaventa_id']; ?></strong></p>
            <p>EMISÍON: <?php if ($orden['ambiente'] == 1) {
                          echo "NORMAL";
                        } ?></p>
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
                  <p><?php echo $orden['cliente_razonsocial']; ?></p>
                </td>
                <td><label>Identificación:</label>
                  <p><?php echo $orden['cliente_ruc']; ?></p>
                </td>
              </tr>
              <tr>
                <td><label>Fecha Emisión:</label>
                  <p><?php echo $orden['notaventa_fechagenerada']; ?></p>
                </td>
                <td><label>Dirección:</label>
                  <p><?php echo $orden['cliente_direccion']; ?></p>
                </td>
              </tr>
            </table>
          </div>
        </td>

      </tr>
    </table>

    <table id="factura_detalle">
      <thead class="table-active">
        <tr>


          <th width="50px">Cant.</th>
          <th class="textleft">Descripción</th>
          <th class="textright" width="150px">Precio Unitario.</th>
          <th class="textright" width="150px"> Precio Total</th>
        </tr>
      </thead>
      <tbody id="detalleOrden">
        <?php
        foreach ($detalle as $detalle) {

        ?>
          <tr>
            <td class="text-right"><?php echo $detalle['detanot_cantidad']; ?></td>
            <td><?php echo $detalle['producto_descripcion']; ?></td>
            <td class="text-right"><?php echo $detalle['detanot_preciounitario']; ?></td>
            <td class="text-right"><?php echo $detalle['detanot_total']; ?></td>
          </tr>
        <?php
        }
        ?>

      </tbody>
      <tfoot id="detalle_totales">
        <tr>
          <td colspan="3" class="text-right"><span>SUBTOTAL Q.</span></td>
          <td class="text-right"><span><?php echo $orden['notaventa_subtotal']; ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="text-right"><span>IVA (<?php echo $iva; ?> %)</span></td>
          <td class="text-right"><span><?php echo $orden['notaventa_iva']; ?></span></td>
        </tr>
        <tr>
          <td colspan="3" class="text-right"><span>TOTAL Q.</span></td>
          <td class="text-right"><span><?php echo $orden['notaventa_total']; ?></span></td>
        </tr>
      </tfoot>
    </table>
    <div class="text-center">
      <p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
      <h4 class="label_gracias">¡Gracias por su compra!</h4>
    </div>

  </div>

</body>

</html>