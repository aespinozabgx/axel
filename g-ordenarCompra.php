<?php

  include_once "templates/header.php";
  include_once "templates/navbarGerente.php";
  require "funciones/db.php";
  require "funciones/metodos.php";
  
  if (isset($_GET['estado'])) {
    $estado = $_GET['estado'];
    if ($estado == "insertSuccess") {
      echo "<script>alert('Registrado correctamente.');</script>";
    }
    if ($estado == "varNoDefinidas") {
      echo "<script>alert('Faltan datos.');</script>";
    }
    if ($estado == "minMaxError") {
      echo "<script>alert('Cantidad minima o maximca incorrecta.');</script>";
    }
  }


?>

    <div class="col-12 col-md-9 col-lg-10 px-2 px-sm-5 pt-5">
      <div class="row mt-2">
        <div class="col-12 col-md-16">
        <h3>Ordenar compra</h3>
        <hr>
        <div class="row">
        <?php
          $query = mysqli_query ($conn, "
            SELECT
              proveedor.id as idP,
              proveedor.nombre,
              proveedor.idInsumo,
              proveedor.costo,
              proveedor.maximo,
              proveedor.minimo,
              proveedor.tiempoEntrega,
              insumo.id,
              insumo.nombre AS nombreIns
          FROM
              `proveedor`
          JOIN insumo ON proveedor.idInsumo = insumo.id
          ");
          while ($f=mysqli_fetch_array($query))
          {
          ?>
          <div class="col-sm-4">
            <form action="funciones/ordenarCompra.php" method="post">

              <div class="rounded bg-light mx-auto p-2 mb-5 col-25">

                <div class='form-group'>
                  <label>Proveedor: </label>
                </div>
                <input type="text" class="form-control" readonly required value="<?php echo $f['nombre'];?>" />
                <input type="hidden" name="idProveedor" value="<?php echo $f['idP'];?>">

                <div class='form-group'>
                  <label>Insumo: </label>
                </div>
                <input type="text" class="form-control" readonly required value="<?php echo $f['nombreIns'];?>" />
                <input type="hidden" name="idInsumo" value="<?php echo $f['idInsumo'];?>">

                <div class='form-group'>
                  <label>Precio: </label>
                </div>
                <input type="text" class="form-control" name='importe'  readonly required value="<?php echo $f['costo'];?>" />

                <div class='form-group'>
                  <label>Tiempo entrega: </label>
                </div>
                <input type="text" class="form-control" name='tiempoEntrega' readonly value="<?php echo $f['tiempoEntrega'];?>" />

                <div class='form-group'>
                  <label>Minimo que vende: </label>
                </div>
                <input type="text" class="form-control" readonly name='minimoVenta' required value="<?php echo $f['minimo'];?>" />

                <div class='form-group'>
                  <label>Maximo que vende: </label>
                </div>
                <input type="text" class="form-control" readonly name='maximoVenta' value="<?php echo $f['maximo'];?>" />

                <div class='form-group'>
                  <label>Cantidad: </label>
                </div>
                <input type="number" class="form-control" name="cantidad">
                <input type="submit" name="" value="Registrar" class="btn btn-primary w-100 mt-4 mb-2">

              </div>
            </form>
          </div>
          <?php } ?>
        </div>
      </div>
      <hr />
    </div>
  </div>


<?php include_once "templates/scripts.php"?>
