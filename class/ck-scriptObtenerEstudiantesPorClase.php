<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idClase = $_POST['idClase'];

$sql ="SELECT * FROM estudiantes INNER JOIN matricula
        ON matricula.idEstudiante = estudiantes.idEstudiante
        INNER JOIN cursos
        ON matricula.idCurso = cursos.idCurso
        INNER JOIN clases
        ON cursos.idCurso = clases.idCurso
        WHERE idClase='$idClase'";

$resp = $conexion->bd->query($sql);

$array = array();
$i = 0;
while ($row = mysqli_fetch_array($resp)) {
  $array[$i] = $row;
  $i++;
}

echo json_encode($array);

 ?>
