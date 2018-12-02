<?php
  require('db.php');
  if (!isset($_POST['cancelar'])) {
    header("Location: ../productos.php");
  }
  else {
    $cancelar = $_POST['cancelar'];
    session_start();
    $consultaId = "SELECT id FROM cliente WHERE correo='$_SESSION[usuario]'";
    $resultado = $conn->query($consultaId);
    $cliente = $resultado->fetch_assoc();
    $idCliente = $cliente[id];

    $eliminar = "DELETE FROM compra WHERE id='$cancelar' AND idCliente='$idCliente'";
    $conn->query($eliminar);
    $eliminados=$conn->affected_rows;

    if ($eliminados==1) {
      header("Location: ../historial.php?msj=eliminado");
    }
    else if ($eliminados==0) {
      header("Location: ../historial.php?error=accion");
    }

    $conn->close();
  }
?>
