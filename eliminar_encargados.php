<?php
require_once "class/funciones.php";
$obj= new funcionesBD();
if (!isset($_GET["id"])OR !is_numeric($_GET["id"])){
	die("ERROR 404");
}
//esta variable es para comparar datos
$datos=$obj->obtener_encargados($_GET["id"]);
if(sizeof($datos)==0){
  die("ERROR 404");
}


  $obj->eliminar_encargados();
  

?>