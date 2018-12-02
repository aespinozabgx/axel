<?php
    require_once "db.php"; //Toma el archivo de conexión a la BDD

    // Verifico si están deifnidos los datos mediante POST
    // y verifica si no están vacíos
    if (isset($_POST['tipoInsumo']) &&
        isset($_POST['ubicacionInsumo']) &&
        isset($_POST['cantidadInsumo']) &&
        $_POST['tipoInsumo'] != "" &&
        $_POST['ubicacionInsumo'] != "" &&
        $_POST['cantidadInsumo'] != ""
      ) {
        //almaceno en variables
          $tipoInsumo = $_POST['tipoInsumo'];
          $ubicacion = $_POST['ubicacionInsumo'];
          $cantidad = $_POST['cantidadInsumo'];

          echo $tipoInsumo . " <br />";
          echo $ubicacion . " <br />";
          echo $cantidad . " <br />";

          date_default_timezone_set('America/Mexico_City');
          $date = date('Y-m-d H:i:s');

          // ¡PENDIENTE !
          $query = "INSERT INTO `almaceninsumos` (`id`, `idInsumo`, `ubicacion`, `fechaAlta`) VALUES (NULL, '$tipoInsumo', '$ubicacion', '$date');";
          $sql = "";
          for ($i=0; $i < $cantidad; $i++) {
            $sql .= $query;
          }

          if (mysqli_multi_query($conn, $sql)) {
              echo "Creado correctamente";
              echo $cantidad;
              header("Location: ../g-registroInsumos.php?estado=insertSuccess");

          } else {
              echo "Error: " . $sql . "<br>" . mysqli_error($conn);
              header("Location: ../g-registroInsumos.php?estado=insertError");
          }

        } else {
        header("Location: ../g-registroInsumos.php?estado=varNoDefinidas");
    }







?>
