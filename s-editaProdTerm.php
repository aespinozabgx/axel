<?php include_once "templates/header.php"?>
    <?php include_once "templates/navbarSupervisor.php"?>
    <style>
      .sidebar-left{
        position: relative;
      }
    </style>
    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Editar producto</h3>
      </div>

      <div class="row my-4">
        <div class="col-12 mx-auto">
          <table class="table table-hover table-responsive-md table-light rounded table-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Insumo</th>
                <th>Cantidad para producir</th>
                <th>Precio</th>
                <th>Imagen</th>
                <th colspan="2">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $consultaProductos = "SELECT a.id,a.nombre,a.descripcion,b.nombre as insumo,a.cantidadChico,a.precio,a.img FROM producto a INNER JOIN insumo b ON a.idInsumo=b.id";

                if($resultado=$conn->query($consultaProductos)){
                  while ($producto=mysqli_fetch_array($resultado)) {
                    echo '<tr>';
                    echo '<td>'.$producto[id].'</td>';
                    echo '<td>'.$producto[nombre].'</td>';
                    echo '<td>'.$producto[descripcion].'</td>';
                    echo '<td>'.$producto[insumo].'</td>';
                    echo '<td>'.$producto[cantidadChico].'</td>';
                    echo '<td>$'.$producto[precio].'</td>';
                    //echo '<td>'.$producto[imagen].'</td>';
                    //echo '<td><button type="button" class="btn btn-sm btn-secondary">Ver</button></td>';
                    echo '<td><button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#imagen-prod'.$producto[id].'">';
                    echo 'Ver';
                    echo '</button></td>';

                    echo '
                    <div class="modal fade" id="imagen-prod'.$producto[id].'">
                      <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img src="'.$producto[img].'" width="100%">
                          </div>
                        </div>
                      </div>
                    </div>';

                    echo '<td style="width: 8%">';
                    echo '<form action="s-editaProdTermSel.php" method="post">';
                    echo '<button type="submit" name="id" value="'.$producto[id].'" class="btn btn-sm btn-primary">';
                    echo 'Editar';
                    echo '</button>';
                    echo '</form>';
                    echo '</td>';

                    echo '<td style="width: 8%">';
                    echo '<form action="funciones/supervisor.php" method="post">';
                    echo '<input type="hidden" name="idel" value="'.$producto[id].'">';
                    echo '<button type="submit" name="accion" value="eliminarProdTerm" class="btn btn-sm btn-danger">';
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
          <p class="text-muted">*La cantidad mostrada para producir es para una talla chica, para una mediana se usa el doble y para una grande el triple</p>
          <?php
            if(isset($_GET["msj"]) && $_GET["msj"] == "actualizado") {
                  echo '<div class="alert alert-success">Producto actualizado</div>';
            }
            if(isset($_GET["error"]) && $_GET["error"] == "registro") {
                  echo '<div class="alert alert-danger">Error en registro</div>';
            }
            if(isset($_GET["msj"]) && $_GET["msj"] == "existencias") {
                  echo '<div class="alert alert-danger">No se puede eliminar el producto, aun hay unidades en almacén</div>';
            }
            if(isset($_GET["msj"]) && $_GET["msj"] == "eliminado") {
                  echo '<div class="alert alert-success">Registro eliminado</div>';
            }
            if(isset($_GET["error"]) && $_GET["error"] == "eliminacion") {
                  echo '<div class="alert alert-danger">No se pudo eliminar el registro</div>';
            }
            if(isset($_GET["msj"]) && $_GET["msj"] == "compras") {
                  echo '<div class="alert alert-danger">No se puede editar producto, hay compras de cliente pendientes</div>';
            }
          ?>

        </div>
      </div>




    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
