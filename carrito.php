<?php include_once "templates/header.php"?>
<?php include_once "templates/navbarCliente.php"?>

      <div class="row mx-1 mx-sm-5 border-bottom" style="margin-top: 80px">
        <h3>Carrito de compras</h3>
      </div>

      <div class="row mx-1 mx-sm-5 justify-content-center mt-5">
        <div class="col-10">
          <?php
            if (count($_SESSION[producto]) == 0) {
              echo '<div class="alert alert-danger w-100">No hay productos en carrito</div>';
            }
            else {
          ?>
          <table class="table table-hover table-responsive-md table-light rounded text-center">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Talla</th>
                <th>Color</th>
                <th>Cantidad</th>
                <th>Importe</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
          <?php
            foreach ($_SESSION[producto] as $key => $value) {
              echo '<tr>';
              echo '<td>'.$_SESSION[producto][$key].'</td>';
              echo '<td>'.$_SESSION[talla][$key].'</td>';
              echo '<td>'.$_SESSION[color][$key].'</td>';
              echo '<td>'.$_SESSION[cantidad][$key].'</td>';
              echo '<td>$'.$_SESSION[importe][$key].'</td>';
            ?>
              <td>
                <form class="" action="funciones/eliminarCarrito.php" method="post">
                  <input type="hidden" name="indice" value="<?php echo $key?>">
                  <button type="submit" name="quitar" class="btn btn-danger btn-sm">Quitar</button>
                </form>
              </td>
          <?php
              echo '</tr>';
            }
          ?>
            </tbody>
          </table>
          <?php
            if(isset($_GET["msj"]) && $_GET["msj"] == "ya_agregado") {
              echo '<div class="alert alert-danger w-100">Ya hay una compra en el carrito de este producto</div>';
            }
          ?>
        </div>
      </div>

      <div class="row mx-1 mx-sm-5 justify-content-center mt-3">
        <div class="col-12 col-md-8">
          <form action="funciones/compraCliente.php" method="post">
            <label>Dirección de envío</label>
            <input type="text" name="direccion" class="form-control" required>
        </div>
      </div>

      <div class="row mx-1 mx-sm-5 justify-content-center mt-1">
        <div class="col-12 col-md-5">
            <div class="float-right mt-4 pt-3 mb-1">
              <span class="small pr-1">Captcha: </span><img src="templates/captcha-img.php" class="captcha-img">
            </div>
            <div class="w-50">
              <label class="mt-2">Código de verificación: </label><input type="text" name="captcha" class="form-control" required>
            </div>

            <div class="w-100">
              <button type="submit" name="comprar" class="btn w-100 btn-primary my-4">Realizar compra</button>
            </div>
            <!--<div class="float-right mt-3 mb-1">
              <span class="small pr-1">Captcha: </span><img src="templates/captcha-img.php" class="captcha-img">
            </div>-->
          </form>
          <?php
            if(isset($_GET["msj"]) && $_GET["msj"] == "captcha") {
              echo '<div class="alert alert-danger mb-5">Código de verificación incorrecto</div>';
            }
          ?>
        </div>
      </div>

      <?php
        }
      ?>

    </div>

<?php include_once "templates/scripts.php"?>
