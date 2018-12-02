<?php

  require_once "funciones/db.php";
  include_once "templates/header.php";
  include_once "templates/navbarGerente.php";

?>
    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Ventas</h3>
      </div>

      <div class="row my-4">
        <div class="col-12 mx-auto">
          <table class="table table-hover table-responsive-md table-light rounded table-sm">
            <thead>
              <tr>
                <th>ID cliente</th>
                <th>Correo</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Importe</th>
                <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              <!--
              <tr>
                <td>0000</td>
                <td>abc@abc.com</td>
                <td>Producto A</td>
                <td>0</td>
                <td>$0.00</td>
                <td>Pendiente</td>
              </tr>
              -->
              <?php // MODIFICAR EL QUERY Y LOS NOMBRES DE LA BDD
              $query = mysqli_query($conn, "
              SELECT
                  compra.id,
                  compra.idCliente,
                  compra.idProducto,
                  compra.cantidad,
                  compra.color,
                  compra.talla,
                  compra.importe,
                  compra.fecha,
                  compra.direccion,
                  compra.estado,
                  cliente.id as cId,
                  cliente.correo,
                  cliente.nombre
              FROM
                  compra
              JOIN cliente
              ON compra.idCliente = cliente.id
              ");
              while ($f=mysqli_fetch_array($query))
              {
                echo "<tr>";
                echo "<td>" . $f['idCliente'] . " </td>";
                echo "<td>" . $f['correo'] . " </td>";
                echo "<td>" . $f['idProducto'] . " </td>";
                echo "<td>" . $f['cantidad'] . " </td>";
                echo "<td>" . $f['importe'] . " </td>";
                if ($f['estado']==0) {
                  echo "<td>Pendiente</td>";
                  echo "</tr>";
                } else {
                  echo "<td>En proceso </td>";
                  echo "</tr>";
                }
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
