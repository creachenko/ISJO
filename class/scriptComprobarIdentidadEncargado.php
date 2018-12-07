<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$identidad = $_POST['identidad'];
$sql="SELECT idEncargado FROM encargados WHERE identidad= '$identidad'";

echo $conexion->bd->query($sql)->num_rows;


 ?>

 
