<?php


    function validaMaxMin($max, $min, $cantidad){
      if ($cantidad <= $max && $cantidad >= $min) {
        return 1;
      } else {
        return 0;
      }
    }


    function consultaAlmacen1 () {
        global $conn;
        $query = mysqli_query($conn, "
        SELECT
            almacenproductos.id,
            almacenproductos.idProducto,
            almacenproductos.ubicacion,
            almacenproductos.fechaAlta,
            almacenproductos.talla,
            almacenproductos.color,
            producto.nombre,
            producto.descripcion
        FROM
            almacenproductos
        JOIN producto ON almacenproductos.idProducto = producto.id
        WHERE almacenproductos.ubicacion = 1
        ");


        $productos = [];  // creo vector vacio
        $conteo = 0; // variable para contar

        while ($f=mysqli_fetch_array($query)) {
          $productos[$conteo] = $f['nombre']; //Meto a un vector todos los valores
          $conteo++;
        }

        if (empty($productos)) {
          echo "<tr>
            <td>
              No hay productos registrados.
            </td>
          </tr>";
        } else {
          //consulto cantidad de x producto y la agrupo
          $valores = $productos;
          $contagem = array_count_values($valores);
          foreach($contagem AS $numero => $vezes) {
            if($vezes > 0) {
              echo "<tr>
                <td>". $numero . " </td>
                <td>" . $vezes . " </td>
              </tr>";

            }
          }
      }
    }

    function consultaAlmacen2 () {
        global $conn;
        $query = mysqli_query($conn, "
        SELECT
            almacenproductos.id,
            almacenproductos.idProducto,
            almacenproductos.ubicacion,
            almacenproductos.fechaAlta,
            almacenproductos.talla,
            almacenproductos.color,
            producto.nombre,
            producto.descripcion
        FROM
            almacenproductos
        JOIN producto ON almacenproductos.idProducto = producto.id
        WHERE almacenproductos.ubicacion = 2
        ");


        $productos = [];  // creo vector vacio
        $conteo = 0; // variable para contar

        while ($f=mysqli_fetch_array($query)) {
          $productos[$conteo] = $f['nombre']; //Meto a un vector todos los valores
          $conteo++;
        }
        if (empty($productos)) {
          echo "
          <tr>
            <td>
              No hay productos registrados.
            </td>
          </tr>
          ";
        } else {
          //consulto cantidad de x producto y la agrupo
          $valores = $productos;
          $contagem = array_count_values($valores);
          foreach($contagem AS $numero => $vezes) {
            if($vezes > 0) {
              echo "<tr>
                <td>" . $numero . " </td>
                <td>" . $vezes  . " </td>
              </tr>";

            }
          }
      }
    }


    function consultaAlmacen3 () {
        global $conn;
        $query = mysqli_query($conn, "
        SELECT
            almacenproductos.id,
            almacenproductos.idProducto,
            almacenproductos.ubicacion,
            almacenproductos.fechaAlta,
            almacenproductos.talla,
            almacenproductos.color,
            producto.nombre,
            producto.descripcion
        FROM
            almacenproductos
        JOIN producto ON almacenproductos.idProducto = producto.id
        WHERE almacenproductos.ubicacion = 3
        ");


        $productos = [];  // creo vector vacio
        $conteo = 0; // variable para contar

        while ($f=mysqli_fetch_array($query)) {
          $productos[$conteo] = $f['nombre']; //Meto a un vector todos los valores
          $conteo++;
        }
        if (empty($productos)) {
          echo "<tr>
            <td>
              No hay productos registrados.
            </td>
          </tr>";
        } else {
          //consulto cantidad de x producto y la agrupo
          $valores = $productos;
          $contagem = array_count_values($valores);
          foreach($contagem AS $numero => $vezes) {
            if($vezes > 0) {
              echo "<tr>
                <td>". $numero . " </td>
                <td>" . $vezes . " </td>
              </tr>";

            }
          }
      }
    }
    // esta no se ocupará
    function consultaAlmacenProdTerminado() {
        global $conn;
        $query = mysqli_query($conn, "
          SELECT
              almacenproductos.id,
              almacenproductos.idProducto,
              almacenproductos.ubicacion,
              almacenproductos.fechaAlta,
              producto.id,
              producto.nombre
          FROM
              almacenproductos
          JOIN producto ON almacenproductos.id = producto.id
        ");


        $productos = [];  // creo vector vacio
        $idProductos = [];
        $conteo = 0; // variable para contar

        while ($f=mysqli_fetch_array($query)) {
          $productos[$conteo] = $f['nombre']; //Meto a un vector todos los valores
          $idProductos[$conteo] = $f['id'];
          $conteo++;
        }

        //print_r ($idProductos);

        //for ($i=0; $i < $conteo; $i++) {
        //  echo "<br />Producto: " . $productos[$i] . " - id: " . $idProductos[$i];
        //}

        if (empty($productos)) {
          echo "<h2>No hay productos registrados.</h2>";
        } else {
          //consulto cantidad de x producto y la agrupo
          $contagem = array_count_values($productos);
          $conteo=1;

          foreach($contagem AS $nombre => $vezes) {
            if($vezes > 0) {

              $clave = array_search($nombre, $productos, true);
              //echo "<br />" . $nombre . " - " . $clave;
              echo "<option value='" . $idProductos[$clave] . "'>" . $nombre . "</option>";
              //echo "<br />Resultado -> " . $nombre . " - >" . $idProductos[$clave];
              //echo "<br />idProducto: " . $idProductos;4

            }
            $conteo+=1;
          }
       }
    }


    function consultaAlmacenInsumos () {
        global $conn;
        $query = mysqli_query($conn, "
          SELECT
          	almaceninsumos.id,
            almaceninsumos.idInsumo,
            almaceninsumos.ubicacion,
            almaceninsumos.fechaAlta,
            insumo.id,
            insumo.nombre
          FROM
              almaceninsumos
          JOIN insumo ON almaceninsumos.idInsumo = insumo.id
        ");


        $productos = [];  // creo vector vacio
        $idProductos = [];
        $conteo = 0; // variable para contar

        while ($f=mysqli_fetch_array($query)) {
          $productos[$conteo] = $f['nombre']; //Meto a un vector todos los valores
          $idProductos[$conteo] = $f['id'];
          $conteo++;
        }

        //print_r ($idProductos);

        //for ($i=0; $i < $conteo; $i++) {
        //  echo "<br />Producto: " . $productos[$i] . " - id: " . $idProductos[$i];
        //}

        if (empty($productos)) {
          echo "<h2>No hay productos registrados.</h2>";
        } else {
          //consulto cantidad de x producto y la agrupo
          $contagem = array_count_values($productos);
          $conteo=1;

          foreach($contagem AS $nombre => $vezes) {
            if($vezes > 0) {

              $clave = array_search($nombre, $productos, true);
              //echo "<br />" . $nombre . " - " . $clave;
              echo "<option value='" . $idProductos[$clave] . "'>" . $nombre . "</option>";
              //echo "<br />Resultado -> " . $nombre . " - >" . $idProductos[$clave];
              //echo "<br />idProducto: " . $idProductos;4

            }
            $conteo+=1;
          }
       }
    }

    function consultaProveedor(){
      global $conn;
      $query = mysqli_query ($conn, "
        SELECT
            proveedor.id,
            proveedor.nombre,
            proveedor.idInsumo,
            proveedor.costo,
            proveedor.maximo,
            proveedor.minimo,
            proveedor.tiempoEntrega,
            insumo.id,
            insumo.nombre as nombreIns
        FROM
            `proveedor`
        JOIN insumo
        ON proveedor.idInsumo = insumo.id
      ");

      $proveedor = [];
      $i = 0;

      while ($g = mysqli_fetch_assoc($query)) {
        echo '<form class="" action="funciones/regInsumos.php" method="post">';

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo  "
              <div class='form-group'>
                <label>Proveedor: </label>
              ";
        echo "<input type='text' class='form-control' name='tipoInsumo' required value='";
        echo $g['nombreIns'];
        echo "'";
        echo "</div>";

        echo "</form>";
      }

    }


    function consultaBajaInsumos () {
        global $conn;
        $query1 = mysqli_query($conn, "
          SELECT
              almaceninsumos.id,
              almaceninsumos.ubicacion,
              almaceninsumos.idInsumo,
              almaceninsumos.fechaAlta,
              insumo.nombre
          FROM
              almaceninsumos
          JOIN insumo
          ON almaceninsumos.idInsumo = insumo.id
        ");



        while ($f=mysqli_fetch_array($query1)) {
          echo "<option value='";
          echo $f['id'] . "'>";
          echo $f['id'] . " - ";
          echo $f['nombre'] . " - ";
          echo $f['fechaAlta'];
          echo "</option>";
        }

        echo $f;
        //print_r ($idProductos);

        //for ($i=0; $i < $conteo; $i++) {
        //  echo "<br />Producto: " . $productos[$i] . " - id: " . $idProductos[$i];
        //}

    }


    function consultaBajaProdTerm () {
        global $conn;
        $query = mysqli_query($conn, "
          SELECT
              almacenproductos.id,
              almacenproductos.idProducto,
              almacenproductos.ubicacion,
              almacenproductos.fechaAlta,
              almacenproductos.talla,
              almacenproductos.color,
              producto.nombre
          FROM
              almacenproductos
          JOIN producto ON almacenproductos.idProducto = producto.id
        ");



        while ($f=mysqli_fetch_array($query)) {
          echo "<option value='" . $f['id'] . "'>" . $f['id'] . " - " . $f['nombre'] . " - " . $f['ubicacion'] . " - " . $f['fechaAlta'] . " - " . $f['talla'] . " - " . $f['color'] . "</option>";
        }

        //print_r ($idProductos);

        //for ($i=0; $i < $conteo; $i++) {
        //  echo "<br />Producto: " . $productos[$i] . " - id: " . $idProductos[$i];
        //}

        if (empty($productos)) {
          echo "<h2>No hay Producto Terminado Registrado.</h2>";
        } else {
          echo "<option>" . $f['nombre'] . " - " . $f[''] . "</option>";
       }
    }

    function consultaProducto () {
      global $conn;
      $query = mysqli_query($conn, "SELECT * from producto");
      while ($f=mysqli_fetch_array($query)) {
        echo $f['nombre'] . " " . $f['descripcion'] . " " . $f['precio'];
        echo "<img src='" . $f['img'] . "' />";
      }
    }

    function consultaHistorial ($idCliente) {
      global $conn;
      $consultaCompras = "SELECT a.id,a.idCliente,c.correo,a.idProducto,b.nombre,a.cantidad,a.color,a.talla,a.importe,a.fecha,a.estado,a.direccion FROM compra a INNER JOIN producto b ON a.idProducto=b.id INNER JOIN cliente c ON a.idCliente=c.id WHERE a.idCliente='$idCliente' ORDER BY a.fecha ASC";
      if($resultado=$conn->query($consultaCompras)){
        while ($compra=mysqli_fetch_array($resultado)) {
          echo "<tr>";
          echo '<td>'.$compra[id].'</td>';
          echo '<td>'.$compra[nombre].'</td>';
          echo '<td>'.$compra[cantidad].'</td>';
          echo '<td>'.$compra[color].'</td>';
          echo '<td>'.$compra[talla].'</td>';
          echo '<td>$'.$compra[importe].'</td>';
          echo '<td>'.$compra[direccion].'</td>';
          echo '<td>'.$compra[fecha].'</td>';
          if ($compra[estado] == 0) {
            //echo '<td class="text-danger">Pendiente</td>';

            echo '<td><button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#cancelar'.$compra[id].'">';
            echo 'Cancelar';
            echo '</button></td>';

            echo '
            <div class="modal fade" id="cancelar'.$compra[id].'">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>¿Estas seguro de cancelar esta compra? (ID: '.$compra[id].')</p>

                  </div>
                  <div class="modal-footer">
                    <form action="funciones/cancelarCompra.php" method="post">
                      <button type="submit" name="cancelar" value="'.$compra[id].'" class="btn btn-danger">Si, cancelar esta compra</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>';

          }
          else {
            echo '<td class="text-muted">Entregado</td>';
          }
          echo "</tr>";
        }
      }
      else {
        echo "Error";
      }
    }

    function consultaPuntoReorden(){
      global $conn;
      $query = mysqli_query($conn, "SELECT count(*) as total from almaceninsumos");
        if ($f=mysqli_fetch_array($query)) {
          if ($f['total'] < 10) {
            echo "<p class='text-nowrap' style='color:red;'><strong>¡Insumos menores a 10!</strong></p>";
          } else {
            echo "<p class='text-nowrap'><strong>Sin notificaciones</strong></p>";
          }
        }
    }



?>
