<?php include_once "templates/header.php"?>
    <?php include_once "templates/navbarSupervisor.php"?>
    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Editar proveedores</h3>
      </div>

      <div class="row my-4">
        <div class="col-12 mx-auto">
          <table class="table table-hover table-responsive-md table-light rounded table-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Insumo</th>
                <th>Precio</th>
                <th>Min/Max</th>
                <th class="text-nowrap">Tiempo de entrega (días)</th>
                <th colspan="2">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $consultaProveedores = "SELECT * FROM proveedor";
                if($resultado=$conn->query($consultaProveedores)){
                  while ($proveedor=mysqli_fetch_array($resultado)) {
                    echo '<tr>';
                    echo '<td>'.$proveedor[id].'</td>';
                    echo '<td>'.$proveedor[nombre].'</td>';
                    echo '<td>'.$proveedor[idInsumo].'</td>';
                    echo '<td>'.$proveedor[costo].'</td>';
                    echo '<td>'.$proveedor[minimo].'/'.$proveedor[maximo].'</td>';
                    echo '<td>'.$proveedor[tiempoEntrega].'</td>';

                    echo '<td style="width: 8%">';
                    echo '<form action="s-editaProveedorSel.php" method="post">';
                    echo '<button type="submit" name="id" value="'.$proveedor[id].'" class="btn btn-sm btn-primary">';
                    echo 'Editar';
                    echo '</button>';
                    echo '</form>';
                    echo '</td>';

                    echo '<td style="width: 8%">';
                    echo '<form action="funciones/supervisor.php" method="post">';
                    echo '<input type="hidden" name="idel" value="'.$proveedor[id].'">';
                    echo '<button type="submit" name="accion" value="eliminarProveedor" class="btn btn-sm btn-danger">';
                    echo 'Eliminar';
                    echo '</button>';
                    echo '</form>';

                    echo '</td>';

                  }
                }
                $conn->close();

                echo '</tr>';
              ?>


            </tbody>
          </table>
          <?php
            if(isset($_GET["msj"]) && $_GET["msj"] == "actualizado") {
                  echo '<div class="alert alert-success">Proveedor actualizado</div>';
            }
            if(isset($_GET["error"]) && $_GET["error"] == "registro") {
                  echo '<div class="alert alert-danger">Error en registro</div>';
            }
            if(isset($_GET["msj"]) && $_GET["msj"] == "minmax") {
                  echo '<div class="alert alert-danger">Mínimo mayor que máximo</div>';
            }
            if(isset($_GET["msj"]) && $_GET["msj"] == "eliminado") {
                  echo '<div class="alert alert-success">Registro eliminado</div>';
            }
            if(isset($_GET["error"]) && $_GET["error"] == "eliminacion") {
                  echo '<div class="alert alert-danger">No se pudo eliminar el registro</div>';
            }
          ?>
        </div>
      </div>




    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
