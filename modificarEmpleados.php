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
//Escucho si se quiere eliminar una modalidad, de ser asi la Eliminado
if (isset($_POST['eliminarEmpleadoConfirmado'])) {
  echo "<script>console.log('".$_POST['eliminarEmpleadoConfirmado']."')</script>";
  $obj->eliminarEmpleado($_POST['eliminarEmpleadoConfirmado']);
  $notifyVerification=['Empleado Removido con Exito','danger'];

}

//Escucho si se quiere editar datos en Cursos, de ser asi lo editor
if (isset($_POST['guardarNuevoEmpleado'])) {
  $idCargo = $_POST['idCargoEmpleado'];
  $genero = $_POST['nuevoGeneroEmpleado'];
  $resEditar = $obj->editarEmpleado($_POST['guardarNuevoEmpleado'],$_POST['nuevoNombreEmpleado'],$_POST['nuevoApellidoEmpleado'],$_POST['nuevoIdentidad'],$_POST['nuevoCorreo'],$_POST['nuevoNacimiento'],$genero,$_POST['nuevoImprema'],$idCargo,$_POST['nuevoDireccion'],$_POST['nuevoFechaInicioLabores'],$_POST['nuevoCelular'],$_POST['nuevoTituloMedia'],$_POST['nuevoTituloUni']);


  $notifyVerification = ["Informacion Actualizada con Exito: <strong>".$_POST['nuevoNombreEmpleado']."</strong>",'info']; // Muestro notificacion de exito
}

$empleados = $obj->obtenerEmpleados();
$totalEmpleados = mysqli_num_rows($obj->obtenerEmpleados());
$cargos = $obj->obtenerCargos();


?>
<?php include_once('layouts/header.php'); ?>
<h1 class="page-header">
    Modificar Empleados
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
        <li role="presentation"  class="active" ><a href="modificarEmpleados.php">Empleados</a></li>
        <li role="presentation"><a href="modificarCargos.php">Cargos</a></li>
        <li role="presentation"><a href="registrarUsuarios.php">Usuarios</a></li>
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
          <span>Lista de Empleados</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" >Nombre</th>
                    <th class="text-center" >Apellidos</th>
                    <th class="text-center" >Cargo</th>
                    <th class="text-center">Acciones</th>

                </tr>
            </thead>
            <tbody>
              <?php
              if ($totalEmpleados == 0) {
                echo "<script>console.log('chivas')</script>";
                echo "<tr><td colspan='4'>Nada Para Mostrar, dirijase a <a href='insertarEmpleado.php'>Ingresar Empleados</a></td><tr>";
              }

               while ($row = mysqli_fetch_assoc($empleados)){ ?>
                <tr>
                    <td class="text-center" ><?php echo $row['nombreEmpleado']; ?></td>
                    <td class="text-center" ><?php echo $row['apellidoEmpleado']; ?></td>
                    <td class="text-center" ><?php echo $row['nombreCargo']; ?></td>
                    <td class="text-center">
                        <div class='btn-group btn-group-sm'>
                          <button name='eliminarEmpleado' class='btn btn-danger' value="<?php echo $row['idEmpleado']; ?>" title='Eliminar Empleado'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></button>
                          <button name='editarEmpleado' type="button" value="<?php echo $row['idEmpleado']; ?>" data-toggle='modal' data-target='#modalEditarEmpleado' class='btn btn-warning' title='Editar Empleado' ><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></button>
                        </div>
                    </td>
                </tr>
              <?php }; ?>
            </tbody>
          </table>
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
                <li> <button type="button" class="btn btn-default btn-block" id="dropdownCargo" name="cargo<?php echo $row1['idCargo'] ?>" value="<?php echo $row1['idCargo'] ?>"><?php echo $row1['nombreCargo'] ?></button> </li>
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
   var vecesApretadoConfirmarEliminarEmpleado = 0;
   $("button[name='eliminarEmpleado']").click(function (even) {

     if (vecesApretadoConfirmarEliminarEmpleado == 0) {
       even.preventDefault();
       console.log('apretaste '+ $(this).val());
       $(this).html('Eliminar?');
       $(this).attr('name','eliminarEmpleadoConfirmado')
       $(this).attr('type','submit')
       vecesApretadoConfirmarEliminarEmpleado = vecesApretadoConfirmarEliminarEmpleado + 1;
     }else {
       console.log('Eliminar confirmado');
     }

   })

   $("button[name='eliminarEmpleado']").on("blur",function (even) {

       even.preventDefault();
       console.log('perdida de foco '+ $(this).val());
       $(this).html("<span class='glyphicon glyphicon-remove' aria-hidden='true' ></span>");
       $(this).attr('name','eliminarEmpleado')
       $(this).attr('type','button')
       vecesApretadoConfirmarEliminarEmpleado = vecesApretadoConfirmarEliminarEmpleado - 1;

   })
   $("button[name='editarEmpleado']").on("click",function () {
     $.ajax({
       method:'POST',
       data: {idEmpleado: $(this).val()},
       url:"class/scriptObtenerEmpleados.php",
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
