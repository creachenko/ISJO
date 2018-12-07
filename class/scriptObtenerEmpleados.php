<?php
require_once "conexionbd.php";

$conexion = new conexionBD;
$idEmpleado = $_POST['idEmpleado'];
$sql="SELECT idEmpleado,nombreEmpleado,apellidoEmpleado,identidad,correo,fechaNacimiento,genero,imprema,empleados.idCargo AS empleadoIdCargo,nombreCargo,direccion,empleados.fechaIniLabor,celular,tituloMedia,tituloUniversitario FROM empleados INNER JOIN cargos ON empleados.idCargo = cargos.idCargo WHERE idEmpleado= '$idEmpleado'";

$resp = $conexion->bd->query($sql)->fetch_assoc();

echo json_encode($resp); 

 ?>
