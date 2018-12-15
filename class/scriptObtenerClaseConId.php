<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idClase = $_POST['idClase'];

$sql = "SELECT * FROM clases
				INNER JOIN  cursos
				ON cursos.idCurso = clases.idCurso
				INNER JOIN asignaturas
				ON clases.idAsignatura = asignaturas.idAsignatura
        WHERE clases.idClase = $idClase";
$resp = $conexion->bd->query($sql)->fetch_assoc();

echo $resp['nombreAsignatura']." // ".$resp['nombreCurso']." - ".$resp['seccion'];

 ?>
