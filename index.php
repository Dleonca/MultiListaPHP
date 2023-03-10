<?php 
  include("multilista.php");
  include("nodoProducto.php");
  //Variable de session cookies
  session_start();
  if (isset($_SESSION["Mlista"]) == false){
    $_SESSION["Mlista"] = new Multilista();
  }
  //echo"lista creada";
  function phpAlert($msg){
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }
?> 
<!-- inicio de documento html-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas Enlazadas</title>
    <link rel="stylesheet" href="css/style.css">
  <script>
		function cambiarClase() {
			var select = document.getElementById("optCRUD");
      var div1 = document.getElementById("crudName");
			var div2 = document.getElementById("crudDelete");
      var div3 = document.getElementById("searchMulti");
			var clase = select.options[select.selectedIndex].value;
      if (clase == '0') {
        div1.className = 'agregar-multi';
        div2.className = 'oculto';
        div3.className = 'oculto';
      }
      if (clase == '1') {
        div1.className = 'oculto';
        div2.className = 'eliminar-multi';
        div3.className = 'oculto';
      } 
      if (clase == '2') {
        div1.className = 'oculto';
        div2.className = 'oculto';
        div3.className = 'buscar-multi';
      } 
		}
	</script>
</head>
<body>
  <!-- header principal-->
   <header class = "headerPrincipal">
     <div class="hIzq">
       <h1 class="tituloPagina">OFILY Inventory</h1>
     </div>
     <div class="hDer">
        <label for="optCRUD" class="labelCRUD">Opciones</label>
          <select class="selectCRUD" name="optCRUD" id="optCRUD" onchange ="cambiarClase()">
            <option class="optstyle" value="0">Agregar</option>
            <option class="optstyle" value="1">Eliminar</option>
            <option class="optstyle" value="2">Buscar</option>
          </select>
     </div>
   </header>

   <!-- contenedor principal -->
   <main class="principal">
     <!-- En este section estaran todos los procesos: agregar, eliminar, buscar entre otros  -->
     <section class="sct-crud">
        <!-- Contenedor de opciones agregar-->
        <div  class="agregar-multi" id="crudName"> 
          <div class="addcatg">
            <!-- Agregar categoria al inicio -->
            <!-- Agregar formulario para categor??a -->
            <h2 class="subtitulo">A??adir Categoria</h2>
            <form  class="formulario" action="index.php" method ="post"> 
              <div class="divrow">
                <div class="divcolumn XL">
                  <label for="IdCategoria">ID</label>
                  <input type="text" id="IdCategoria" name="IdCategoria" class="finput">
                </div>
                <div class="divcolumn L">
                  <label for="NombreCategoria">Nombre</label>           
                  <input type="text" id="NombreCategoria" name="NombreCategoria" class="finput">
                </div>
              </div>
              <div class="divrow">
                <div class="divcolumn XL">
                  <select name = "opciones" class="select-categorias">
                    <option value = "0">Agregar al inicio</option>
                    <option value = "1">Agregar al final</option>
                  </select>
                </div>
                <div class="divcolumn XL">
                <input type="submit" value="Agregar Categoria" name="AddCatg"  >
                </div>
              </div>
              <div class="divrow">
                <div class="divcolumn XL">
                <input type="submit" value="Buscar Categoria" name="SearchCatg"  >
                </div>
                <div class="divcolumn XL">
                <input type="submit" value="Ordenar Categorias" name="OrdCatg"  >
                </div>
              </div>
            </form>
            <!-- Codigo PHP para agregar categoria-->
            <?php
              if (isset($_POST["AddCatg"])) {
                $IdCat = null;
                $NomCatg = null;
                $IdCat = $_POST["IdCategoria"];
                $NomCatg = $_POST["NombreCategoria"];
                if ($IdCat == null || $NomCatg == null) {
                  phpAlert("No hay informaci??n para agregar una categor??a.");
                } else {
                  $va =  $_SESSION["Mlista"]->ValidateIdNoRepeatCatg($IdCat);
                  if ($va == False) {
                    phpAlert("No se puede repetir el ID de la categor??a.");
                  } else {
                    $N = new NodoCategoria($IdCat, $NomCatg);
                    $Seleccion = $_POST['opciones'];  // Almacena el valor seleccionado en la variable $seleccion
                    if($Seleccion == '0') {  // Verifica si la opci??n seleccionada es 'opcion1'
                      $_SESSION["Mlista"]->AgregarCategoriaInicio($N);
                    } elseif($Seleccion == '1') {  // Verifica si la opci??n seleccionada es 'opcion2'
                      $_SESSION["Mlista"]->AgregarCategoriaFinal($N);
                    } 
                  } 
                }
              }elseif (isset($_POST["SearchCatg"])) {
                $IdCat = $_POST["IdCategoria"];
                if ($IdCat == null ) {
                  phpAlert("Proporcione la ID de la categor??a para buscar si existe en la lista.");
                } else{
                  $catg = $_SESSION["Mlista"]->buscarInfoCategoria($IdCat);
                  if ($catg == null){
                    phpAlert("no se encontro esta categoria");
                  }else{
                    phpAlert($catg);
                  }
                }
              }elseif (isset($_POST["OrdCatg"])) {
                $_SESSION["Mlista"]->OrdenarCategoriaBubbleSort();
              }
            ?>
            <br>
          </div>
          <div class="addprod">
            <!-- Agregar formulario para Productos -->
            <h2 class="subtitulo">A??adir Producto</h2>
            <form class="formulario" action="index.php" method ="post">
              <div class="divrow">
                <div class="divcolumn XX">
                  <label>Categoria</label>
                  <select id="categorias" name="select-catg" class="select-categorias ">
                  
                    <?php
                      
                      $V = $_SESSION["Mlista"]->ListaVaciaCatg();
                      if ($V == True) {
                        echo '<option value="null">null</option>';//no agrega ninguna opcion
                      } else {
                        echo $_SESSION["Mlista"]->crearCombo();
                      }
                    ?>
                  </select> 
                </div>
                <div class="divcolumn X">
                  <label for="IdProducto">ID</label>
                  <input type="text" id="IdProducto" name="IdProducto" class="finput">
                </div>
                <div class="divcolumn XX">
                  <label for="Marca">Marca</label>
                  <input type="text" id="Marca" name="Marca" class="finput">
                </div>
                <div class="divcolumn XL">
                  <label for="NombreProducto">Nombre</label>           
                  <input type="text" id="NombreProducto" name="NombreProducto" class="finput">
                </div>
              </div>
              <div class="divrow">
                <div class="divcolumn XXX">
                  <label for="ValorUnidad">Valor UND</label>
                  <input type="number" id="ValorUnidad" name="ValorUnidad" class="finput">
                </div>
                <div class="divcolumn X">
                  <label for="PorcentajIVA">% IVA</label>
                  <input type="number" id="PorcentajeIVA" name="PorcentajeIVA" class="finput">
                </div>
                <div class="divcolumn X">
                  <label for="Cantidad">Cantidad</label>
                  <input type="number" id="Cantidad" name="Cantidad" class="finput">   
                </div>
                <div class="divcolumn XX">
                  <input type="submit" value="Agregar Producto" name="AddProd" >
                </div>
              </div>
              <div class="divrow">
                <div class="divcolumn XX">
                  <input type="submit" value="Buscar Producto" name="SearchProd" >
                </div>
                <div class="divcolumn XX">
                  <input type="submit" value="Disminuir Cantidad" name="Disminuir" >
                </div>
                <div class="divcolumn XX">
                  <input type="submit" value="Aumentar Cantidad" name="Aumentar" >
                </div>
                <div class="divcolumn XX">
                  <input type="submit" value="Actualizar Poducto" name="Actualizar" >
                </div>
              </div>
            </form>
            <!-- codigo PHP para agregar productos-->
            <?php
              if (isset($_POST["AddProd"])) {
                //asignamos a las variables la informacion que coloco el usuario en los input.
                $catgProd = $_POST["select-catg"];
                $idP = $_POST["IdProducto"];
                $marcaP = $_POST["Marca"];
                $nombreP = $_POST["NombreProducto"];
                $valund = $_POST["ValorUnidad"];
                $ptjeIVA = $_POST["PorcentajeIVA"];
                $cant = $_POST["Cantidad"];
                $option = isset($_POST['select-catg']) ? $_POST['select-catg'] : false;
                if ($option == true && $option != "null") {
                  if ($idP == "" || $marcaP == "" || $nombreP == "" || $valund == "" || $ptjeIVA == "" || $cant == "" ) {
                    phpAlert("todos los campos son obligatorio, ninguno puede ser nulo -".$idP);
                  } else {
                    $np = new nodoProducto($idP, $marcaP, $nombreP, $valund, $ptjeIVA, $cant);
                    $nodoCatg = $_SESSION["Mlista"]->buscarCategoria($catgProd);
                    $valida_idProd = $_SESSION["Mlista"]->ValidateIdProdNoRepeat($nodoCatg,$idP);
                    if ($valida_idProd == True) {
                      $_SESSION["Mlista"]->AdicionarProducto($nodoCatg, $np);
                      phpAlert("Producto Agregado Exitosamente.");
                    } else {
                      phpAlert("ID de PRoducto debe ser unica.");
                    }
                  }
                  $catgProd = null;
                  $idP = null;
                  $marcaP = null;
                  $nombreP = null;
                  $valund = null;
                  $ptjeIVA = null;
                  $cant = null;
                } else {
                  phpAlert("Seleccione Categoria para este libro");
                }
              }elseif(isset($_POST["SearchProd"])){
                $idP = $_POST["IdProducto"];
                if ($idP == null ) {
                  phpAlert("Proporcione la ID de un producto para buscar si exixte en la lista.");
                } else{
                  $Product = $_SESSION["Mlista"]->buscarInfoProducto($idP);
                  if ($Product == null){
                    phpAlert("no se encontro este Producto");
                  }else{
                    phpAlert($Product);
                  }
                }
              }elseif(isset($_POST["Disminuir"])){
                $catgProd = $_POST["select-catg"];
                $idP = $_POST["IdProducto"];
                $cant = $_POST["Cantidad"];
                $res = $_SESSION["Mlista"]->disminuirCantProd($catgProd, $idP, $cant);
                phpAlert($res);
              }elseif(isset($_POST["Aumentar"])){
                $catgProd = $_POST["select-catg"];
                $idP = $_POST["IdProducto"];
                $cant = $_POST["Cantidad"];
                $res = $_SESSION["Mlista"]->aumentarCantProd($catgProd, $idP, $cant);
                phpAlert($res);
              }elseif(isset($_POST["Actualizar"])){
                $catgProd = $_POST["select-catg"];
                $idP = $_POST["IdProducto"];
                $marcaP = $_POST["Marca"];
                $nombreP = $_POST["NombreProducto"];
                $valund = $_POST["ValorUnidad"];
                $ptjeIVA = $_POST["PorcentajeIVA"];
                $cant = $_POST["Cantidad"];
                $res = $_SESSION["Mlista"]->ActualizarProd($catgProd, $idP, $marcaP,$nombreP,$valund, $ptjeIVA, $cant);
                phpAlert($res);
              }
                
            ?>
            <br>
          </div>
        </div>
        <!-- Contenedor de opciones eliminar-->
        <div  class="oculto" id="crudDelete">
          <div class="addcatg" id="delctg">
            <!-- Eliminar formulario para categor??a -->
            <h2 class="subtitulo">Eliminar Categoria</h2>
            <form  class="formulario" action="index.php" method ="post"> 
              <div class="divrow">
                <div class="divcolumn X">
                  <label for="IdCategoria" class="centro">ID</label>
                </div>
                <div class="divcolumn XX">
                  <input type="text" id="IdCategoria" name="IdCategoria" class="finput">
                </div>
                <div class="divcolumn XXX">
                  <select name = "OpcionesDelete" class="select-categorias">
                    <option value = "0">Eliminar Categoria</option>
                    <option value = "1">Eliminar Categoria Completa</option>
                  </select>
                </div>
                <div class="divcolumn XXX">
                <input type="submit" value="Eliminar Categoria" name="DelCatg"  >
                </div>
              </div>
            </form>
            <?php
              // Codigo para eliminar una categoria
              if (isset($_POST["DelCatg"])) {
                $OptDelete = $_POST["OpcionesDelete"];
                //Codigo para eliminar categor??a vac??a
                if ($OptDelete == "0"){
                  
                  $NodoDelete = null;
                  $txtIDCatg = $_POST["IdCategoria"];
                  $NCatg = $_SESSION["Mlista"]->buscarCategoria($txtIDCatg);
                  if($txtIDCatg!=""){
                    if ($NCatg == null) {
                      phpAlert("Esta categoria no existe.");
                    } else{
                      if ($_SESSION["Mlista"]->CategoriaSinProducto($NCatg) == false){
                        phpAlert("Esta categoria contiene productos. Si desea eliminarla, favor utilizar la opci??n Eliminar categor??a completa");
                      }else {
                        $NodoDelete = $_SESSION["Mlista"]->EliminarCategoria($txtIDCatg); 
                        phpAlert("La categoria : ".$txtIDCatg." ha sido eliminado correctamente.");
                      }
                    }
                    
                  }
                }
                //Codigo para eliminar categor??a completa
                //if ($OptDelete = "1"){null}
              }
            ?>
          </div>
          <div class="addprod" id="delprod">
            <!-- Agregar formulario para Productos -->
            <h2 class="subtitulo">Eliminar Producto</h2>
            <form class="formulario" action="index.php" method ="post">
              <div class="divrow">
                <div class="divcolumn X" center>
                  <label class="centro">Categoria</label>
                </div>
                 <div class="divcolumn XX">
                  <select id="categorias" name="select-catg" class="select-categorias ">
                    <?php
                      $V = $_SESSION["Mlista"]->ListaVaciaCatg();
                      if ($V == True) {
                        echo '<option value="null">null</option>';//no agrega ninguna opcion
                      } else {
                        echo $_SESSION["Mlista"]->crearCombo();
                      }
                    ?>
                  </select> 
                </div>
                <div class="divcolumn X" >
                  <label for="IdProducto" class="centro">ID</label>
                </div>
                <div class="divcolumn XX">
                  <input type="text" id="IdProducto" name="IdProducto" class="finput">
                </div>
                <div class="divcolumn XX">
                  <input type="submit" value="Eliminar" name="delProd" >
                </div>
              </div>
            </form>
            <!-- codigo PHP para agregar productos-->
            <?php 
              if (isset($_POST["delProd"])) {
                $prodid = $_POST["IdProducto"];
                $catID = $_POST["select-catg"];
                if ($prodid != null && $catID != null) {
                  $res = $_SESSION["Mlista"]->eliminarProducto($catID, $prodid);
                  if ($res == true) {
                    phpAlert( "Libro eliminado correctamente!");
                  }else{
                    phpAlert( "Libro no encontrado");
                  } 
                } else {
                  phpAlert("PAra eliminar un producto proporcione la ID del producto y la categoria a la que pertenece!");
                } 
              }
            ?>
          </div>
        </div>
     </section>
     <!--En este section solo se visualizara la multilista -->
     <section class="sct-multilista" id="crudRead">
        <!-- Visualizar lista -->
        <?php
          echo  $_SESSION["Mlista"]-> VisualizarMultilista();
        ?>
     </section>
   </main>
   

  </body>
</html>