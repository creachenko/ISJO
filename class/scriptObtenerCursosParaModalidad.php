<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idModalidad = $_POST['idModalidad'];
//Pregunto en que año estamos
$sql = "SELECT YEAR(CURDATE()) AS anio";
$resp = $conexion->bd->query($sql)->fetch_assoc();
$anio = $resp['anio'];

$sql ="SELECT * FROM cursos
       INNER JOIN modalidades
       ON cursos.idModalidad = modalidades.idModalidad
       INNER JOIN aniolectivo
       ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
       WHERE modalidades.idModalidad = '$idModalidad'
       AND anio = '$anio'";

$resp = $conexion->bd->query($sql);

$array = array();
$i = 0;
while ($row = mysqli_fetch_array($resp)) {
  $array[$i] = $row;
  $i++;
}

echo json_encode($array);

 ?>
