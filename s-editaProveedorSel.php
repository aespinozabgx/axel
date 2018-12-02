<?php include_once "templates/header.php"?>
<?php include_once "templates/navbarSupervisor.php"?>

<?php
  if(!isset($_POST["id"]))
  {
    header("Location: s-editaProveedores.php");
  }
  else {
    $id = $_POST["id"];
    $buscarProveedor = "SELECT * FROM proveedor WHERE id='$id'";
    $resultado = $conn->query($buscarProveedor);
    $proveedor=$resultado->fetch_assoc();
  }

?>

    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Editando proveedor: <?php echo $proveedor["nombre"];?></h3>
      </div>

      <div class="row mt-4">

        <div class="col-10 mx-auto">
          <div class="rounded bg-light mx-auto p-2 mb-5">
            <form class="" action="funciones/supervisor.php" method="post">
              <input type="hidden" name="id" value="<?php echo $proveedor["id"];?>">
              <label class="mt-1">Nombre: </label><input type="text" name="nombre" class="form-control" required value="<?php echo $proveedor["nombre"];?>">
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
                <div class="col-3">
                  <label class="mt-1">Mínimo: </label><input type="number" name="minimo" min="0" step="1" class="form-control" required value="<?php echo $proveedor["minimo"];?>">
                </div>
                <div class="col-3">
                  <label class="mt-1">Máximo: </label><input type="number" name="maximo" min="0" step="1" class="form-control" required value="<?php echo $proveedor["maximo"];?>">
                </div>
              </div>

              <div class="form-row">
                <div class="col">
                  <label class="mt-1">Precio: </label><input type="number" name="precio" step="0.01" min="0.00" class="form-control" required value="<?php echo $proveedor["costo"];?>">
                </div>
                <div class="col">
                  <label class="mt-1">Entrega en días: </label><input type="number" name="tiempoEntrega" step="1" min="0" class="form-control" required value="<?php echo $proveedor["tiempoEntrega"];?>">
                </div>
              </div>
              <button type="submit" name="accion" value="editarProveedor" class="btn btn-primary w-100 mt-4 mb-2">Editar</button>
              </form>
          </div>
        </div>


      </div>




    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
