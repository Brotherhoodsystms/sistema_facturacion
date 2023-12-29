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
  <title>Codigo Barras</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <div class="textcenter" id="page_pdf">
  <p ><?php echo $producto['producto_descripcion'] ?></p><br>
  <?php barcode('../../../public/barra/' . '587'. '.png', $producto['producto_codigoserial'], 15, 'horizontal', 'code128', true) ?>
              <img   src="../../../public/barra/<?php echo '587' ?>.png" style="width:60%;">


  </div>

</body>



</html>