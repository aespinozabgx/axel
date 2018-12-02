<?php include_once "templates/header.php"?>
    <?php include_once "templates/navbarSupervisor.php"?>
    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Registro de tipo de producto</h3>
      </div>

      <div class="row mt-4">

        <div class="col-10 mx-auto">
          <div class="rounded bg-light mx-auto p-2 mb-5">
            <form action="funciones/supervisor.php" method="post">
              <label class="mt-1">Nombre: </label><input type="text" name="nombre" class="form-control" required>
              <label class="mt-1">Descripción: </label><textarea name="descripcion" class="form-control" required></textarea>

              <div class="form-row">
                <div class="col-6">
                  <label class="mt-1">Insumo que vende: </label>
                  <select name="insumo" class="custom-select" required>
                    <?php
                      $consultaInsumos = "SELECT * FROM insumo";
                      if($resultado=$conn->query($consultaInsumos)){
                        while ($insumo=mysqli_fetch_array($resultado)) {
                          echo '<option value="'.$insumo[id].'">'.$insumo[nombre].'</option>';
                        }
                      }
                      $conn->close();
                    ?>

                  </select>
                </div>
                <div class="col-6">
                  <label class="mt-1">Insumos para producir talla pequeña:</label><input type="number" min="1" name="cantidad" class="form-control" step="1" required>
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label class="mt-1">Precio: </label><input type="number" name="precio" class="form-control" min="0.01" step="0.01" required>
                </div>
                <div class="col">
                  <label class="mt-1">Imagen:</label><input type="file" name="imagen" class="form-control-file"required>
                </div>
              </div>

              <button type="submit" name="accion" value="registrarProdTerm" class="btn btn-primary w-100 mt-4 mb-2">Registrar</button>
            </form>
            <?php
              if(isset($_GET["error"]) && $_GET["error"] == "registro") {
                    echo '<div class="alert alert-danger">Error en registro</div>';
              }
              if(isset($_GET["msj"]) && $_GET["msj"] == "registrado") {
                    echo '<div class="alert alert-success">Producto registrado a tienda</div>';
              }
            ?>
          </div>
        </div>


      </div>




    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
