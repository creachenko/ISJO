<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idModalidad = $_POST['idModalidad'];

$sql="SELECT * FROM cursos INNER JOIN aniolectivo ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo WHERE anio=year(curdate()) AND idModalidad= '$idModalidad' ";

$resp = $conexion->bd->query($sql);

$array = array();
$i = 0;
while ($row = mysqli_fetch_array($resp)) {
  $array[$i] = $row;
  $i++;
}

echo json_encode($array);

 ?>
