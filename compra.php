<?php include_once "templates/header.php"?>
<?php include_once "templates/navbarCliente.php"?>
<?php
  if(!isset($_POST["idp"]))
  {
    header("Location: productos.php");
  }
  else {
    $id = $_POST["idp"];
    $buscarProducto = "SELECT a.id,a.nombre,a.descripcion,a.precio,a.img,b.nombre as nombreInsumo FROM producto a INNER JOIN insumo b ON a.idInsumo=b.id WHERE a.id='$id'";
    $resultado = $conn->query($buscarProducto);
    $producto=$resultado->fetch_assoc();
  }
?>

      <div class="row mx-1 mx-sm-5 border-bottom" style="margin-top: 80px">
        <h3>Datos de compra</h3>
      </div>

      <div class="row mx-1 mx-sm-5">
        <div class="col-12 col-md-6 my-auto">
          <div class="mx-auto" style="width:80%">

            <form class="mb-5" action="funciones/añadirCarrito.php" method="post">
              <input type="hidden" name="idp" value="<?php echo $producto[id]?>">
              <input type="hidden" name="nombrep" value="<?php echo $producto[nombre]?>">
              <input type="hidden" name="precio" value="<?php echo $producto[precio]?>">
              <div class="form-row mt-4">
                <div class="col">
                  <label>Talla: </label>
                  <select name="talla" class="custom-select" required>
                    <option value="C">Chica</option>
                    <option value="M">Mediana</option>
                    <option value="G">Grande</option>
                  </select>
                </div>
                <div class="col">
                  <label>Color: </label>
                  <select name="color" class="custom-select" required>
                    <option value="ROJO">Rojo</option>
                    <option value="AMARILLO">Amarillo</option>
                    <option value="AZUL">Azul</option>
                    <option value="VERDE">Verde</option>
                  </select>
                </div>
              </div>

              <label class="mt-2">Cantidad: </label>
              <input type="number" name="cantidad" step="1" min="1" max="5" class="form-control mb-4" required>

              <button type="submit" name="accion" class="btn w-100 btn-primary">Agregar al carrito</button>

            </form>

          </div>

        </div>

        <style>
          .img-card{
            width: 300px!important;
            height: 300px!important;
            padding: 10px;
          }
        </style>

        <div class="col-12 col-md-6 order-first order-md-2 mt-3">
          <!--<div class="mx-auto" style="width:80%">
            <h5 class="text-center">Producto A</h5>
            <img src="img/bg.jpeg" class="rounded mx-auto img-fluid mt-1">
          </div>-->
          <div class="card mx-auto mb-4 w-75"><!-- style="width: 100%;"-->
            <img class="card-img-top img-card mx-auto py-2" src="<?php echo $producto[img];?>">
            <div class="card-body border-top bg-light">
              <h5 class="card-title"><?php echo $producto[nombre];?></h5>
              <p class="card-text">Descripción: <?php echo $producto[descripcion];?></p>
              <p class="card-text text-muted">Material: <?php echo $producto[nombreInsumo];?></p>
              <h3 class="card-text float-right">$<?php echo $producto[precio];?></h3>
            </div>
          </div>
        </div>


      </div>



    </div>

<?php include_once "templates/scripts.php"?>
