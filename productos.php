<?php include_once "templates/header.php"?>
<?php include_once "templates/navbarCliente.php"?>


<style>
  .img-card{
    width: 200px!important;
    height: 200px!important;
    padding: 10px;
  }
</style>



  <div class="row" style="margin-top: 70px">
    <?php
      $consultaProductos = "SELECT * FROM producto";

      if($resultado=$conn->query($consultaProductos)){
        while ($producto=mysqli_fetch_array($resultado)) {

    ?>
    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3 py-2 px-4 justify-content-center">

      <div class="card"><!-- style="width: 100%;"-->
        <img class="card-img-top img-card mx-auto" src="<?php echo $producto[img];?>">
        <div class="card-body border-top bg-light">
          <h5 class="card-title"><?php echo $producto[nombre];?></h5>
          <p class="card-text"><?php echo $producto[descripcion];?></p>
          <h3 class="card-text">$<?php echo $producto[precio];?></h3>
          <form action="compra.php" method="post">
            <input type="hidden" name="idp" value="<?php echo $producto[id];?>">
            <button type="submit" class="btn btn-primary float-right">
                Comprar
            </button>
          </form>
        </div>
      </div>

    </div>
    <?php
        }
      }
    ?>



  </div>
</div>
<?php include_once "templates/scripts.php"?>
