<?php
  Class nodoCategoria {
    
  //Atributos
   private $IdCategoria;
   private $NombreCategoria;
   private $Ant;
   private $Sig;
   private $Abajo;

  //Constructor

  function __construct($IdCat, $NomCatg){
    $this->IdCategoria = $IdCat;
    $this->NombreCategoria = $NomCatg;
    $this->Ant = null;
    $this->Sig = null;
    $this->Abajo = null;
  }

  //Gets & Sets

  public function getIdCategoria(){
    return $this->IdCategoria;
  }
  public function setIdCategoria($IdCat){
    $this->IdCategoria = $IdCategoria; 
  }

  public function getNombreCategoria(){
    return $this->NombreCategoria;
  }
  public function setNombreCategoria($NomCatg){
    $this->NombreCategoria = $NombreCategoria; 
  }

  public function getAnt(){
    return $this->Ant;
  }
  public function setAnt($Ant){
    $this->Ant = $Ant; 
  }

  public function getSig(){
    return $this->Sig;
  }
  public function setSig($Sig){
    $this->Sig = $Sig;
  }
  public function getAbajo(){
    return $this->Abajo;
  }
  public function setAbajo($Abajo){
    $this->Abajo = $Abajo;
  }

  }
?>