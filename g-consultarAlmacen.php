<?php

  require_once "funciones/db.php";
  include_once "templates/header.php";
  include_once "templates/navbarGerente.php";

?>
       <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
      <h3>Insumos en almacén</h3>
      </div>

      <div class="row my-4">
        <div class="col-12 mx-auto">
          <table class="table table-hover table-responsive-md table-light rounded table-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th class="text-nowrap">Último movimiento</th>
              </tr>
            </thead>
            <tbody>
              <!--<tr>
                <th>0000</th>
                <td>Producto A</td>
                <td>Estante 1</td>
                <td>01/01/2019</td>
              </tr>-->
              <?php
              $query = mysqli_query($conn, "SELECT almaceninsumos.id, almaceninsumos.idInsumo, almaceninsumos.ubicacion, almaceninsumos.fechaAlta, insumo.nombre FROM almaceninsumos JOIN insumo ON almaceninsumos.idInsumo = insumo.id ORDER BY id");
              while ($f=mysqli_fetch_array($query))
              {
                echo "<tr>";
                echo "<td>" . $f['id'] . " </td>";
                echo "<td>" . $f['nombre'] . " </td>";
                echo "<td> Estante: " . $f['ubicacion'] . " </td>";
                echo "<td>" . $f['fechaAlta'] . " </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>


      <div class="row border-bottom">
        <h3>Producto terminado en almacén</h3>
      </div>

      <div class="row mt-4">
        <div class="col-12 mx-auto">
          <table class="table table-hover table-responsive-md table-light rounded table-sm">
            <thead>
              <tr>
                <th>ID</th>
                  <th>Nombre</th>
                <th>Descripción</th>
                <th>Ubicación</th>
                <th>Fecha Alta</th>
                <th>Talla</th>
                <th class="text-nowrap">Color</th>
              </tr>
            </thead>
            <tbody>
              <!--<tr>
                <th>0000</th>
                <td>Producto A</td>
                <td>Estante 1</td>
                <td>01/01/2019</td>
              </tr>-->
              <?php
              $query2 = mysqli_query($conn,
              "
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
                ORDER BY id
              ");
              while ($f2=mysqli_fetch_array($query2))
              {
                echo "<tr>";
                echo "<td>" . $f2['id'] . " </td>";
                echo "<td>" . $f2['nombre'] . " </td>";
                echo "<td>" . $f2['descripcion'] . " </td>";
                echo "<td> Estante: " . $f2['ubicacion'] . " </td>";
                echo "<td>" . $f2['fechaAlta'] . " </td>";
                echo "<td>" . $f2['talla'] . " </td>";
                echo "<td>" . $f2['color'] . " </td>";
                echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
