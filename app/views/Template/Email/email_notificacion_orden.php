<?php

$orden = $data['factura'];
$detalle = $data['detalle_factura'];

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
    <br>
    <p class="text-center">Estimado(a),

      <?php echo $orden['cliente_razonsocial']; ?></p><br>
    <p>

      Esta es una notificacion automatica de un documento tributario electronico emitido por <?php echo strtoupper($orden['nombreComercial']); ?>

    </p>
    <p>Tipo de Comprobante: FACTURA

    </p>
    <p>Nro de Comprobante:00000000<?php echo $orden['factura_serie']; ?>

    </p>
    <p>Valor Total: <?php echo $orden['factura_total']; ?>

    </p>
    <p> Los detalles generales del comprobante pueden ser consultados en el archivo pdf adjunto en este correo.
    </p>
    <p>
      Atentamente,
    </p>
    <p>


  </div>

</body>

</html>