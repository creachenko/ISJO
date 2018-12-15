<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idClase = $_POST['idClase'];

$sql = "SELECT parcialespormodalidad.nombreParcialPorModalidad,parcialespormodalidad.idParcialPorModalidad FROM parcialactual
		INNER JOIN parcialespormodalidad
        ON parcialactual.idParcialPorModalidad = parcialespormodalidad.idParcialPorModalidad
        INNER JOIN modalidades
        ON parcialespormodalidad.idModalidad = modalidades.idModalidad
        INNER JOIN cursos
        ON modalidades.idModalidad = cursos.idModalidad
        INNER JOIN clases
        ON clases.idCurso = cursos.idCurso
        WHERE clases.idClase = $idClase";
$resp = $conexion->bd->query($sql)->fetch_assoc();
$idParcialActual = $resp['idParcialPorModalidad'];

$sql="SELECT * from tareas
      WHERE idParcialPorModalidad = $idParcialActual
			AND idClase = $idClase";

$resp = $conexion->bd->query($sql);

$array = array();
$i = 0;
while ($row = mysqli_fetch_array($resp)) {
  $array[$i] = $row;
  $i++;
}

echo json_encode($array);

 ?>
