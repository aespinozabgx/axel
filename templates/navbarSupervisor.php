<?php
	require('funciones/db.php');
	session_start();
	if($_SESSION["logueado"] != TRUE || $_SESSION["tipoUsuario"] != 2) {
    header("Location: inicioSesion.php");
  }
?>

<style>
	.scroll{
		height: auto;
		max-height: 250px;
		overflow-x: hidden;
	}
	.sidebar-left{
		position: sticky;
		overflow-x: hidden;
    overflow-y: auto;
	}
</style>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <span class="navbar-brand text-light">Supervisor</span>

  <!--toggle-->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navTog">
    <span class="navbar-toggler-icon"></span>
  </button>
  <!--toggle-->

  <div class="collapse navbar-collapse" id="navTog">
    <ul class="navbar-nav ml-auto">

      <li class="nav-item mt-3 d-md-none">
        <a class="nav-link" href="s-autorizacionSalidas.php">
          <img src="img/ico/s12.png" class="mr-2">Autorizar salida
        </a>
      </li>

			<li class="nav-item mt-3 d-md-none">
        <a class="nav-link" href="s-ordenProduccion.php">
          <img src="img/ico/s42.png" class="mr-2">Orden de producción
        </a>
      </li>

      <li class="nav-item mt-3 d-md-none">
        <a class="nav-link" href="s-registroProveedores.php">
          <img src="img/ico/s22.png" class="mr-2">Registrar proveedores
        </a>
      </li>

      <li class="nav-item mt-3 d-md-none">
        <a class="nav-link" href="s-editaProveedores.php">
          <img src="img/ico/s32.png" class="mr-2">Editar proveedores
        </a>
      </li>

      <li class="nav-item mt-3 d-md-none">
        <a class="nav-link" href="s-registroProdTerm.php">
          <img src="img/ico/s22.png" class="mr-2">Registrar producto
        </a>
      </li>

      <li class="nav-item mt-3 d-md-none border-bottom">
        <a class="nav-link" href="s-editaProdTerm.php">
          <img src="img/ico/s32.png" class="mr-2">Editar producto
        </a>
      </li>

			<li class="nav-item mt-2 mr-md-3 pr-4">
				<img src="img/ico/not.png">
				<span class=" text-light ml-1">Salidas pendientes</span>
				<?php
					$consultaCompras = "SELECT * FROM compra WHERE estado=0";
					$resultado = $conn->query($consultaCompras);
					$count = mysqli_num_rows($resultado);
				?>
				<span class="badge badge-pill badge-primary"><?php echo $count;?></span>

			</li>

			<li class="nav-item dropdown pr-4">
        <a class="nav-link" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
					<img src="img/ico/reo.png">
					<span class=" text-light ml-1">Punto de reorden</span>
					<?php
						$consultaProductos = "SELECT * FROM almacenproductos";
						$resultado = $conn->query($consultaProductos);
						$cantidadProductos = mysqli_num_rows($resultado);
					?>

						<?php
						 	if ($cantidadProductos<=10) {
								echo '<span class="badge badge-pill badge-danger">';
								echo "1";
								echo '</span>';
						 	}
						?>

        </a>
        <div class="dropdown-menu dropdown-menu-right">
					<?php
						if ($cantidadProductos<=10){
					?>
          <div class="dropdown-item">
            <h6>Punto de reorden</h6>
            <p>El almacen cuenta con 10 o menos de productos (<?php echo $cantidadProductos ?>)</p>
						<a href="s-ordenProduccion.php" class="mb-4">> Generar una nueva orden de producción</a>
						<!--<p class="text-muted">> Generar una nueva orden de producción</p>-->
          </div>
					<?php
						}
						else{
					?>
          <div class="dropdown-item">
            <h6>¡Todo normal!</h6>
            <p class="text-muted">El almacen cuenta con <?php echo $cantidadProductos ?> productos</p>
          </div>
					<?php } ?>
        </div>
      </li>

      <!--<li class="nav-item dropdown">
        <a class="nav-link" href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
          <img src="img/ico/not.png">
          <span class="d-md-none pr-1">Notificaciones</span>
					<span class="badge badge-pill badge-danger">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right scroll">
          <div class="dropdown-item">
            <h6>Salida pendiente</h6>
            <p class="text-nowrap text-primary">Insumos - Tipo A: X</p>
            <p class="text-muted">01/01/2019 - 00:00</p>
          </div>
          <div class="dropdown-divider"></div>

					<div class="dropdown-item">
            <h6>Salida pendiente</h6>
            <p class="text-nowrap text-primary">Insumos - Tipo A: X</p>
            <p class="text-muted">01/01/2019 - 00:00</p>
          </div>
          <div class="dropdown-divider"></div>

					<div class="dropdown-item">
            <h6>Salida pendiente</h6>
            <p class="text-nowrap text-primary">Insumos - Tipo A: X</p>
            <p class="text-muted">01/01/2019 - 00:00</p>
          </div>
          <div class="dropdown-divider"></div>

					<div class="dropdown-item">
            <h6>Salida pendiente</h6>
            <p class="text-nowrap text-primary">Insumos - Tipo A: X</p>
            <p class="text-muted">01/01/2019 - 00:00</p>
          </div>
          <div class="dropdown-divider"></div>

          <div class="dropdown-item">
            <h6>Salida pendiente</h6>
            <p class="text-nowrap text-primary">Insumos - Tipo A: X</p>
            <p class="text-muted">01/01/2019 - 00:00</p>
          </div>

        </div>
      </li>-->


      <li class="nav-item">
        <a class="nav-link" href="funciones/cerrarSesion.php">Cerrar sesión</a>
      </li>
    </ul>
  </div>

</nav>

<!--sidebar, main-->

<div class="container-fluid">
  <div class="row">
    <nav class="col-0 col-md-3 col-lg-2 d-none d-md-block bg-light border-right">
      <div class="sidebar-left">

        <ul class="nav flex-column">

          <li class="nav-item mt-3">
            <a class="nav-link py-0 active" href="s-autorizacionSalidas.php">
              <img src="img/ico/s1.png" class="mr-2">Autorizar salidas
            </a>
          </li>

					<li class="nav-item mt-3">
            <a class="nav-link py-0 active" href="s-ordenProduccion.php">
              <img src="img/ico/s4.png" class="mr-2">Orden de producción
            </a>
          </li>

          <li class="nav-item mt-3">
            <a class="nav-link py-0" href="s-registroProveedores.php">
              <img src="img/ico/s2.png" class="mr-2">Registrar proveedores
            </a>
          </li>

          <li class="nav-item mt-3">
            <a class="nav-link py-0" href="s-editaProveedores.php">
              <img src="img/ico/s3.png" class="mr-2">Editar proveedores
            </a>
          </li>

          <li class="nav-item mt-3">
            <a class="nav-link py-0" href="s-registroProdTerm.php">
              <img src="img/ico/s2.png" class="mr-2">Registrar producto
            </a>
          </li>

          <li class="nav-item mt-3">
            <a class="nav-link py-0" href="s-editaProdTerm.php">
              <img src="img/ico/s3.png" class="mr-2">Editar producto
            </a>
          </li>

        </ul>

      </div>
    </nav>
