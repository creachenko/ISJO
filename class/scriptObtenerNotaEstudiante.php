<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idClase = $_POST['idClase'];
$idEstudiante = $_POST['idEstudiante'];
$sql = "SELECT SUM(puntajeObtenido) AS nota
				FROM estadotareas
				INNER JOIN tareas
				ON estadotareas.idTarea = tareas.idTarea
				WHERE estadotareas.idEstudiante = $idEstudiante
				AND tareas.idClase = $idClase";
$resp = $conexion->bd->query($sql)->fetch_assoc();



echo $resp['nota'];

 ?>
