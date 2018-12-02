<?php
  include_once "templates/header.php";
  include_once "templates/navbarGerente.php";
  require "funciones/db.php";
  require "funciones/metodos.php";
?>

    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">

      <div class="row border-bottom">
        <h3>Ubicación de insumos</h3>
      </div>

      <div class="row mt-4">

        <div class="col-12 col-sm-6 col-lg-4 mb-4 mx-auto">
          <div class="card" style="width: 100%;">
            <div class="card-header">
              <h6 class="text-center">Estante 1</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless table-light table-sm">
                <tbody>
                  <?php consultaAlmacen1(); ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>


        <div class="col-12 col-sm-6 col-lg-4 mb-4 mx-auto">
          <div class="card" style="width: 100%;">
            <div class="card-header">
              <h6 class="text-center">Estante 2</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless table-light table-sm">
                <tbody>
                  <?php consultaAlmacen2(); ?>
                </tbody>
              </table>
            </div>
            <!--<div class="card-footer">
              <form action="#">
                <div class="form-row">
                  <div class="col">
                    <input type="number" class="form-control" placeholder="Cantidad">
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-primary float-right">Comprar</button>
                  </div>
                </div>
              </form>
            </div>-->
          </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-4 mb-4 mx-auto">
          <div class="card" style="width: 100%;">
            <div class="card-header">
              <h6 class="text-center">Estante 3</h6>
            </div>
            <div class="card-body">
              <table class="table table-borderless table-light table-sm">
                <tbody>
                  <?php consultaAlmacen3(); ?>
                </tbody>
              </table>
            </div>
            <!--<div class="card-footer">
              <form action="#">
                <div class="form-row">
                  <div class="col">
                    <input type="number" class="form-control" placeholder="Cantidad">
                  </div>
                  <div class="col">
                    <button type="submit" class="btn btn-primary float-right">Comprar</button>
                  </div>
                </div>
              </form>
            </div>-->
          </div>
        </div>


      </div>

    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
