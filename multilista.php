<?php
include("nodoCategoria.php");
include("nodoProducto.php"); Preguntar al profesor si es necesario incluir esta clase.

// Definicion de la clase LISTA SIMPLE
  Class Multilista{
    private $Inicial;
    private $Final;

// Constructor
    function __construct(){
      $this->Inicial = NULL;
      $this->Final = NULL;
    }
// Lista Principal Vacia
    function ListaVaciaCatg(){
      if($this->Inicial == null){
        return true;
      } else {
        return false;
      }
    }

// Lista Categoria Vacia
    function CategoriaSinProducto($P){
      if ($P->getAbajo() == null) {
            return true;
        } else {
            return false;
        }
    }

//Categoria Inicial
    function AgregarCategoriaInicio($P){
      if ($this->ListaVaciaCatg()) {
            $this->Final = $P;
        } else {
            $P->setSig($this->Inicial);
        }
        $this->Inicial = $P;
    }

//Categoria Final
    function AgregarCategoriaFinal($P){
      if ($this->ListaVaciaCatg()){
          $this->Inicial = $P;
        } else {
          $this->Final->setSig($P);
          $P->setAnt($this->Final);
        }
        $this->Final = $P;
    }

//Apuntador Abajo En Lista Categoría
  function ApuntarAbajo($P)
    {
        $R = $P->getAbajo(); 
        while ($R->getAbajo() != null) {
            $R = $R->getAbajo();
        }
        return $R;
    }

//Adicionar Producto
    function AdicionarProducto($P, $Q){
      if ($this->CategoriaSinProducto($P)){
            $P->setAbajo($Q);
        } else {
            //Se le asigna el puntero de categoría
            $PunteroAbajo = $this->ApuntarAbajo($P); 
            //Se le cambia al puntero de Producto
            $PunteroAbajo->setAbajo($Q);
        }
    }

//Visualizar Multilista
    function VisualizarMultilista(){
      $P = $this->Inicial;
      $InfoCategoria = ""; 
      $InfoProducto = "";
      if ($P == null) {  
            return "Esta vacia";
      } else {
        while ($P != null) {
          //Se muestra la información de la categoría donde se encuentra el puntero
          $InfoCategoria = $InfoCategoria.'<br><p class="text-inventory">- '.$P->getIdCategoria()." Categoría: ".$P>getNombreCategoria()."</p>";
          //Guardamos el puntero Abajo en una variable
          $R = $P->getAbajo();
          while ($R != null) {
            $InfoProducto = $InfoProducto."&nbsp;&nbsp;&nbsp;&nbsp;-> Id: ".$R->getIdProducto() . "Marca: ".$R->getMarca()."Nombre: ".$R->getNombreProducto()."Valor Und: ".$R->getValorUnidad()." %IVA: ".$R->getPorcentajeIVA()."Valor IVA: ".$R->getValorIVA()."Total Unidad: ".$R->getTotalUnidad()."Cantidad: ".$R->getCantidad()."<br>";
            //Va al siguiente producto
              $R = $R->getAbajo(); 
          }
          $InfoCategoria = $InfoCategoria.$InfoProducto;
          // Va a la siguiente categoria
          $P = $P->getSig();
          $InfoProducto = null;
        }
      }
      return "$InfoCategoria";
    }
}
   ?>