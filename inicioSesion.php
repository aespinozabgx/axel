<?php include_once "funciones/loggeado.php"?>
<?php include_once "templates/header.php"?>

    <div class="container">
      <div class="row">
        <div class="col-12 fixed-top bg-dark text-light" style="height: 30px">
          <p>Inicio de sesión</p>
        </div>
      </div>
      <div class="row" style="margin-top: 60px">
        <div class="col-8 col-md-6 col-lg-4 border rounded mt-5 bg-light mx-auto">
          <div class="d-flex justify-content-center">
            <img src="img/avatar.png" class="avatar-img">
          </div>
          <form action="funciones/iniciarSesionCliente.php" name="isform" method="post">
            <label for="email" class="mt-5">Correo: </label><input type="email" name="email" class="form-control" required>
            <label for="pass">Contraseña: </label><input type="password" name="pass" class="form-control" required>
            <label for="captcha">Código de verificación: </label><input type="text" name="captcha" class="form-control" required>
            <div class="form-check pt-1">
              <input class="form-check-input" type="checkbox" id="checkEmp">
              <label class="form-check-label text-muted" for="defaultCheck1">
                Empleado
              </label>
            </div>
            <div class="float-right mt-3 mb-1">
              <span class="small pr-1">Captcha: </span><img src="templates/captcha-img.php" class="captcha-img">
            </div>
            <input type="submit" name="" value="Iniciar sesión" class="btn btn-primary w-100 mt-2 mb-2">
            <a href="registro.php" class="d-flex justify-content-center small mb-3">¿No tienes cuenta? Regístrate</a>
            <?php
        			if(isset($_GET["error"]) && $_GET["error"] == "login") {
        				echo '<div class="alert alert-danger">Usuario y/o contraseña incorrectos</div>';
        			}
        			if(isset($_GET["error"]) && $_GET["error"] == "captcha") {
        				echo '<div class="alert alert-danger">Código de verificación incorrecto</div>';
        			}
      		  ?>
          </form>
        </div>
      </div>
    </div>
    <script src="js/empleado.js"></script>
<?php include_once "templates/scripts.php"?>
