<?php
$subtotal   = 0;
$iva      = 0;
$impuesto   = 0;
$tl_sniva   = 0;
$total     = 0;
date_default_timezone_set('America/Guayaquil');
//var_dump($datos_usuario);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Reporte Reserva</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div>
  <img src="<?php
         echo $reserva['dirLogo'];?>" width="75px" height="75px">
  </div>

  <div id="page_pdf">
    <h2 class="center-text">Reporte de Reservas por <?php
                                                    if ($noFactura == 1) {
                                                      echo ' Producto';
                                                    } else if ($noFactura == 2) {
                                                      echo ' Cliente';
                                                    } else if ($noFactura == 3) {
                                                      echo ' Vendedor';
                                                    } else if ($noFactura == 4) {
                                                      echo ' Numero de Reserva';
                                                    } else if ($noFactura == 6) {
                                                      echo 'Fecha desde ' . $parametro2 . ' a ' . $parametro;
                                                    }

                                                    ?><br> <span>Usuario: <?php echo ($datos_usuario['usuario_nombres']); ?> Fecha:<?php echo (date('d/m/y h:i:s')); ?> </span></h2>
    <table id="factura_detalle">
      <thead>
        <tr>


          <th width="80px">Fecha</th>
          <th class="textleft">Nombre del Cliente</th>
          <th class="textright" width="150px">N° Reserva</th>
          <th class="textright" width="150px">Valor</th>
        </tr>
      </thead>
      <tbody id="detalle_productos">
        <?php
        $row = $detalleTodos[0];
        foreach ($detalleTodos as $detalle) {

        ?>
          <tr>
            <td class="textcenter"><?php echo $detalle['reserva_fechainicio']; ?></td>
            <td><?php echo $detalle['cliente_razonsocial']; ?></td>
            <td class="textright"><?php echo $detalle['reserva_numero']; ?></td>
            <td class="textright"><?php echo $detalle['reserva_total']; ?></td>
          </tr>
        <?php
        }
        ?>

      </tbody>
    </table>

  </div>

</body>

</html>