<?php
include("nodoCategoria.php");
//include("nodoProducto.php"); Preguntar al profesor si es necesario incluir esta clase.

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
      //if($P->Inicial == null){
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

//Adicionar Producto
    function AdicionarProducto($P, $Q){
      if ($this->CategoriaSinProducto($P)){
        $P->setAbajo($Q);
      } else {
        $R = $P->getAbajo(); 
        while ($R->getAbajo() != null) {
          $R = $R->getAbajo();
        }
        $R->setAbajo($Q);
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
          $InfoCategoria = $InfoCategoria.'<div class="MulticatProd".<br><p class="pcat"> '.$P->getIdCategoria()."  ".$P->getNombreCategoria()."</p>";
          //Guardamos el puntero Abajo en una variable
          $R = $P->getAbajo();
          while ($R != null) {
            $InfoProducto = $InfoProducto.'<p class="pprod">'.' Id: '.$R->getIdProducto().'<br>'. "Marca: ".$R->getMarca()."<br>" ."Nombre: ".$R->getNombreProducto()."<br>" ."Valor Und: ".$R->getValorUnidad()."<br>" ."IVA: ".$R->getPorcentajeIVA()."%"."<br>" ."Valor IVA: ".$R->getValorIVA()."<br>" ."Total Unidad: ".$R->getTotalUnidad()."<br>" ."Cantidad: ".$R->getCantidad()."<br>";
            //Va al siguiente producto
              $R = $R->getAbajo(); 
          }
          $InfoCategoria = $InfoCategoria.$InfoProducto.'</div>';
          // Va a la siguiente categoria
          $P = $P->getSig();
          $InfoProducto = null;
        }
      }
      return $InfoCategoria;
    }

    //Validar que no se repita la categoría
    function ValidateIdNoRepeatCatg($IdCatg){
      $P = $this->Inicial;
      $Cont = 0;
      while($P != null){
       if ($P->getIdCategoria() == $IdCatg) {
          $Cont = $Cont + 1;
        }
        $P = $P->getSig();
      }
      if ($Cont >= 1) {
        return False;
      } else {
        return True;
      }
    }

    //Validar que no se repita el ID del producto
    function ValidateIdProdNoRepeat($nc, $IdProd){
      $np = $nc->getAbajo();
      $contadorid = 0;
        while ($np != null ) {
            if ($np->getIdProducto() == $IdProd) {
              $contadorid =  $contadorid +1;
            } 
            $np = $np->getAbajo();
        }
        if ($contadorid >= 1){
          return False;
        } else {
          return True;
        }
    }

// Realiza recorrido a la lista de categorias.
 function buscarInfoProducto($IdProd){
    $P = $this->Inicial;
    $encontrado = false;
    $Producto = null;

    while ($P != null && $encontrado == false) {
      $R = $P->getAbajo();
      while ($R != null) {
        if($R->getIdProducto() == $IdProd){
          $encontrado = true;
          $Producto = "Existe el producto: ".$R->getIdProducto()." Marca: ".$R->getMarca()." Nombre: ".$R->getNombreProducto()." Valor Unidad: ".$R->getValorUnidad()." IVA: ".$R->getPorcentajeIVA()."% Valor IVA: ".$R->getValorIVA()." Total Unidad: ".$R->getTotalUnidad()." Cantidad: ".$R->getCantidad()." !";
        }
        $R = $R->getAbajo();
      }
      $P = $P->getSig();
    }
    return $Producto;
  }
  function buscarInfoCategoria($i){
    $P = $this->Inicial;
    $Q =  $P->getAbajo();
    $encontrado = false;
    while ($P != null && $encontrado == false) {
        if ($P->getIdCategoria() == $i) {
          $encontrado = true;
          $Categoria = "Existe la categoria: ".$P->getIdCategoria()."  ".$P->getNombreCategoria()." !!";
        } else {
            $P = $P->getSig();
        }
    }
    return $Categoria;
  }
// Realiza recorrido a la lista de Productos.
 function buscarCategoria($i){
    $P = $this->Inicial;
    $encontrado = false;
    while ($P != null && $encontrado == false) {
        if ($P->getIdCategoria() == $i) {
            $encontrado = true;
        } else {
            $P = $P->getSig();
        }
    }
    return $P;
  }


  // Lista De Categorías
    function crearCombo(){
      $options = ""; 
      $P = $this->Inicial;
      while ($P != null) {
      $options = $options.'<option value="'.$P->getIdCategoria().'">'.$P->getNombreCategoria().'</option>';
      $P = $P->getSig();
      }
      return "$options";
    }
     

//Eliminar Categoria
    function EliminarCategoria($EC){
      $P = $this->Inicial;
      $Ant = $P;
      $Encontrado = false;
      $Eliminado = false;
      while($P != null && !$Encontrado ){
        if($P->getIdCategoria() == $EC){
          $Encontrado = true;
        }else{
          $Ant = $P;
          $P = $P->getSig();
        }
      }
      if($P == null){
        $Eliminado = false;
      }else{
        if($P == $this->Inicial){
          $this->Inicial = $this->Inicial->getSig();
          if ($P == $this->Final){
            $this->Final = null;
          }
        }else{
          $Ant->setSig($P->getSig());
          if ($P == $this->Final){
            $this->Final = $Ant;
          }
        }
        $P = null;
        $Eliminado = true;
      }
      return $Eliminado;
    }
  //eliminar producto
  function eliminarProducto($ic, $ip){
    $P = $this->buscarCategoria($ic);
    if ($P == null) {
      return false;
    } else {
      $Q = $P->getAbajo();
      $ant = $Q;
      $encontrado = false;
      while ($Q != null && $encontrado == false) {
        if ($Q->getIdProducto() == $ip) {
          $encontrado = true;
        } else {
          $ant = $Q;
          $Q = $Q->getAbajo();
        }
      }
      if ($Q == null) {
        return false;
      } else {
        if ($Q === $P->getAbajo()) {
          $P->setAbajo($Q->getAbajo());
        } else {
          $ant->setAbajo($Q->getAbajo());
        }
        $Q = null;
        return true;
      }
    }
  }
} 

//**METODOS PENDIENTES**
//Metodo actualizar información del producto: Este metodo va a actualizar la información de porcentaje IVA, valor unidad, y el nombre. 
//Metodo adicionar cantidad: Adicionar la cantidad de un producto, adicionar el stock del producto sin perder el stock anterior.
//Metodo reducir cantidad: Este metodo buscará un producto, y reducirá su cantidad disponible en el stock.
//Metodo de ordenamiento: Este se encargará de ordenar la categoría, y los productos dentro de la categoría. Atributo: ID para ambos.


?>