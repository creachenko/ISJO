<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$identidad = $_POST['identidadEstudiante'];
//Pregunto en que año estamos
$sql = "SELECT YEAR(CURDATE()) AS anio";
$resp = $conexion->bd->query($sql)->fetch_assoc();
$anio = $resp['anio'];

$sql ="SELECT * FROM estudiantes
       INNER JOIN matricula
       ON estudiantes.idEstudiante = matricula.idEstudiante
       INNER JOIN cursos
       ON matricula.idCurso = cursos.idCurso
       INNER JOIN modalidades
       ON cursos.idModalidad = modalidades.idModalidad
       INNER JOIN aniolectivo
       ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
       WHERE identidad = '$identidad'";

$resp = $conexion->bd->query($sql);

$row = mysqli_fetch_assoc($resp);


echo json_encode($row);

 ?>
