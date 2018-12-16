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
$cargos = $obj->obtenerCargos();
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
            </li>    <?php while ($row = mysqli_fetch_assoc($empleados)){ ?>
            <button name='editarEmpleado' type="button" value="<?php echo $row['idEmpleado']; ?>" data-toggle='modal' data-target='#modalEditarEmpleado' class="btn btn-primary btn-sm pull-right" title='Editar Empleado' >
            <span class='glyphicon glyphicon-pencil' aria-hidden='true' >Editar</span></button>
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
<!-- Modal -->
<div id="modalEditarEmpleado" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Editar informacion del Empleado</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      <div class="col-md-3">
          <label for="">Nombre</label>
          <input type="text" name="nuevoNombreEmpleado" id="nuevoNombreEmpleado" class="form-control" value="">
      </div>
      <div class="col-md-3">
          <label for="">Apellidos</label>
          <input type="text" name="nuevoApellidoEmpleado" id="nuevoApellidoEmpleado" class="form-control" value="">
      </div>
      <div class="col-md-2">
          <label for="">Identidad</label>
          <input type="text" name="nuevoIdentidad" id="nuevoIdentidad" class="form-control" value="">
      </div>
      <div class="col-md-2">
          <label for="">Correo</label>
          <input type="text" name="nuevoCorreo" id="nuevoCorreo" class="form-control" value="">
      </div>
      <div class="col-md-2">
          <label for="">Nacimiento</label>
          <input type="date" name="nuevoNacimiento" id="nuevoNacimiento" class="form-control" value="">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-2">
          <label for="">Genero</label>
          <button type="button" class="btn btn-default btn-block" name="buttonGenero" id="buttonGenero" value=""></button>
          <input type="hidden" name="nuevoGeneroEmpleado" value="">
          <small class="text-muted">Click para Cambiar</small>
      </div>
      <div class="col-md-2">
          <label for="">Imprema</label>
          <input type="text" class="form-control" name="nuevoImprema" id="nuevoImprema" value="">
      </div>
      <div class="col-md-2" id="divCargo">
          <label for="">Cargo</label>
          <div class="dropdown">
            <button class="btn btn-default dropdown-toggle btn-block" name="idCargo" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" value="" >
              <input type="hidden" name="idCargoEmpleado" value="">
              <small id="buttonCargo"></small>
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
              <?php while ($row1 = mysqli_fetch_assoc($cargos)) { ?>
                <li> <button type="button" class="btn btn-default btn-block" id="dropdownCargo" name="cargo<?php echo $row1['idCargo'] ?>" disabled="" value="<?php echo $row1['idCargo'] ?>"><?php echo $row1['nombreCargo'] ?></button> </li>
              <?php } ?>
            </ul>
          </div>
      </div>
      <div class="col-md-2">
          <label for="">Inicio Labores</label>
          <input type="date" class="form-control" name="nuevoFechaInicioLabores" id="nuevoFechaInicioLabores" value="">
      </div>
      <div class="col-md-2">
          <label for="">Celular</label>
          <input type="text" class="form-control" name="nuevoCelular" id="nuevoCelular" value="">
      </div>
      <div class="col-md-2">
          <label for="">Direccion</label>
          <input type="text" class="form-control" name="nuevoDireccion" id="nuevoDireccion" value="">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-md-6">
        <label for="">Titulo Nivel Media</label>
        <input type="text" class="form-control" name="nuevoTituloMedia"  id="nuevoTituloMedia" value="">
      </div>
      <div class="col-md-6">
        <label for="">Titulo Nivel Universitario</label>
        <input type="text" class="form-control" name="nuevoTituloUni" id="nuevoTituloUni" value="">
      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="submit" name="guardarNuevoEmpleado" class="btn btn-success" id="idEmpleado" value="">Aceptar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
  </div>
</div>

</div>
</div>
</form>
<script type="text/javascript">
   $("button[name='editarEmpleado']").on("click",function () {
     $.ajax({
       method:'POST',
       data: {idEmpleado: $(this).val()},
       url:"class/ck-scriptObtenerEmpleados.php",
       dataType:'json',
       success:function (respuesta) {
         // console.log(respuesta);
         var empleado = respuesta
         $("#nuevoNombreEmpleado").val(empleado.nombreEmpleado);
         $("#nuevoApellidoEmpleado").val(empleado.apellidoEmpleado);
         $("#nuevoIdentidad").val(empleado.identidad);
         $("#nuevoCorreo").val(empleado.correo);
         $("#nuevoNacimiento").val(empleado.fechaNacimiento);

         $("#buttonGenero").html(empleado.genero);
         $("input[name='nuevoGeneroEmpleado").val(empleado.genero);
         $("#buttonCargo").html(empleado.nombreCargo);
         $("input[name='idCargoEmpleado']").val(empleado.empleadoIdCargo);
         $("#nuevoImprema").val(empleado.imprema);
         $("#nuevoFechaInicioLabores").val(empleado.fechaIniLabor)
         $("#nuevoCelular").val(empleado.celular)
         $("#nuevoTituloMedia").val(empleado.tituloMedia)
         $("#nuevoTituloUni").val(empleado.tituloUniversitario)
         $("#idEmpleado").val(empleado.idEmpleado)
         $("#nuevoDireccion").val(empleado.direccion)
         // $("#nuevoNombreEmpleado").val("1")
       }
     })
   })

   $("#buttonGenero").on("click",function () {

     if ($(this).html() == "Femenino") {
       $(this).html("Masculino")
       $("input[name='nuevoGeneroEmpleado").val("Masculino")
     }else {
       $(this).html("Femenino")
       $("input[name='nuevoGeneroEmpleado").val("Femenino")
     }
   })

   $("button[id='dropdownCargo']").on("click",function () {
     $("input[name='idCargoEmpleado']").val($(this).val());
     $("#buttonCargo").html($(this).html());
   })
   </script>
   <?php
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }?>
   <?php include_once('layouts/footer.php'); ?>
