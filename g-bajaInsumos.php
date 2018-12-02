<?php
  require_once "funciones/db.php";
  include_once "funciones/metodos.php";
  include_once "templates/header.php";
  include_once "templates/navbarGerente.php";

  if (isset($_GET['msj'])) {
    $msj = $_GET['msj'];
    if ($msj == "dbok") {
      echo "<script>alert('Exito. Se liminará hasta que el supervisor lo autorice.');</script>";
    }
    if ($msj == "dberror") {
      echo "<script>alert('Error al insertar en la base de datos.');</script>";
    }
    if ($msj == "pendant") {
      echo "<script>alert('Ya se encuentra pendiente de eliminación');</script>";
    }
    if ($msj == "varNoDefinidas") {
      echo "<script>alert('Error. Faltan datos.');</script>";
    }
  }
?>
      <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">
        <div class="row mt-4">
          <div class="col-12 col-md-6">
          <h3>Baja de insumos</h3>
          <hr>
          <div class="rounded bg-light mx-auto p-2 mb-5">
            <form class="" action="funciones/bajaInsumos.php" method="post">
              <label class="mt-1">Insumo: </label>
              <select class="custom-select" name="idInsumo" required>
                <option value="">Seleccionar</option>
                <?php consultaBajaInsumos(); ?>
              </select>
              <input type="submit" name="" value="Registrar" class="btn btn-primary w-100 mt-4 mb-2" data-toggle="modal" data-target="#modalAut">
              </form>
          </div>
          </div>

          <div class="col-12 col-md-6">
            <h3>Baja de producto terminado</h3>
            <hr>
            <div class="rounded bg-light mx-auto p-2 mb-5">
              <form class="" action="funciones/bajaProdTerm.php" method="post">
                <label class="mt-1">Tipo de producto: </label>
                <select class="custom-select" name="id" required>
                  <option value="">Seleccionar</option>
                  <?php consultaBajaProdTerm(); ?>
                </select>
                <input type="submit" name="" value="Borrar" class="btn btn-primary w-100 mt-4 mb-2" data-toggle="modal" data-target="#modalAut">
                </form>
            </div>
          </div>



      </div>





    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
