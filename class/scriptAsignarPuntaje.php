<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$puntaje = $_POST['puntaje'];
$idTarea = $_POST['idTarea'];
$idEstudiante = $_POST['idEstudiante'];



$sql ="INSERT INTO estadotareas (puntajeObtenido,idTarea,idEstudiante)
				VALUES ('$puntaje','$idTarea',$idEstudiante)";

// $conexion->bd->query($sql);



 ?>
