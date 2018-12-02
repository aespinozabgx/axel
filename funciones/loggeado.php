<?php
	session_start();
	if($_SESSION["logueado"] == TRUE) {
    if ($_SESSION["tipoUsuario"] == 1) {
      header("Location: g-ordenarCompra.php");
    }
    else if ($_SESSION["tipoUsuario"] == 2) {
      header("Location: s-autorizacionSalidas.php");
    }
    else if ($_SESSION["tipoUsuario"] == 3) {
      header("Location: productos.php");
    }
  }
?>
