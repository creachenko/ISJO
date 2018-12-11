<?php
require_once "conexionbd.php";

$conexion = new conexionBD;

$sql ="SELECT estudiantes.idEstudiante AS id,CONCAT(nombreEstudiante,'  ',apellidoEstudiante,' // ',nombreCurso,'-',seccion) AS name,identidad 
        FROM estudiantes INNER JOIN matricula
        ON matricula.idEstudiante = estudiantes.idEstudiante
        INNER JOIN cursos
        ON matricula.idCurso = cursos.idCurso
        INNER JOIN aniolectivo
        ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
        WHERE aniolectivo.anio = YEAR(CURDATE())
        ORDER BY cursos.idCurso";

$resp = $conexion->bd->query($sql);

$array = array();
$i = 0;
while ($row = mysqli_fetch_assoc($resp)) {
  $array[$i] = $row;
  $i++;
}

echo json_encode($array);

 ?>
