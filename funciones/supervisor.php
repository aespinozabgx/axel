<?php
  require("db.php");
  require("proveedor.php");
  require("productoTerminado.php");

  date_default_timezone_set("America/Mexico_City");

  class Supervisor{

    private $connS;
    private $pvr;
    private $prt;

    public function __construct($c,$p,$t) {
        $this->connS = $c;
        $this->pvr = $p;
        $this->prt = $t;
    }

    public function autorizarSalida(){
      $id = $_POST["idc"];
      $compraSel = "SELECT * FROM compra WHERE id='$id'";

      if ($resultado = $this->connS->query($compraSel)) {

        $compra = $resultado->fetch_assoc();
        if ($compra[estado] == 1) {
          header("Location: ../s-autorizacionSalidas.php?msj=entregado");
        }
        //AUTORIZAR
        else {
          $consultaAlmacen = "SELECT * FROM almacenproductos WHERE idProducto=$compra[idProducto] AND talla='$compra[talla]' AND color='$compra[color]'";
          $resultado = $this->connS->query($consultaAlmacen);
          $count = mysqli_num_rows($resultado);

          if ($count >= $compra[cantidad]) {
            $consultaAlmacen = "SELECT * FROM almacenproductos WHERE idProducto=$compra[idProducto] AND talla='$compra[talla]' AND color='$compra[color]' ORDER BY fechaAlta ASC";
            //NO FUNCIONA LA CONSULTA CON LIMIT $compra[cantidad]
            $resultado = $this->connS->query($consultaAlmacen);
            for ($i=0; $i < $compra[cantidad]; $i++) {
              $idpeps = $resultado->fetch_assoc();
              /*echo $idpeps[idProducto]." ".$idpeps[talla]." ".$idpeps[color]." ".$idpeps[fechaAlta];
              echo "<hr>";*/
              $eliminar = "DELETE FROM almacenproductos WHERE id='$idpeps[id]'";
              $this->connS->query($eliminar);

              $buscarSalidasGerente = "SELECT * FROM salidasgerente WHERE idObjeto='$idpeps'";
              $resultadoSalida = $this->connS->query($buscarSalidasGerente);
              $count = mysqli_num_rows($resultadoSalida);
              if ($count == 0) {
                $eliminarSalida = "DELETE FROM salidasgerente WHERE idObjeto='$idpeps'";
                $this->connS->query($eliminarSalida);
              }

            }

            $entregado = "UPDATE compra SET estado=1 WHERE id='$compra[id]'";
            $this->connS->query($entregado);
            header("Location: ../s-autorizacionSalidas.php?msj=autorizado");

            /*while ($idpeps = $resultado->fetch_assoc()) {
              echo $idpeps[idProducto]." ".$idpeps[talla]." ".$idpeps[color]." ".$idpeps[fechaAlta];
              echo "<hr>";
            }*/
          }
          else {
            header("Location: ../s-autorizacionSalidas.php?msj=existencias");
          }
        }
        //AUTORIZAR
      }
      else {
        header("Location: ../s-autorizacionSalidas.php?error=accion");
      }
      $this->connS->close();
    }

    public function eliminarSalida(){
      $id = $_POST["idc"];
      $entregado = "SELECT * FROM compra WHERE id='$id'";
      //VALIDACION DE ENTREGA
      if($resultado = $this->connS->query($entregado)){
        $compra = $resultado->fetch_assoc();
        if ($compra[estado] == 1) {
          $eliminar = "DELETE FROM compra WHERE id='$id'";
          $this->connS->query($eliminar);
          header("Location: ../s-autorizacionSalidas.php?msj=eliminado");
        }
        else {
          header("Location: ../s-autorizacionSalidas.php?error=accion");
        }
      }

    }


    ////////////////////////////////////////////////////////////////////////////
    public function autorizarSalidaProducto(){
      $ids = $_POST["ids"];
      $ido = $_POST["ido"];

      $eliminarAlmacen = "DELETE FROM almacenproductos WHERE id='$ido'";
      $eliminarSalida = "DELETE FROM salidasgerente WHERE id='$ids'";

      $this->connS->query($eliminarAlmacen);
      $this->connS->query($eliminarSalida);

      header("Location: ../s-autorizacionSalidas.php?msj=autorizadoP");

    }

    public function eliminarSalidaProducto(){
      $ids = $_POST["ids"];
      $eliminar = "DELETE FROM salidasgerente WHERE id='$ids'";
      if ($resultado = $this->connS->query($eliminar)) {
        header("Location: ../s-autorizacionSalidas.php?msj=eliminadoP");
      }
      else {
        header("Location: ../s-autorizacionSalidas.php?error=accionSalida");
      }
    }
    ////////////////////////////////////////////////////////////////////////////

    public function autorizarSalidaInsumo(){
      $ids = $_POST["ids"];
      $ido = $_POST["ido"];

      $eliminarAlmacen = "DELETE FROM almaceninsumos WHERE id='$ido'";
      $eliminarSalida = "DELETE FROM salidasgerente WHERE id='$ids'";

      $this->connS->query($eliminarAlmacen);
      $this->connS->query($eliminarSalida);

      header("Location: ../s-autorizacionSalidas.php?msj=autorizadoI");

    }

    public function eliminarSalidaInsumo(){
      $ids = $_POST["ids"];

      $eliminar = "DELETE FROM salidasgerente WHERE id='$ids'";
      if ($resultado = $this->connS->query($eliminar)) {
        header("Location: ../s-autorizacionSalidas.php?msj=eliminadoI");
      }
      else {
        header("Location: ../s-autorizacionSalidas.php?error=accionSalidaI");
      }
    }
    ////////////////////////////////////////////////////////////////////////////

    public function registrarProveedor(){

      $buscarProveedor = "SELECT * FROM proveedor";
      $resultado = $this->connS->query($buscarProveedor);
      $count = mysqli_num_rows($resultado);

      if ($count == 2) {
        header("Location: ../s-registroProveedores.php?error=maximo");
      }
      else {
        if (isset($_POST["nombre"]) && isset($_POST["insumo"]) && isset($_POST["maximo"]) && isset($_POST["minimo"]) && isset($_POST["precio"]) && isset($_POST["tiempoEntrega"])) {
          $this->pvr->setNombre(strtoupper($_POST["nombre"]));
          $this->pvr->setInsumo($_POST["insumo"]);
          $this->pvr->setMinimo($_POST["minimo"]);
          $this->pvr->setMaximo($_POST["maximo"]);
          $this->pvr->setPrecio(number_format($_POST["precio"], 2, '.', ''));
          $this->pvr->setTiempoEntrega($_POST["tiempoEntrega"]);

          $nombre = $this->pvr->getNombre();
          $insumo = $this->pvr->getInsumo();
          $maximo = $this->pvr->getMaximo();
          $minimo = $this->pvr->getMinimo();
          $precio = $this->pvr->getPrecio();
          $tiempoEntrega = $this->pvr->getTiempoEntrega();

          $registrar = "INSERT INTO proveedor (nombre,idInsumo,costo,maximo,minimo,tiempoEntrega) VALUES ('$nombre','$insumo','$precio','$maximo','$minimo','$tiempoEntrega')";

          if ($minimo>$maximo) {
            header("Location: ../s-registroProveedores.php?msj=minmax");
          }
          else {
            if($this->connS->query($registrar)){
              header("Location: ../s-registroProveedores.php?msj=registrado");
            }
            else{
              header("Location: ../s-registroProveedores.php?error=registro");
            }
          }

        }
        else {
          header("Location: ../s-registroProveedores.php?error=registro");
        }

      }
      $this->connS->close();

    }

    public function editarProveedor(){
      if (isset($_POST["nombre"]) && isset($_POST["insumo"]) && isset($_POST["maximo"]) && isset($_POST["minimo"]) && isset($_POST["precio"]) && isset($_POST["tiempoEntrega"])) {
        $this->pvr->setId($_POST["id"]);
        $this->pvr->setNombre(strtoupper($_POST["nombre"]));
        $this->pvr->setInsumo($_POST["insumo"]);
        $this->pvr->setMinimo($_POST["minimo"]);
        $this->pvr->setMaximo($_POST["maximo"]);
        $this->pvr->setPrecio(number_format($_POST["precio"], 2, '.', ''));
        $this->pvr->setTiempoEntrega($_POST["tiempoEntrega"]);

        $id = $this->pvr->getId();
        $nombre = $this->pvr->getNombre();
        $insumo = $this->pvr->getInsumo();
        $maximo = $this->pvr->getMaximo();
        $minimo = $this->pvr->getMinimo();
        $precio = $this->pvr->getPrecio();
        $tiempoEntrega = $this->pvr->getTiempoEntrega();

        $actualizar = "UPDATE proveedor SET nombre='$nombre',idInsumo='$insumo',costo='$precio',maximo='$maximo',minimo='$minimo',tiempoEntrega='$tiempoEntrega' WHERE id='$id'";

        if ($minimo>$maximo) {
          header("Location: ../s-editaProveedores.php?msj=minmax");
        }
        else {
          if($this->connS->query($actualizar)){
            header("Location: ../s-editaProveedores.php?msj=actualizado");
          }
          else{
            header("Location: ../s-editaProveedores.php?error=registro");
          }
        }

      }

      $this->connS->close();
    }

    public function eliminarProveedor(){
      $this->pvr->setId($_POST["idel"]);
      $id = $this->pvr->getId();

      $eliminar = "DELETE FROM proveedor WHERE id='$id'";
      if ($this->connS->query($eliminar)) {
        header("Location: ../s-editaProveedores.php?msj=eliminado");
      }
      else {
        header("Location: ../s-editaProveedores.php?error=eliminacion");
      }
      $this->connS->close();
    }

    public function registrarProdTerm(){
      if (isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["precio"]) && isset($_POST["imagen"]) && isset($_POST["insumo"]) && isset($_POST["cantidad"])) {
        $this->prt->setNombre(strtoupper($_POST["nombre"]));
        $this->prt->setDescripcion($_POST["descripcion"]);
        $this->prt->setPrecio(number_format($_POST["precio"], 2, '.', ''));
        $this->prt->setImagen('img/productos/'.$_POST["imagen"]);
        $this->prt->setInsumo($_POST["insumo"]);
        $this->prt->setCantidad($_POST["cantidad"]);

        $nombre = $this->prt->getNombre();
        $descripcion = $this->prt->getDescripcion();
        $precio = $this->prt->getPrecio();
        $imagen = $this->prt->getImagen();
        $insumo = $this->prt->getInsumo();
        $cantidad = $this->prt->getCantidad();

        $registrar = "INSERT INTO producto (nombre,descripcion,precio,img,idInsumo,cantidadChico) VALUES ('$nombre','$descripcion','$precio','$imagen','$insumo','$cantidad')";

        if($this->connS->query($registrar)){
          header("Location: ../s-registroProdTerm.php?msj=registrado");
        }
        else{
          header("Location: ../s-registroProdTerm.php?error=registro");
        }

        $this->connS->close();
      }
    }

    public function editarProdTerm(){
      if (isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["descripcion"]) && isset($_POST["precio"]) && isset($_POST["imagen"]) && isset($_POST["insumo"]) && isset($_POST["cantidad"])) {
        $this->prt->setId($_POST["id"]);
        $id = $this->prt->getId();
        $buscarCompras = "SELECT * FROM compra WHERE idProducto='$id' AND estado=0";
        $resultado = $this->connS->query($buscarCompras);
        $count = mysqli_num_rows($resultado);

        if ($count > 0) {
          header("Location: ../s-editaProdTerm.php?msj=compras");
        }
        else {
          $this->prt->setNombre(strtoupper($_POST["nombre"]));
          $this->prt->setDescripcion($_POST["descripcion"]);
          $this->prt->setPrecio(number_format($_POST["precio"], 2, '.', ''));
          $this->prt->setImagen('img/productos/'.$_POST["imagen"]);
          $this->prt->setInsumo($_POST["insumo"]);
          $this->prt->setCantidad($_POST["cantidad"]);

          $nombre = $this->prt->getNombre();
          $descripcion = $this->prt->getDescripcion();
          $precio = $this->prt->getPrecio();
          $imagen = $this->prt->getImagen();
          $insumo = $this->prt->getInsumo();
          $cantidad = $this->prt->getCantidad();

          $actualizar = "UPDATE producto SET nombre='$nombre',descripcion='$descripcion',precio='$precio',img='$imagen',idInsumo='$insumo',cantidadChico='$cantidad' WHERE id='$id'";

          if($this->connS->query($actualizar)){
            header("Location: ../s-editaProdTerm.php?msj=actualizado");
          }
          else{
            header("Location: ../s-editaProdTerm.php?error=registro");
          }
        }
      }
      else {
        header("Location: ../s-editaProdTerm.php?error=registro");
      }

    }

    public function eliminarProdTerm(){
      $this->prt->setId($_POST["idel"]);
      $id = $this->prt->getId();

      $buscarProducto = "SELECT * FROM almacenproductos WHERE idProducto='$id'";
      $resultado = $this->connS->query($buscarProducto);
      $count = mysqli_num_rows($resultado);

      if ($count > 0) {
        header("Location: ../s-editaProdTerm.php?msj=existencias");
      }
      else{
        $eliminar = "DELETE FROM producto WHERE id='$id'";
        if ($this->connS->query($eliminar)) {
          header("Location: ../s-editaProdTerm.php?msj=eliminado");
        }
        else {
          header("Location: ../s-editaProdTerm.php?error=eliminacion");
        }
      }
      $this->connS->close();
    }

    public function ordenarProduccion(){
      if (isset($_POST["producto"]) && isset($_POST["cantidad"]) && isset($_POST["color"]) && isset($_POST["talla"]) && isset($_POST["ubicacion"])) {
        $consultaAlmacen = "SELECT * FROM almacenproductos";
        $resultado = $this->connS->query($consultaAlmacen);
        $count = mysqli_num_rows($resultado);
        $id = $_POST["producto"];
        $cantidad = $_POST["cantidad"];
        $color = $_POST["color"];
        $talla = $_POST["talla"];
        $ubicacion = $_POST["ubicacion"];

        //No mas de 30 productos
        if($count == 30)
        {
          header("Location: ../s-ordenProduccion.php?msj=lleno");
        }
        else if ($count+$cantidad > 30) {
          header("Location: ../s-ordenProduccion.php?msj=maximo");
        }
        else {
          $consultaProducto = "SELECT * FROM producto WHERE id='$id'";
          if($resultado=$this->connS->query($consultaProducto)){
            $producto=mysqli_fetch_array($resultado);

            //Comprobar insumos en almacen
            if ($talla == 'C') {
              $cantidadInsumos = $cantidad*$producto[cantidadChico];
            }
            else if ($talla == 'M') {
              $cantidadInsumos = 2*($cantidad*$producto[cantidadChico]);
            }
            else if ($talla == 'G') {
              $cantidadInsumos = 3*($cantidad*$producto[cantidadChico]);
            }

            $consultaInsumos = "SELECT * FROM almaceninsumos WHERE idInsumo='$producto[idInsumo]'";
            $resultado=$this->connS->query($consultaInsumos);
            $insumosEnAlmacen = mysqli_num_rows($resultado);

            if ($cantidadInsumos > $insumosEnAlmacen) {
              header("Location: ../s-ordenProduccion.php?msj=insumos");
            }
            //Realiza la produccion
            else {
              //Registrar orden
              $fecha = date("Y-m-d H:i:s");
              $registrarOrden = "INSERT INTO ordenproduccion (idInsumo,idProducto,cantidad,cantidadInsumos,color,talla,ubicacion,fecha) ";
              $registrarOrden.= "VALUES ('$producto[idInsumo]','$producto[id]','$cantidad','$cantidadInsumos','$color','$talla','$ubicacion','$fecha')";
              if ($this->connS->query($registrarOrden)) {
                //Modificar almacen de insumos
                $obtenerInsumos = "SELECT id FROM almaceninsumos WHERE idInsumo='$producto[idInsumo]' ORDER BY fechaAlta ASC";
                $resultado = $this->connS->query($obtenerInsumos);
                for ($i=0; $i < $cantidadInsumos; $i++) {
                  $insumopeps = $resultado->fetch_assoc();
                  echo $insumopeps[id]."<br>";
                  $eliminarInsumo = "DELETE FROM almaceninsumos WHERE id='$insumopeps[id]'";
                  $this->connS->query($eliminarInsumo);
                }

                //Modificar almacen de productos
                for ($i=0; $i < $cantidad; $i++) {
                  $nuevoproducto = "INSERT INTO almacenproductos (idProducto,ubicacion,fechaAlta,talla,color) ";
                  $nuevoproducto .= "VALUES ('$id','$ubicacion','$fecha','$talla','$color')";
                  $this->connS->query($nuevoproducto);
                }
                header("Location: ../s-ordenProduccion.php?msj=produccion");
              }
              else {
                header("Location: ../s-ordenProduccion.php?error=datos");
              }
            }

          }
          else {
            header("Location: ../s-ordenProduccion.php?error=datos");
          }
        }
      }
      else {
        header("Location: ../s-ordenProduccion.php?error=datos");
      }
    }
  }

  $sup = new Supervisor($conn,$pvrObj,$ptObj);

  if (isset($_POST["accion"]) && $_POST["accion"] == "registrarProveedor") {
    $sup->registrarProveedor();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "editarProveedor") {
    $sup->editarProveedor();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "eliminarProveedor") {
    $sup->eliminarProveedor();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "registrarProdTerm") {
    $sup->registrarProdTerm();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "editarProdTerm") {
    $sup->editarProdTerm();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "eliminarProdTerm") {
    $sup->eliminarProdTerm();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "autorizarSalida") {
    $sup->autorizarSalida();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "eliminarSalida") {
    $sup->eliminarSalida();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "autorizarSalidaProducto") {
    $sup->autorizarSalidaProducto();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "eliminarSalidaProducto") {
    $sup->eliminarSalidaProducto();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "autorizarSalidaInsumo") {
    $sup->autorizarSalidaInsumo();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "eliminarSalidaInsumo") {
    $sup->eliminarSalidaInsumo();
  }
  else if (isset($_POST["accion"]) && $_POST["accion"] == "ordenarProduccion") {
    $sup->ordenarProduccion();
  }
  else{
    header("Location: ../s-autorizacionSalidas.php");
  }
?>
