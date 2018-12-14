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

//Escucho si se quiere editar datos en Cursos, de ser asi lo editor
if (isset($_POST['guardarNuevoEmpleado'])) {
  $idCargo = $_POST['idCargoEmpleado'];
  $genero = $_POST['nuevoGeneroEmpleado'];
  $resEditar = $obj->editarEmpleado($_POST['guardarNuevoEmpleado'],$_POST['nuevoNombreEmpleado'],$_POST['nuevoApellidoEmpleado'],$_POST['nuevoIdentidad'],$_POST['nuevoCorreo'],$_POST['nuevoNacimiento'],$genero,$_POST['nuevoImprema'],$idCargo,$_POST['nuevoDireccion'],$_POST['nuevoFechaInicioLabores'],$_POST['nuevoCelular'],$_POST['nuevoTituloMedia'],$_POST['nuevoTituloUni']);


  $notifyVerification = ["Informacion Actualizada con Exito: <strong>".$_POST['nuevoNombreEmpleado']."</strong>",'info']; // Muestro notificacion de exito
}

$empleados = $obj->get_perfil();
?>
<?php include_once('layouts/header.php'); ?>
<h1 class="page-header">
    Perfil del Empleado
</h1>
<div class="row">
    <div class="col-md-8">

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-briefcase" aria-hidden="true"></i> Perfil
            </li>
            <li class="active">
                <i class="fa fa-briefcase" aria-hidden="true"></i> Editar Perfil
            </li>

                        </ol>
    </div>
      <div class="col-md-4">
      <ul class="nav nav-tabs">
        <li role="presentation"  class="active" ><a href="perfil.php">Perfil Empleados</a></li>
        <li role="presentation"><a href="editarMiUsuario.php">Usuario del Empleado</a></li>
      </ul>
    </div>
</div>

<form action="#" method="post">
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Empleado</span>
       </strong>
      </div>
        <div class="panel-body">
       <ul class="nav nav-pills nav-stacked">
           <?php while ($row = mysqli_fetch_assoc($empleados)){ ?>
            <li role="presentation"><a href="#"> <strong>Nombre:</strong>
            <text class="pull-right"> <i><?php echo $row['nombreEmpleado']; ?></i> </text></a></li>
            <li role="presentation"><a href="#"><strong>Apellido:</strong>
            <text class="pull-right" ><i><?php echo $row['apellidoEmpleado']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Cargo</strong>
            <text class="pull-right" ><i><?php echo $row['nombreCargo']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Correo</strong>
            <text class="pull-right" ><i><?php echo $row['correo']; ?></i></text></a></li>
             <li role="presentation"><a href="#"><strong>Identidad</strong>
            <text class="pull-right" ><i><?php echo $row['identidad']; ?></i></text></a></li>
             <li role="presentation"><a href="#"><strong>Fecha de Nacimiento</strong>
            <text class="pull-right" ><i><?php echo $row['fechaNacimiento']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>IMPREMA</strong>
            <text class="pull-right" ><i><?php echo $row['imprema']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Direccion</strong>
            <text class="pull-right" ><i><?php echo $row['direccion']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Fecha que Inicio a Laborar</strong>
            <text class="pull-right" ><i><?php echo $row['fechaIniLabor']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Celular</strong>
            <text class="pull-right" ><i><?php echo $row['celular']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Titulo Media</strong>
            <text class="pull-right" ><i><?php echo $row['tituloMedia']; ?></i></text></a></li>
            <li role="presentation"><a href="#"><strong>Titulo Universitario</strong>
            <text class="pull-right" ><i><?php echo $row['tituloUniversitario']; ?></i></text></a></li>
           </ul>
          <?php }; ?>
       </div>
    </div>
  </div>
</div>



   <?php include_once('layouts/footer.php'); ?>
