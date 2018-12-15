<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$puntaje = $_POST['puntaje'];
$idEstadoTarea = $_POST['idEstadoTarea'];

echo "$puntaje"." ".$idEstadoTarea;

$sql ="UPDATE estadotareas
				SET puntajeObtenido ='$puntaje'
				WHERE  idEstadoTarea = $idEstadoTarea";

$conexion->bd->query($sql);



 ?>
