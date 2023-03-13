<?php
  Class nodoProducto {
    
  //Atributos
   private $IdProducto;
   private $Marca;
   private $NombreProducto;
   private $ValorUnidad;
   private $PorcentajeIVA;
   private $ValorIVA;
   private $TotalUnidad;
   private $Cantidad;
   private $Abajo;

  //Constructor
  function __construct($IdProd, $MarcaProd, $NombreProd, $ValorUnd, $PtjeIVA, $CantidadProducto){
    $this->IdProducto = $IdProd;
    $this->Marca = $MarcaProd;
    $this->NombreProducto = $NombreProd;
    $this->ValorUnidad = $ValorUnd;
    $this->PorcentajeIVA = $PtjeIVA;
    $this->ValorIVA = $ValorUnd * ($PtjeIVA / 100);
    $this->TotalUnidad = $ValorUnd + $this->ValorIVA;
    $this->Cantidad = $CantidadProducto;
    $this->Abajo = null;
  }

  //Gets & Sets

  //ID del Producto
  public function getIdProducto(){
    return $this->IdProducto;
  }
  public function setIdProducto($IdProd){
    $this->IdProducto = $IdProd; 
  }

  //Marca del producto
  public function getMarca(){
    return $this->Marca;
  }
  public function setMarca($Marca){
    $this->Marca = $Marca; 
  }

  //Nombre del producto
  public function getNombreProducto(){
    return $this->NombreProducto;
  }
  public function setNombreProducto($NombreProd){
    $this->NombreProd = $NombreProd; 
  }

  //Valor Unidad
  public function getValorUnidad(){
    return $this->ValorUnidad;
  }
  public function setValorUnidad($ValorUnidad){
    $this->ValorUnidad = $ValorUnidad; 
    $this->ActualizarValores();
  }

  //Porcentaje IVA
  public function getPorcentajeIVA(){
    return $this->PorcentajeIVA;
  }
  public function setPorcentajeIVA($PorcentajeIVA){ 
    $this->PorcentajeIVA = $PorcentajeIVA; 
    $this->ActualizarValores();
  }

  //Valor IVA
  public function getValorIVA(){
    return $this->ValorIVA;
  }
  public function setValorIVA($ValorIVA){
    $this->ValorIVA = $ValorIVA; 
  }

  //Total Unidad
  public function getTotalUnidad(){
    return $this->TotalUnidad;
  }
  public function setTotalUnidad($TotalUnidad){
    $this->TotalUnidad = $TotalUnidad; 
  }

  //Cantidad
  public function getCantidad(){
    return $this->Cantidad;
  }
  public function setCantidad($Cantidad){
    $this->Cantidad = $Cantidad; 
  }

  //Puntero Abajo
  public function getAbajo(){
    return $this->Abajo;
  }
  public function setAbajo($Abajo){
    $this->Abajo = $Abajo;
  }

  //Actualizar Valores
  private function ActualizarValores() {
    $this->ValorIVA = $this->ValorUnidad * ($this->PorcentajeIVA / 100);
    $this->TotalUnidad = $this->ValorUnidad + $this->ValorIVA;
  }

}
?>