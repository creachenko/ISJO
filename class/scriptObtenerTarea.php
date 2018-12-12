<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idEstudiante = $_POST['idEstudiante'];
$idTarea = $_POST['idTarea'];


$sql ="SELECT idEstadoTarea FROM estadotareas
							WHERE idEstudiante = '$idEstudiante' AND
										idTarea = '$idTarea'";
$resp = $conexion->bd->query($sql);

if ($resp->num_rows > 0) {
	$sql = "SELECT estadotareas.idEstadoTarea,
						puntajeObtenido,
						tareaPresentada,
						motivoTareaNoPresentada,
						CONCAT(nombreEstudiante,' ',apellidoEstudiante) AS nombreCompleto
	 				FROM estadotareas
					INNER JOIN Estudiantes
					ON estudiantes.idEstudiante = estadotareas.idEstudiante
					WHERE estadotareas.idEstudiante = $idEstudiante
					AND idTarea = $idTarea";

	echo json_encode($conexion->bd->query($sql)->fetch_assoc());
}else{
	$sql = "SELECT CONCAT(nombreEstudiante,' ',apellidoEstudiante) AS nombreCompleto,
									CONCAT ('0','') AS puntajeObtenido
					FROM Estudiantes
					WHERE idEstudiante = $idEstudiante";
	echo json_encode($conexion->bd->query($sql)->fetch_assoc());
}



 ?>
