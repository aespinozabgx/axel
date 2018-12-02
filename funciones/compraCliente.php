<?php
  date_default_timezone_set("America/Mexico_City");
  require "db.php";
  session_start();
  if (!isset($_POST['comprar']) && !isset($_POST['direccion']) && !isset($_POST['captcha'])) {
    header("Location: ../productos.php");
  }
  else {

    if ($_SESSION["captcha"] == $_POST["captcha"]) {

      $consultaId = "SELECT id FROM cliente WHERE correo='$_SESSION[usuario]'";
      $resultado = $conn->query($consultaId);
      $cliente = $resultado->fetch_assoc();
      $idCliente = $cliente[id];
      $fecha = date("Y-m-d H:i:s");
      $direccion = $_POST['direccion'];

      foreach ($_SESSION[producto] as $key => $value) {
        $idProducto=$_SESSION[idProducto][$key];
        $cantidad=$_SESSION[cantidad][$key];
        $color=$_SESSION[color][$key];
        $talla=$_SESSION[talla][$key];
        $importe=$_SESSION[importe][$key];

        $realizarCompra="INSERT INTO compra (idCliente,idProducto,cantidad,color,talla,importe,fecha,direccion,estado)
        VALUES ('$idCliente','$idProducto','$cantidad','$color','$talla','$importe','$fecha','$direccion',0)";
        $conn->query($realizarCompra);
      }

      unset($_SESSION[producto]);
      unset($_SESSION[idProducto]);
      unset($_SESSION[cantidad]);
      unset($_SESSION[color]);
      unset($_SESSION[talla]);
      unset($_SESSION[importe]);

      header("Location: ../historial.php?msj=comprado");
    }
    else {
      header("Location: ../carrito.php?msj=captcha");
    }

  }
  /*require "funciones/db.php";
  session_start();

    foreach ($_SESSION[producto] as $key => $value) {
      $realizarCompra = "INSERT INTO compra (idCliente,idProducto,cantidad,color,)";
        echo '<td>'.$_SESSION[producto][$key].'</td>';
        echo '<td>'.$_SESSION[talla][$key].'</td>';
        echo '<td>'.$_SESSION[color][$key].'</td>';
        echo '<td>'.$_SESSION[cantidad][$key].'</td>';
        echo '<td>$'.$_SESSION[importe][$key].'</td>';
    }*/
?>
