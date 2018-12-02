<?php include_once "templates/header.php"?>
    <div class="container-fluid text-light bgimg h-100">

      <div class="row fixed-top">
        <div class="col">
          <ul class="nav justify-content-end"> <!--flex-column-->
            <li class="nav-item"><a href="inicioSesion.php" class="nav-link text-light">Iniciar sesión</a></li>
            <li class="nav-item"><a href="registro.php" class="nav-link text-light">Regístrarse</a></li>
          </ul>
        </div>
      </div>

      <div class="row justify-content-center align-items-end mb-2" style="height: 250px">
        <h1>Sistema de inventarios</h1>
      </div>

      <div class="row justify-content-center align-items-center mt-5">
          <a href="productos.php" class="btn btn-outline-light p-2 w-25">Productos</a>
      </div>

    </div>
<?php include_once "templates/scripts.php"?>
