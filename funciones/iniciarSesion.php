<?php
  require("db.php");
  session_start();
  if ($_SESSION["captcha"] == $_POST["captcha"]) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];

    $consulta = "SELECT * FROM empleado WHERE correo='$email' AND password='$pass'";

    if(isset($email) && isset($pass)){

      if($resultado = $conn->query($consulta)) {

        while($row = $resultado->fetch_array()) {
          $emailok = $row["correo"];
          $passok = $row["password"];
          $idUsuario = $row["id"];
        }

        $resultado->close();
      }

      if($email == $emailok && $pass == $passok) {
        session_start();
        $_SESSION["logueado"] = TRUE;
        $_SESSION["tipoUsuario"] = $idUsuario;
        if ($idUsuario == 1) {
          Header("Location: ../g-ordenarCompra.php");
        }
        else if ($idUsuario == 2) {
          Header("Location: ../s-autorizacionSalidas.php");
        }
      }
      else {
        Header("Location: ../inicioSesion.php?error=login");
      }

      $conn->close();
    }
  }
  else{
    header("Location: ../inicioSesion.php?error=captcha");
  }


?>
