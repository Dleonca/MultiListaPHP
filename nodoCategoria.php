<?php
  Class nodoCategoria {
    
  //Atributos
    
   private $IdCategoria;
   private $NombreCategoria;
   private $Ant
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

  public function getInfo(){
    return $this->info;
  }
  public function setInfo($info){
    $this->info = $info; 
  }

  public function getIdCategoria(){
    return $this->IdCategoria;
  }
  public function setIdCategoria($IdCat){
    $this->info = $IdCategoria; 
  }

  public function getNombreCategoria(){
    return $this->NombreCategoria;
  }
  public function setNombreCategoria($NomCatg){
    $this->info = $NombreCategoria; 
  }

  public function getAnt(){
    return $this->Ant;
  }
  public function setAnt($setAnt){
    $this->info = $Ant; 
  }

  public function getSig(){
    return $this->sig;
  }
  public function setSig($sig){
    $this->sig = $sig;
  }
  public function getAbajo(){
    return $this->abajo;
  }
  public function setAbajo($abajo){
    $this->abj = $abajo;
  }

  }
?>