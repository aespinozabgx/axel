<?php include_once "templates/header.php"?>
    <?php include_once "templates/navbarSupervisor.php"?>
    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left">

      <div class="row border-bottom">
        <h3>Orden de producción</h3>
      </div>

      <div class="row mt-4">

        <div class="col-10 mx-auto">
          <div class="rounded bg-light mx-auto p-2 mb-2">
            <form action="funciones/supervisor.php" method="post">
              <div class="form-row">
                <div class="col-6">
                  <label class="mt-1">Producto: </label>
                  <select name="producto" class="custom-select" required>
                    <?php
                      $consultaProductos = "SELECT * FROM producto";
                      if($resultado=$conn->query($consultaProductos)){
                        while ($producto=$resultado->fetch_assoc()) {
                          echo '<option value="'.$producto[id].'">'.$producto[nombre].'</option>';
                        }
                      }
                    ?>
                  </select>
                </div>
                <div class="col-6">
                  <label class="mt-1">Cantidad de producto:</label><input type="number" min="1" name="cantidad" class="form-control" step="1" required>
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label class="mt-1">Color: </label>
                  <select name="color" class="custom-select" required>
                    <option value="ROJO">Rojo</option>
                    <option value="AMARILLO">Amarillo</option>
                    <option value="AZUL">Azul</option>
                    <option value="VERDE">Verde</option>
                  </select>
                </div>
                <div class="col">
                  <label class="mt-1">Talla: </label>
                  <select name="talla" class="custom-select" required>
                    <option value="C">Chica</option>
                    <option value="M">Mediana</option>
                    <option value="G">Grande</option>
                  </select>
                </div>
                <div class="col">
                  <label class="mt-1">Ubicación: </label>
                  <select name="ubicacion" class="custom-select" required>
                    <option value="1">Estante 1</option>
                    <option value="2">Estante 2</option>
                    <option value="3">Estante 3</option>
                  </select>
                </div>
              </div>

              <div class="form-row pt-3">
                <?php
                  $consultaInsumos = "SELECT * FROM insumo";
                  $resultado = $conn->query($consultaInsumos);
                  while ($insumo = $resultado->fetch_assoc()) {
                    $insumosAlmacen = "SELECT * FROM almaceninsumos WHERE idInsumo='$insumo[id]'";
                    $resultado1 = $conn->query($insumosAlmacen);
                    $count = mysqli_num_rows($resultado1);
                    echo '<div class="col">';
                    echo '<label class="mt-2 text-muted">Insumos ('.$insumo[nombre].') disponibles:</label>';
                    echo '<input type="text" class="form-control" value="'.$count.'" readonly>';
                    echo '</div>';
                  }
                ?>
              </div>

            <button type="submit" name="accion" value="ordenarProduccion" class="btn btn-primary w-100 mt-4 mb-2">Ordenar</button>
          </form>
        </div>




        <?php
          if(isset($_GET["msj"]) && $_GET["msj"] == "produccion") {
                echo '<div class="alert alert-success">Orden producida, revisa el almacen de productos</div>';
          }
          if(isset($_GET["msj"]) && $_GET["msj"] == "insumos") {
                echo '<div class="alert alert-danger">Insumos insuficientes, gerente necesita comprar a proveedor</div>';
          }
          if(isset($_GET["msj"]) && $_GET["msj"] == "maximo") {
                echo '<div class="alert alert-danger">La orden rebasa los 30 productos en almacen</div>';
          }
          if(isset($_GET["msj"]) && $_GET["msj"] == "lleno") {
                echo '<div class="alert alert-danger">El almacen ya cuenta con 30 productos</div>';
          }
          if(isset($_GET["error"]) && $_GET["error"] == "datos") {
                echo '<div class="alert alert-danger">Error en datos</div>';
          }
        ?>
      </div>

    </div>

    <div class="row border-bottom mt-3">
      <h3>Ultimas ordenes</h3>
    </div>
    <table class="table table-hover table-responsive-md table-light rounded table-sm my-4">
      <thead>
        <tr>
          <th>ID</th>
          <th>Producto</th>
          <th>Insumo</th>
          <th>Cantidad</th>
          <th>Insumos usados</th>
          <th>Color</th>
          <th>Talla</th>
          <th>Ubicación</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $consultaOrdenes = "SELECT a.id,b.nombre as pnombre,c.nombre as inombre,a.cantidad,a.cantidadInsumos,a.color,a.talla,a.ubicacion,a.fecha FROM ordenproduccion a INNER JOIN producto b ON a.idProducto=b.id INNER JOIN insumo c ON a.idInsumo=c.id ORDER BY fecha DESC LIMIT 5";
          if($resultado=$conn->query($consultaOrdenes)){
            while ($orden=mysqli_fetch_array($resultado)) {
              echo "<tr>";
              echo '<td>'.$orden[id].'</td>';
              echo '<td>'.$orden[pnombre].'</td>';
              echo '<td>'.$orden[inombre].'</td>';
              echo '<td>'.$orden[cantidad].'</td>';
              echo '<td>'.$orden[cantidadInsumos].'</td>';
              echo '<td>'.$orden[color].'</td>';
              echo '<td>'.$orden[talla].'</td>';
              echo '<td>'.$orden[ubicacion].'</td>';
              echo '<td>'.$orden[fecha].'</td>';
              echo "</tr>";
            }
          }
          else {
            echo "Error";
          }
        ?>
      </tbody>
    </table>


    <div class="row border-bottom mt-3">
      <h3>Almacén de productos</h3>
    </div>
    <table class="table table-hover table-responsive-md table-light rounded table-sm my-4">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Ubicación</th>
          <th>Talla</th>
          <th>Color</th>
          <th>Fecha de alta</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $consultaAlmacenP = "SELECT a.id,b.nombre,a.ubicacion,a.fechaAlta,a.talla,a.color FROM almacenproductos a INNER JOIN producto b ON a.idProducto=b.id  ORDER BY fechaAlta ASC";
          if($resultado1=$conn->query($consultaAlmacenP)){
            while ($productoAlmacen=mysqli_fetch_array($resultado1)) {
              echo "<tr>";
              echo '<td>'.$productoAlmacen[id].'</td>';
              echo '<td>'.$productoAlmacen[nombre].'</td>';
              echo '<td>'.$productoAlmacen[ubicacion].'</td>';
              echo '<td>'.$productoAlmacen[talla].'</td>';
              echo '<td>'.$productoAlmacen[color].'</td>';
              echo '<td>'.$productoAlmacen[fechaAlta].'</td>';
              echo "</tr>";
            }
          }
          else {
            echo "Error";
          }
          $conn->close();
        ?>
      </tbody>
    </table>

  </div>
</div>

<?php include_once "templates/scripts.php"?>
