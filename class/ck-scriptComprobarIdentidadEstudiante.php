<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$identidad = $_POST['identidadEstudiante'];
$sql="SELECT idEstudiante FROM estudiantes WHERE identidad= '$identidad'";

echo $conexion->bd->query($sql)->num_rows;


 ?>
