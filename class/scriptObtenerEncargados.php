<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idEncargado= $_POST['idEncargado'];
$sql="SELECT * FROM encargados WHERE idEncargado='$idEncargado'";

$resp = $conexion->bd->query($sql)->fetch_assoc();

echo json_encode($resp);

 ?>
