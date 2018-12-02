<?php
    require_once "db.php"; //Toma el archivo de conexión a la BDD

    // Verifico si están deifnidos los datos mediante POST
    // y verifica si no están vacíos

    if (isset($_POST['id']) && $_POST['id'] != "")
      {
        //almaceno en variables
          $id = $_POST['id'];
          $tipo = 1; // 0 para insumo 1 para prod terminado

          echo "<br />" . $id;
          echo "<br />" . $tipo;

          $query = "
          INSERT INTO salidasgerente (tipo, idObjeto)
          SELECT '1', '$id' FROM DUAL
          WHERE NOT EXISTS (SELECT * FROM salidasgerente
                WHERE idObjeto='$id')
          LIMIT 1
          ";


          if (mysqli_query($conn, $query)) {
              echo "Creado correctamente";
                echo "<br />" . $id;
                echo "<br />" . $tipo;

            if (mysqli_affected_rows($conn)>0) {
              header("Location: ../g-bajaInsumos.php?msj=dbok");
            } else {
              header("Location: ../g-bajaInsumos.php?msj=pendant");
            }


          } else {
              echo "<br />Error: " . $query . "<br>" . mysqli_error($conn);
              echo "<br />" . $id;
              echo "<br />" . $tipo;
              header("Location: ../g-bajaInsumos.php?msj=dberror");
          }

        } else {
            echo "<br />" . $id;
            echo "<br />" . $tipo;
            header("Location: ../g-bajaInsumos.php?msj=varNoDefinidas");
    }







?>
