<?php
  $host     = "localhost";
  $port     = 8080;
  $socket   = "";
  $user     = "root";
  $password = "";
  $dbname   = "inventario";

  $conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
         or die ('No se pudo conectar a la base de datos' . mysqli_connect_error());

  if($conn->connect_error) {
    $error = $conn->connect_error;
    echo '<script>';
    echo 'console.log("'.$error.'")';
    echo '</script>';
  }
  else {
    echo '<script>';
    echo 'console.log("conectado")';
    echo '</script>';
  }

?>
