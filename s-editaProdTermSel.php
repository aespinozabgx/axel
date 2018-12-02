<?php include_once "templates/header.php"?>
<?php include_once "templates/navbarSupervisor.php"?>
<?php
  if(!isset($_POST["id"]))
  {
    header("Location: s-editaProdTerm.php");
  }
  else {
    $id = $_POST["id"];
    $buscarProducto = "SELECT * FROM producto WHERE id='$id'";
    $resultado = $conn->query($buscarProducto);
    $producto=$resultado->fetch_assoc();
  }

?>

    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Editando producto: <?php echo $producto["nombre"];?></h3>
      </div>

      <div class="row mt-4">

        <div class="col-10 mx-auto">
          <div class="rounded bg-light mx-auto p-2 mb-5">
            <form action="funciones/supervisor.php" method="post">
              <input type="hidden" name="id" value="<?php echo $producto["id"];?>">
              <label class="mt-1">Nombre: </label><input type="text" value="<?php echo $producto["nombre"];?>" name="nombre" class="form-control" required>
              <label class="mt-1">Descripción: </label><textarea name="descripcion" class="form-control" required><?php echo $producto["descripcion"];?></textarea>

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
                  <label class="mt-1">Insumos para producir talla pequeña:</label><input type="number" min="1" name="cantidad" class="form-control" step="1" required value="<?php echo $producto["cantidadChico"];?>">
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label class="mt-1">Precio: </label><input type="number" value="<?php echo $producto["precio"];?>" name="precio" class="form-control" step="0.01" required>
                </div>
                <div class="col">
                  <label class="mt-1">Imagen:</label><input type="file" accept="image/png,image/jpeg" name="imagen" class="form-control-file" required>
                </div>
              </div>

              <button type="submit" name="accion" value="editarProdTerm" class="btn btn-primary w-100 mt-4 mb-2">Editar</button>
            </form>

          </div>
        </div>


      </div>




    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
