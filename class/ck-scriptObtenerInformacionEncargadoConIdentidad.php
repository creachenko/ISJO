<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$identidad = $_POST['identidad'];
$sql="SELECT * FROM encargados WHERE identidad='$identidad'";

$resp = $conexion->bd->query($sql)->fetch_assoc();

echo json_encode($resp);

 ?>
