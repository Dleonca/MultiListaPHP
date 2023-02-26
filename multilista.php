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
          $InfoCategoria = $InfoCategoria.'<br><p>- '.$P->getIdCategoria()." Categoría: ".$P->getNombreCategoria()."</p>";
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
    //Codigo no terminado
    /*function ValidateIdNoRepeatIdProducto($ $IdProd){
      $n = $ne->getAbajo();
        $cuantos2 = 0;
        while ($n != null ) {
           
            if ($n->getIdLibro() == $id) {
                $cuantos2 =  $cuantos2 +1;
            } 
            
            $n = $n->getAbajo();
        }

        if ($cuantos2 >= 1) {
            $mds = "no valido";
         } else {
            $mds = "valido";
         }
         
         return $mds;
        
    }*/

// Realiza recorrido a la lista de categorias.
 /* function RecorrerCategorias(){
    $P = $this->Inicial;
    $InfoCategoria = ""; 
    if ($P == null) { 
      return "Esta vacia";
    } else {
      while ($P != null) {
        $InfoCategoria = $InfoCategoria."<br>- ".$P->getIdCategoria()."Nombre De La Categoria: ".$P->getNombreCategoria();
        $P = $P->getSig();
      }
      return "$InfoCategoria";
    }
  }
*/

  // Lista De Categorías
    function ComboCategorias(){
        $options = ""; 
        $P = $this->Inicial;
        while ($P != null) {
            $options = $options.'<option value="'.$P->getIdCategoria().'">'.$P->getIdNombreCategoria().'</option>';
            $P = $P->getSig();
        }
        return "$options";
    }
  }    

//**METODOS PENDIENTES**
//Metodo actualizar información del producto: Este metodo va a actualizar la información de porcentaje IVA, valor unidad, y el nombre. 
//Metodo adicionar cantidad: Adicionar la cantidad de un producto, adicionar el stock del producto sin perder el stock anterior.
//Metodo reducir cantidad: Este metodo buscará un producto, y reducirá su cantidad disponible en el stock.
//Metodo de ordenamiento: Este se encargará de ordenar la categoría, y los productos dentro de la categoría. Atributo: ID para ambos.


   ?>