<?php

  require_once "funciones/db.php";
  include_once "templates/header.php";
  include_once "templates/navbarGerente.php";

  if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
    if ($estado == "insertSuccess") {
      echo "<script>alert('Registrado correctamente.');</script>";
    }

  }

?>
    <div class="col-12 col-md-9 col-lg-10 px-4 px-sm-5 pt-4 sidebar-left ">


      <div class="row mt-4">

        <div class="col-12 col-md-6">
          <h3>GERENTE</h3>
          <hr>
          <div class="rounded bg-light mx-auto p-2 mb-5">
            <h3></h3>
          </div>
        </div>


      </div>






    </div>
  </div>
</div>

<?php include_once "templates/scripts.php"?>
