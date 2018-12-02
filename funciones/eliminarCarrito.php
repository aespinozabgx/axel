<?php
if (!isset($_POST['indice'])) {
  header("Location: ../productos.php");
}
else {
  $indice = $_POST['indice'];
  session_start();
  unset($_SESSION[producto][$indice]);
  unset($_SESSION[idProducto][$indice]);
  unset($_SESSION[cantidad][$indice]);
  unset($_SESSION[color][$indice]);
  unset($_SESSION[talla][$indice]);
  unset($_SESSION[importe][$indice]);
  header("Location: ../carrito.php");
}
?>
