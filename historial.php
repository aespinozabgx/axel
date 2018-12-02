<?php
  include_once "templates/header.php";
  include_once "templates/navbarCliente.php";
  require "funciones/metodos.php";
  require "funciones/db.php";
?>



      <div class="row mx-1 mx-sm-5 border-bottom" style="margin-top: 80px">
        <h3>Compras realizadas</h3>
      </div>

      <div class="row mx-1 mx-sm-5 justify-content-center mt-5">
        <div class="col-11">
          <table class="table table-hover table-responsive-md table-light rounded text-center">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Color</th>
                <th scope="col">Talla</th>
                <th scope="col">Importe</th>
                <th scope="col">Dirección</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $consultaId = "SELECT id FROM cliente WHERE correo='$_SESSION[usuario]'";
                $resultado = $conn->query($consultaId);
                $cliente = $resultado->fetch_assoc();
                consultaHistorial($cliente[id]);
                $conn->close();
              ?>
            </tbody>
          </table>
          <?php
            if(isset($_GET["msj"]) && $_GET["msj"] == "comprado") {
              echo '<div class="alert alert-success">Compras añadidas</div>';
            }
            if(isset($_GET["msj"]) && $_GET["msj"] == "eliminado") {
              echo '<div class="alert alert-success">Eliminado</div>';
            }
            if(isset($_GET["error"]) && $_GET["error"] == "accion") {
              echo '<div class="alert alert-danger">No se pudo completar la acción</div>';
            }
          ?>
        </div>
      </div>



    </div>
<?php include_once "templates/scripts.php"?>
