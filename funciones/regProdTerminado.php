<?php
    require_once "db.php"; //Toma el archivo de conexión a la BDD

    // Verifico si están deifnidos los datos mediante POST
    // y verifica si no están vacíos
    if (isset($_POST['tipoProducto']) &&
        isset($_POST['ubicacionProducto']) &&
        isset($_POST['tallaProducto']) &&
        isset($_POST['colorProducto']) &&
        isset($_POST['cantidadProducto']) &&
        $_POST['tipoProducto'] != "" &&
        $_POST['ubicacionProducto'] != "" &&
        $_POST['tallaProducto'] != "" &&
        $_POST['colorProducto'] != "" &&
        $_POST['cantidadProducto'] != ""
      ) {
        //almaceno en variables
          $tipo = $_POST['tipoProducto'];
          $ubicacion = $_POST['ubicacionProducto'];
          $cantidad = $_POST['cantidadProducto'];
          $talla = $_POST['tallaProducto'];
          $color = $_POST['colorProducto'];
          $cantidad = $_POST['cantidadProducto'];

          echo "<br />" . $tipo;
          echo "<br />" . $ubicacion;
          echo "<br />" . $cantidad;
          echo "<br />" . $talla;
          echo "<br />" . $color;
          echo "<br />" . $cantidad;

          date_default_timezone_set('America/Mexico_City');
          $fecha = date('Y-m-d H:i:s');

          // ¡PENDIENTE !
          $query = "INSERT INTO `almacenproductos` (`id`, `idProducto`, `ubicacion`, `fechaAlta`, `talla`, `color`) VALUES (NULL, '$tipo', '$ubicacion', '$fecha', '$talla', '$color');";
          $sql="";
          for ($i=0; $i < $cantidad; $i++) {
            $sql .= $query;
          }

          if (mysqli_multi_query($conn, $sql)) {
              echo "Creado correctamente";
              echo $fecha;
              header("Location: ../g-registroInsumos.php?estado=insertSuccess");

          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              header("Location: ../g-registroInsumos.php?estado=insertError");
          }

        } else {
            echo "<br />" . $tipo;
            echo "<br />" . $ubicacion;
            echo "<br />" . $cantidad;
            echo "<br />" . $talla;
            echo "<br />" . $color;
            echo "<br />" . $cantidad;
        header("Location: ../g-registroInsumos.php?estado=varNoDefinidas");
    }
?>
