<?php
session_start();
include 'class/funciones.php';
if (isset($_SESSION["ses_id"])) {
  $obj=new funcionesBD();
}else{
  echo '<script>
  alert("Tienes que loguearte");
  window.location= "index.php";
  </script>';
};
if($_SESSION['nivelAcceso'] == 3){
if (isset($_POST["guardar"])) {
		$obj->registroUsuario();
    // $notifyVerification = ["Credenciales de Acceso Establecida",'success'];
	}
$nivelAccesos = $obj->obtenerNivelAccesos();
$empleados = $obj->obtenerEmpleados();
$empleados2 = $obj->obtenerEmpleados();

?>
<?php include_once('layouts/header.php'); ?>
<h1 class="page-header">
    Acceso Empleados
</h1>
<div class="row">
    <div class="col-md-8">

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-briefcase" aria-hidden="true"></i> Empleados
            </li>
            <li class="active">
                <i class="fa fa-briefcase" aria-hidden="true"></i> Lista Empleados
            </li>
            <a href="insertarEmpleado.php" class="btn btn-primary btn-sm pull-right">+ Agregar Empleado</a>
        </ol>
    </div>
    <div class="col-md-4">
      <ul class="nav nav-tabs">
        <li role="presentation" ><a href="modificarEmpleados.php">Empleados</a></li>
        <li role="presentation"><a href="modificarCargos.php">Cargos</a></li>
        <li role="presentation"  class="active" ><a href="registrarUsuarios.php">usuario</a></li>
      </ul>
    </div>
</div>

<form action="" method="post">
  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h1 class="panel-title">Proporcione un Usuario y Contraseña para los empleados</h1>
        </div>
    <div class="panel-body">
      <div class="col-md-6">
        <label>Empleado</label>
        <select class="form-control" name="idEmpleado">
          <option value="" selected disabled>-Seleccione Empleado-</option>
          <?php while ($row = mysqli_fetch_assoc($empleados)) { ?>
            <option value="<?php echo $row['idEmpleado'] ?>" <?php   if($obj->passEstablecida($row['idEmpleado']) > 0 ) { echo "disabled";} ?> ><?php echo $row["nombreEmpleado"] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-6">
        <label>Nivel Acceso</label>
        <select class="form-control" name="idNivelAcceso">
          <?php while ($row3 = mysqli_fetch_assoc($nivelAccesos)) { ?>
            <option value="<?php echo $row3['idNivelAcceso'] ?>" title="<?php echo $row3['descripcion'] ?>"><?php echo $row3['nombreNivel'] ?></option>
          <?php } ?>
        </select>
      </div>
    </div>
    <div class="panel-body">
      <div class="col-md-6">
        <label>Usuario</label>
        <input type="text" name="nombre" class="form-control">
      </div>
      <div class="col-md-6">
        <label>Contraseña</label>
        <input type="password" name="pass" class="form-control">
      </div>
    </div>
    <div class="panel-footer">
      <button type="submit" class="btn btn-success btn-block" name="guardar">Establecer Credenciales</button>
    </div>
  </div>
  </div>

<div class="col-md-6">
  <div class="panel panel-yellow">
    <div class="panel-heading">
      <h1 class="panel-title">Lista de Accesos</h1>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th>Empleado</th>
          <th>Usuario y Contraseña</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($empleados2)) { ?>
          <tr>
            <td><?php echo $row['nombreEmpleado'] ?></td>
            <?php
                $aux = $obj->passEstablecida($row['idEmpleado']);
                if ($aux > 0) {
                  echo "<td class='success'><i class='fa fa-check' aria-hidden='true'></i> Establecida";
                }else {
                  echo "<td class='danger'><i class='fa fa-times' aria-hidden='true'></i> No Establecida";
                }

             ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
</div>
</form>


<script type="text/javascript">
</script>
   <?php
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }
}
else{
   echo '<script>
  alert("No Tienes acceso a esta pagina");
   window.location= "home.php";

  </script>';
}
?>
   <?php include_once('layouts/footer.php'); ?>
