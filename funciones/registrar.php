<?php
  require("db.php");
  session_start();
  if ($_SESSION["captcha"] == $_POST["captcha"]) {
    $name = strtoupper($_POST["nombre"]);
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $buscarUsuario = "SELECT * FROM cliente WHERE correo='$email'";

    $resultado = $conn->query($buscarUsuario);

    $count = mysqli_num_rows($resultado);

    if ($count == 1) {
      header("Location: ../registro.php?error=usuario_existe");
    }
    else{
      $registro = "INSERT INTO cliente (nombre,correo,password) VALUES ('$name','$email','$pass')";
      if($conn->query($registro)){
        header("Location: ../registro.php?msj=registrado");
      }
      else{
        header("Location: ../registro.php?msj=error");
      }
    }
    $conn->close();
  }
  else{
    header("Location: ../registro.php?error=captcha");
  }



?>
