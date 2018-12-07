<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idModalidad = $_POST['idModalidad'];
$sql="SELECT idAsignatura,nombreAsignatura,modalidades.idModalidad
      FROM asignaturas
      INNER JOIN modalidades
      ON asignaturas.idModalidad = modalidades.idModalidad
      WHERE asignaturas.idModalidad = '$idModalidad'";

$resp = $conexion->bd->query($sql);

      $array = array();
      $i = 0;
      while ($row = mysqli_fetch_array($resp)) {
        $array[$i] = $row;
        $i++;
      }

      echo json_encode($array);

 ?>
