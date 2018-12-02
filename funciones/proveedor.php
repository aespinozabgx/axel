<?php

  class Proveedor{
    private $id;
    private $nombre;
    private $insumo;
    private $maximo;
    private $minimo;
    private $precio;
    private $tiempoEntrega;

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

    public function setInsumo($ins) {
      $this->insumo = $ins;
    }
    public function getInsumo() {
      return $this->insumo;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setMaximo($max) {
      $this->maximo = $max;
    }
    public function getMaximo() {
      return $this->maximo;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setMinimo($min) {
      $this->minimo = $min;
    }
    public function getMinimo() {
      return $this->minimo;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setPrecio($pre) {
      $this->precio = $pre;
    }
    public function getPrecio() {
      return $this->precio;
    }
    ////////////////////////////////////////////////////////////////////////////

    public function setTiempoEntrega($ten) {
      $this->tiempoEntrega = $ten;
    }
    public function getTiempoEntrega() {
      return $this->tiempoEntrega;
    }
    ////////////////////////////////////////////////////////////////////////////

  }

  $pvrObj = new Proveedor;

?>
