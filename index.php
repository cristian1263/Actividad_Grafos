<?php  
    
    include("grafos.php");
    session_start();
    if (isset($_SESSION["grafo"])==false) {
    	$_SESSION["grafo"]= new grafos();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta  name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet"  href="interfaz.css">

    <script type="text/javascript" src="vis/dist/vis.js"></script>

    <link href="vis/dist/vis.css" rel="stylesheet" type="text/css">

    <style type="text/css">
 #graf1{
  position: absolute;
  top: 150px;
  left: 400px;
  width:  400px;
  height: 200px;
  border: 2px solid lightgray;
  background-color: lightcyan;
 }

  #graf2{
  position: absolute;
  top: 400px;
  left: 400px;
  width:  400px;
  height: 200px;
  border: 2px solid lightgray;
  background-color: lightcyan;
 }
</style>
 
<style>
  ::placeholder{
    color:white;
  }

</style>

	<title>Grafos</title>
</head>
<body>
  <h1 id="TituloPagina">Grafos con JavaScript </h1>

<form class="vertice" action="index.php" method="post">
  <h3 id="TituloGrafo">Agregar Vertice</h3>
  <input required id="TextoVertice" placeholder="Inserte Vertice"   type="text" name="Vertice">
  <input id="AgregarV" type="submit" value="Agregar Vertice" name="BotomAgregarVertice">
 </form>

<?php  
if(isset($_POST["BotomAgregarVertice"])!=null){
  if (isset($_POST["Vertice"])){

    $v= new Vertice($_POST["Vertice"]);

      if($_SESSION["grafo"]->AgregarVertice($v)){
       echo "<script>alert('Creado Correctamente');</script>";
      }else{
        echo "<script>alert('Vertice ya existente');</script>";
      }
    

  }
}
?>

<form class="vertice" action="index.php" method="post">
  <h3 id="TituloArista">Agregar Arista</h3>
  <input required id="TextoOrigen" placeholder="Vertice Origen" type="text" name="VerticeOrigen">
  <input required id="TextoDestino" placeholder="Vertice Destino" type="text" name="VerticeDestino">
  <input  id="TextoPeso" placeholder="Peso" type="text" name="Peso">
  <input  id="AgregarA" type="submit" value="Agregar Arista" name="BotomAgregarArista">
</form>

<?php
if(isset($_POST["BotomAgregarArista"])!=null){
  if (isset($_POST["VerticeOrigen"]) && isset($_POST["VerticeDestino"]) && isset($_POST["Peso"])){
   
    
        
   if ($_SESSION["grafo"]->AgregarArista($_POST["VerticeOrigen"],$_POST["VerticeDestino"],$_POST["Peso"])) {
    
     echo "<script>alert('Agregado Correctamente');</script>";
     
       }else{
      
          echo "<script>alert('Datos ingresados de forma erronea');</script>";
    
          }
  } 
}  
?>


<form class="vertice" action="index.php" method="post">
  <h3 id="TituloVerVertice">Ver Vertice</h3>
  <input required id="TextoVerVertice" placeholder="Agregar Vertice"   type="text" name="VerVertice">
  <input id="AgregarVertice" type="submit" value="Ver Vertice" name="BotomVerVertice">
 </form>

 <?php

if ((isset($_POST["BotomVerVertice"]) != null) &&  (isset($_POST["VerVertice"]))){

$Dato=(($_SESSION["grafo"])->getVertice($_POST["VerVertice"]));

if($Dato != null){
 

  if($Dato->getVisitado()){
  echo "<script>alert('Id: ".$Dato->getId().", Visitado');</script>";
    
  }else{
   echo "<script>alert('Id: ".$Dato->getId().", No visitado');</script>";
   } 

}else{
  echo "<script>alert('No existe el vertice');</script>";
}

}
?>
 
<form class="vertice" action="index.php" method="post">
  <h3 id="TituloAdyacente">Adyacente</h3>
  <input required id="TextoAdyacente" placeholder="Inserte vertice " type="text" name="VerticeAdyacente">
  <input id="Adyacentes" type="submit" value="Adyacente " name="BotomAdyacentes">
</form>

<form class="vertice" action="index.php" method="post">
<h3 id="TituloGrado">Grado</h3>  
<input  required id="TextoGrado" placeholder="Inserte el vertice" type="text" name="Grado">
<input id="Grado"  type="submit" value="Grado" name="BotomGrado">
</form>

<?php

if ((isset($_POST["BotomGrado"]) != null) && (isset($_POST["Grado"]))) {

 $Gtotal=(($_SESSION["grafo"])->grado($_POST["Grado"]));   
$matriz = $_SESSION["grafo"]->getMatrizA();



     if ( $matriz == null) {

                  // echo "<script>alert('El vertice no existe');</script>"; 
               }else{

                   $comp = false;

        foreach ($matriz as $key => $value ) {
      
       if ($key == $_POST["Grado"]) {

              
               
               $comp= false;
               break;
           }else{

           $comp = true;

           }
           

       }; 

       if ($comp == true) {

           echo "<script>alert('El vertice no existe');</script>"; 
           
       }
      
      if ($comp==false) {
        echo "<script>alert('El grado es: ".$Gtotal."');</script>";
      }
  }
}

?>

<form class="vertice" action="index.php" method="post">
<h3 id="TituloELiminarVertice">Eliminar Vertice</h3>  
<input required id="TextoEliminarVertice" placeholder="Inserte el vertice" type="text" name="EliminarVertice">
<input id="EliminarVertice" type="submit" value="Eliminar Vertice" name="BotomEliminar">
</form>

<?php
if(isset($_POST["BotomEliminar"])!=null){

  if (isset($_POST["EliminarVertice"])){
    
    if ($_SESSION["grafo"]->eliminarVertice($_POST["EliminarVertice"])) {
    
       echo "<script>alert('Eliminado Correctamente');</script>";
    
      }else{
          echo "<script>alert('El vertice no existe');</script>";
        }
  }
}  
?> 

<form class="vertice" action="index.php" method="post"> 
  <h3 id="TituloELiminarArista">Eliminar Arista</h3>  
<input required id="TextoEliminarArista1" placeholder="Inserte Origen" type="text" name="EliminarOrigen"> <br>
<input required id="TextoEliminarArista2" placeholder="Inserte Destino" type="text" name="EliminarDestino">
<input id="EliminarArista" type="submit" value="Eliminar Arista" name="BotomEliminarArista">
</form>


<?php

if ((isset($_POST["BotomEliminarArista"]) != null) && (isset($_POST["EliminarOrigen"])) && (isset($_POST["EliminarDestino"]))) {
  if(($_SESSION["grafo"])->eliminarArista(($_POST["EliminarOrigen"]),($_POST["EliminarDestino"]))){
    echo "<script type='text/javascript'>alert('Eliminado');</script>";
  }else{
    echo "<script type='text/javascript'>alert('El dato no existe');</script>";
  }
}

?>



 <form class="vertice" action="index.php" method="post">
 <input  id="Mostrar" type="submit" value="Mostrar" name="Mostrar">
</form>


<?php
if(isset($_POST["Mostrar"])!= null){ 
if($_SESSION["grafo"]->getMatrizA()!= null){
echo "<pre>";
print_r($_SESSION["grafo"]->getMatrizA());
echo "<hr>";
}else{
  echo "<script type='text/javascript'>alert('No ha ingresao datos en el grafo');</script>";
}
}
?>


<div id="graf1"></div>


<script type="text/javascript">
 
  var nodos = new vis.DataSet([
<?php
$Array=($_SESSION["grafo"])->getMatrizA();

foreach ($Array as $key => $value) {
   if ($key != null) {
     echo "{id: '$key', label: '$key'},"; 
   }
    };
?> 

]); 



var Arista= new vis.DataSet([

<?php

$Array=($_SESSION["grafo"])->getMatrizA();

foreach ($Array as $key => $value) {
 
  if ($value != null) {
  foreach ($value as $Destino => $Peso) {
    echo "{from: '$key' , to: '$Destino', label: '$Peso'},";
  }
 }
};
?>
  ]);


 var contenedor = document.getElementById("graf1");



var datos = {
  nodes:nodos,
  edges:Arista
};

var opciones = {
  edges:{
    arrows:{
      to:{
        enabled: true
      }
    }
  }
};

var grafo = new vis.Network(contenedor, datos, opciones);

</script>



<div id="graf2"></div>
<?php

$matriz = $_SESSION["grafo"]->getMatrizA();
$existe=true;

    if(isset($_POST["BotomAdyacentes"])!=null){
     if (isset($_POST["VerticeAdyacente"])) {
      
                

              if ( $matriz == null) {

                  // echo "<script>alert('El vertice no existe');</script>"; 
           

               }else{

                   $comp = false;

        foreach ($matriz as $key => $value ) {
      
       if ($key == $_POST["VerticeAdyacente"]) {

              
                $existe=false;
               $comp= false;
               break;
           }else{

           $comp = true;

           }
           

       }; 

       if ($comp == true) {

           echo "<script>alert('El vertice no existe');</script>"; 
           
       }
           
       if (($_SESSION["grafo"]->getAdyacentes($_POST["VerticeAdyacente"])) == null) {
                 
                 if ($existe == false) {
                   echo "<script>alert('No tiene Adyacentes');</script>"; 
                 }
                       


         }      
   }
 }    }
    ?>
          
 


<script type="text/javascript">
 
  var nodos2 = new vis.DataSet([
<?php

$Array=($_SESSION["grafo"])->getMatrizA();
$Entrada=($_SESSION["grafo"])->getAdyacentes(($_POST["VerticeAdyacente"]));
$D=$_POST["VerticeAdyacente"];

if(isset($_POST["BotomAdyacentes"])!=null){

if (isset($_POST["VerticeAdyacente"])) {


     foreach ($Array as $key1 => $value1) {

       if (($key1)==($D)) {
        if($Entrada != null){
        if(!isset($Entrada[$D])){
          echo "{id:'$D',label:'$D'},";
        };
          
         foreach ($Entrada as $key => $value) {
  
           echo "{id: '$key', label: '$key'},";     
           };
         
      }
    }

    
    };

  }
}
?> 

]); 

var Aristas2 = new vis.DataSet([

<?php
if(isset($_POST["BotomAdyacentes"])!=null){

if (isset($_POST["VerticeAdyacente"])) {

 $Entrada=($_SESSION["grafo"])->getAdyacentes(($_POST["VerticeAdyacente"])); 
  $Nodo=($_POST["VerticeAdyacente"]);

         foreach ($Entrada as $key => $value) {        
           echo "{from:'$Nodo',to:'$key',label:'$value'},";    
           };     
    }
}

?> 

]); 


 var contenedor = document.getElementById("graf2");



var datos = {
  nodes:nodos2,
  edges:Aristas2
};

var opciones = {
  edges:{
    arrows:{
      to:{
        enabled: true
      }
    }
  },
};

var grafo = new vis.Network(contenedor, datos, opciones);
</script>

</body>
</html>


