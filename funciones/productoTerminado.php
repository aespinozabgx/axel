<?php

  class ProductoTerminado{
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $img;
    private $insumo;
    private $cantidad;

    public function setId($idp) {
      $this->id = $idp;
    }
    public function getId() {
      return $this->id;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setNombre($nom) {
      $this->nombre = $nom;
    }
    public function getNombre() {
      return $this->nombre;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setDescripcion($des) {
      $this->descripcion = $des;
    }
    public function getDescripcion() {
      return $this->descripcion;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setPrecio($pre) {
      $this->precio = $pre;
    }
    public function getPrecio() {
      return $this->precio;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setImagen($ima) {
      $this->img = $ima;
    }
    public function getImagen() {
      return $this->img;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setInsumo($ins) {
      $this->insumo = $ins;
    }
    public function getInsumo() {
      return $this->insumo;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setCantidad($can) {
      $this->cantidad = $can;
    }
    public function getCantidad() {
      return $this->cantidad;
    }
    ////////////////////////////////////////////////////////////////////////////

  }

  $ptObj = new ProductoTerminado;

?>
