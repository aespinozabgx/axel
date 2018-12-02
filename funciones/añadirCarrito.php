<?php
  if (!isset($_POST['idp']) && !isset($_POST['nombrep']) && !isset($_POST['precio']) && !isset($_POST['talla']) && !isset($_POST['color']) && !isset($_POST['cantidad'])) {
    header("Location: ../productos.php");
  }
  else {
    $idProducto = $_POST['idp'];
    $nombre = $_POST['nombrep'];
    $precio = $_POST['precio'];
    $talla = $_POST['talla'];
    $color = $_POST['color'];
    $cantidad = $_POST['cantidad'];
    $importe = $precio*$cantidad;
    //$this->prt->setPrecio(number_format($_POST["precio"], 2, '.', ''));
    
    echo $idProducto." ".$precio." ".$talla." ".$color." ".$cantidad." ".$importe;

    session_start();

    if (in_array($idProducto, $_SESSION[idProducto])) {
      header("Location: ../carrito.php?msj=ya_agregado");
    }
    else {
      $_SESSION[producto][] = $nombre;
      $_SESSION[idProducto][] = $idProducto;
      $_SESSION[cantidad][] = $cantidad;
      $_SESSION[color][] = $color;
      $_SESSION[talla][] = $talla;
      $_SESSION[importe][] = number_format($importe, 2, '.', '');
      var_dump($_SESSION);

      header("Location: ../carrito.php");
    }
  }

?>
