<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$id = $_POST['idModalidad'];

  $sql="SELECT idCurso,nombreCurso,seccion,nombreModalidad,anio
        FROM cursos
        INNER JOIN modalidades
        ON cursos.idModalidad = modalidades.idModalidad
        INNER JOIN aniolectivo
        ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
        WHERE cursos.idModalidad= 2
        AND aniolectivo.anio = YEAR(curdate())";



echo json_encode($conexion->bd->query($sql)->fetch_array());


 ?>
