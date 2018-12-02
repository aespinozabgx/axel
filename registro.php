<?php include_once "funciones/loggeado.php"?>
<?php include_once "templates/header.php"?>
    <div class="container">
      <div class="row">
        <div class="col-12 fixed-top bg-dark text-light" style="height: 30px">
          <p>Registro</p>
        </div>
      </div>
      <div class="row" style="margin-top: 60px">
        <div class="col-8 col-md-6 col-lg-4 border rounded mt-5 bg-light mx-auto">
          <div class="d-flex justify-content-center">
            <img src="img/avatar.png" class="avatar-img">
          </div>
          <form action="funciones/registrar.php" method="post" class="mt-5">
            <label for="nombre">Nombre: </label><input type="text" name="nombre" class="form-control text-uppercase" required>
            <label for="email">Correo: </label><input type="email" name="email" class="form-control" required>
            <label for="pass">Contraseña: </label><input type="password" name="pass" class="form-control" required>
            <label for="captcha">Codigo de verificacion: </label><input type="text" name="captcha" class="form-control" required>
            <div class="float-right mt-3 mb-1">
              <span class="small pr-1">Captcha: </span><img src="templates/captcha-img.php" class="captcha-img">
            </div>
            <input type="submit" value="Registrarse" class="btn btn-primary w-100 mt-2 mb-2">
            <a href="inicioSesion.php" class="d-flex justify-content-center small mb-3">¿Ya tienes cuenta? Inicia sesión</a>
            <?php
        			if(isset($_GET["error"]) && $_GET["error"] == "usuario_existe") {
        				echo '<div class="alert alert-danger">El correo ya ha sido registrado</div>';
        			}
              if(isset($_GET["msj"]) && $_GET["msj"] == "registrado") {
        				echo '<div class="alert alert-success">Usuario creado, ahora puedes iniciar sesión</div>';
        			}
              if(isset($_GET["msj"]) && $_GET["msj"] == "error") {
        				echo '<div class="alert alert-danger">Error, al crear usuario</div>';
        			}
              if(isset($_GET["error"]) && $_GET["error"] == "captcha") {
        				echo '<div class="alert alert-danger">Código de verificación incorrecto</div>';
        			}
      		  ?>
          </form>
        </div>
      </div>
    </div>
<?php include_once "templates/scripts.php"?>
