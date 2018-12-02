<?php
    require_once "db.php"; //Toma el archivo de conexión a la BDD
    require_once "metodos.php";
    // Verifico si están deifnidos los datos mediante POST
    // y verifica si no están vacíos
    if (isset($_POST['idInsumo']) &&
        isset($_POST['idProveedor']) &&
        isset($_POST['cantidad']) &&
        isset($_POST['importe']) &&
        isset($_POST['minimoVenta']) &&
        isset($_POST['maximoVenta'])
      )
      {
          //almaceno en variables
          $idInsumo = $_POST['idInsumo'];
          $idProveedor = $_POST['idProveedor'];
          $cantidad = $_POST['cantidad'];
          $importe = $_POST['importe'];
          $max = $_POST['maximoVenta'];
          $min = $_POST['minimoVenta'];


          if(validaMaxMin($max, $min, $cantidad)){
            $importe= $importe*$cantidad;
            $sql= mysqli_query($conn, "INSERT INTO comprainsumos (`id`, `idInsumo`, `idProveedor`, `cantidad`, `importe`, `estado`) VALUES (NULL, '$idInsumo', '$idProveedor', '$cantidad', '$importe', '0')");

            if ($sql) {
              //echo "<script>alert('CORRECTO');</script>";
              header("Location: ../g-ordenarCompra.php?estado=insertSuccess");
            } else {
              //echo "<script>alert('Error');</script>";
              header("Location: ../g-ordenarCompra.php?estado=insertError");
            }
          } else {
            header("Location: ../g-ordenarCompra.php?estado=minMaxError");
          }
    } else {
    header("Location: ../g-ordenarCompra.php?estado=varNoDefinidas");
    }







?>
