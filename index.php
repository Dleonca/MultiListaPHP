<?php 
  include("multilista.php");
  include("nodoProducto.php");
  //Variable de session cookies
  session_start();
  if (isset($_SESSION["Mlista"]) == false){
    $_SESSION["Mlista"] = new multilista();
  }
  //echo"lista creada";
  function phpAlert($msg){
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
  }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas Enlazadas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <header>
     <h1 class="tituloPagina">MultiListas</h1>
   </header>
  
  <!-- Agregar categoria al inicio -->
  <!-- Agregar formulario para categoría -->
  <form action="index.php" method ="post"> 
     <label for="IdCategoria">Id Categoria</label>
     <input type="text" id="IdCategoria" name="IdCategoria">
     <label for="NombreCategoria">Nombre Categoria</label>           
     <input type="text" id="NombreCategoria" name="NombreCategoria">
     <select name = "opciones" >
       <option value = "0">Agregar al inicio</option>
       <option value = "1">Agregar al final</option>
     </select>
     <input type="submit" value="Agregar Categoria" name="AddCatg" >
   </form>
  
  <!-- Codigo PHP para agregar categoria-->
  <?php
    if (isset($_POST["AddCatg"])) {
      $IdCat = null;
      $NomCatg = null;
      $IdCat = $_POST["IdCategoria"];
      $NomCatg = $_POST["NombreCategoria"];
      if ($IdCat == null || $NomCatg == null) {
        phpAlert("No hay información para agregar una categoría.");
      } else {
        $va =  $_SESSION["Mlista"]->ValidateIdNoRepeatCatg($IdCat);
        if ($va == False) {
          phpAlert("No se puede repetir el ID de la categoría.");
        } else {
          $N = new NodoCategoria($IdCat, $NomCatg);
          $Seleccion = $_POST['opciones'];  // Almacena el valor seleccionado en la variable $seleccion
          if($Seleccion == '0') {  // Verifica si la opción seleccionada es 'opcion1'
             $_SESSION["Mlista"]->AgregarCategoriaInicio($N);
          } elseif($Seleccion == '1') {  // Verifica si la opción seleccionada es 'opcion2'
            $_SESSION["Mlista"]->AgregarCategoriaFinal($N);
          } 
        } 
      }
    }
  ?>
<br>
  <!-- Agregar formulario para categoría -->
  <form action="index.php" method ="post">
    <label>Categoria</label>
    <select id="categorias" name="select-catg" class="select-categorias">
      <?php
        /*
        $V = $_SESSION["Mlista"]->ListaVaciaCatg();
        if ($V == True) {
          echo '<option value="null">null</option>';//no agrega ninguna opcion
        } else {
          echo $_SESSION["Mlista"]->crearCombo();
        }*/
      ?>
    </select> 
    <label for="IdProducto">Id Producto</label>
    <input type="text" id="IdProducto" name="IdProducto">
    <label for="Marca">Marca</label>
    <input type="text" id="Marca" name="Marca">
    <label for="NombreProducto">Nombre Producto</label>           
    <input type="text" id="NombreProducto" name="NombreProducto">
    <label for="ValorUnidad">Valor Unidad</label>
    <input type="number" id="ValorUnidad" name="ValorUnidad">
    <label for="PorcentajIVA">Porcentaje IVA</label>
    <input type="number" id="PorcentajeIVA" name="PorcentajeIVA">
    <label for="ValorIVA">Valor IVA</label>
    <input type="number" id="ValorIVA" name="ValorIVA" readonly>
    <label for="TotalUnidad">Total Unidad</label>
    <input type="number" id="TotalUnidad" name="TotalUnidad" readonly>
    <label for="Cantidad">Cantidad</label>
    <input type="number" id="Cantidad" name="Cantidad">    
    <input type="submit" value="Agregar Producto" name="AddProd" >
   </form>
  <br>
    <!-- Agregar categoria al final -->
    <!-- Visualizar lista -->
    <?php
      echo  $_SESSION["Mlista"]-> VisualizarMultilista();
    ?>

  </body>
</html>