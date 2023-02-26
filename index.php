<?php 
  include("multilista.php");
  session_start(); //variable de session cookies
  if (isset($_SESSION["Mlista"]) == false){
    $_SESSION["Mlista"] = new multilista();
    //echo"lista creada";
  }
?> 
<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listas Enlazadas</title>
    <link rel="stylesheet" href="css/style.css">
 </head>
  <body>
   <header>
     <h1 class="tituloPagina">MultiListas</h1>
   </header>
    <?php echo '<p>Hello World</p>'; ?> 
  </body>
</html>