<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idParcialActual = $_POST['idParcialActual'];
$idParcialSet = $_POST['idParcialSet'];

$sql ="UPDATE parcialactual
        SET idParcialPorModalidad ='$idParcialSet'
        WHERE idParcialActual = '$idParcialActual'";

$resp = $conexion->bd->query($sql);


 ?>
