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
  public function setMarca($MarcaProd){
    $this->Marca = $MarcaProd; 
  }

  //Nombre del producto
  public function getNombreProducto(){
    return $this->NombreProducto;
  }
  public function setNombreProducto($NombreProd){
    $this->NombreProducto = $NombreProd; 
  }

  //Valor Unidad
  public function getValorUnidad(){
    return $this->ValorUnidad;
  }
  public function setValorUnidad($ValorUnd){
    $this->ValorUnidad = $ValorUnd; 
    $this->ActualizarValores();
  }

  //Porcentaje IVA
  public function getPorcentajeIVA(){
    return $this->PorcentajeIVA;
  }
  public function setPorcentajeIVA($PtjeIVA){
    $this->PorcentajeIVA = $PtjeIVA; 
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
  public function setTotalUnidad($TotalUnd){
    $this->TotalUnidad = $TotalUnidad; 
  }

  //Cantidad
  public function getCantidad(){
    return $this->Cantidad;
  }
  public function setCantidad($CantidadProducto){
    $this->Cantidad = $CantidadProducto; 
  }

  //Puntero Abajo
  public function getAbajo(){
    return $this->sig;
  }
  public function setAbajo($Abajo){
    $this->abj = $Abajo;
  }

  //Actualizar Valores
  private function ActualizarValores() {
    $this->ValorIVA = $this->ValorUnidad * ($this->PorcentajeIVA / 100);
    $this->TotalUnidad = $this->ValorUnidad + $this->ValorIVA;
  }

}
?>