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
if (isset($_POST['eliminarEncargadoConfirmado'])) {
  echo "<script>console.log('Orale, Ya funciona man: Registro Eliminado".$_POST['eliminarEncargadoConfirmado']."')</script>";
  $obj->eliminarEncargado($_POST['eliminarEncargadoConfirmado']);
  $notifyVerification=['<strong>Encargado</strong> Removido con Exito','danger'];

}

//Escucho si se quiere editar datos en Cursos, de ser asi lo editor
if (isset($_POST['editarEncargadoConfirmado'])) {

  $obj->editarEncargado($_POST['editarEncargadoConfirmado'],$_POST['nuevoNombreEncargado'],$_POST['nuevoApellidoEncargado'],$_POST['telefono'],$_POST['identidadEncargado'],$_POST['nuevoGeneroEncargado'],$_POST['direccionEncargado'],$_POST['profesion'],$_POST['correo']);

  $notifyVerification = ["Informacion Actualizada con Exito: <strong>".$_POST['nuevoNombreEncargado']." ".$_POST['nuevoApellidoEncargado']."</strong>",'info']; // Muestro notificacion de exito
}

$encargados = $obj->obtenerEncargados();
$totalEncargados = mysqli_num_rows($obj->obtenerEncargados());


?>
<?php include_once('layouts/header.php'); ?>

<h1 class="page-header">
    Padres de Familia
</h1>
  <div class="col-md-7">

      <ol class="breadcrumb">
          <li>
              <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
          </li>
          <li>
              <i class="fa fa-barcode" aria-hidden="true"></i> Estudiantes
          </li>
          <li class="active">
              <i class="fa fa-barcode" aria-hidden="true"></i> Padres de Familia
          </li>
          <a href="ck-insertarEncargado.php" class="btn btn-primary btn-xs pull-right">+ Agregar Padre de F.</a>
      </ol>
  </div>
  <div class="col-md-5">
    <ul class="nav nav-tabs">
      <li role="presentation"><a href="ck-listadoEstudiantes.php">Estudiantes</a></li>
      <li role="presentation" class="active"><a href="ck-modificarEncargados.php">Padres de Familia</a></li>
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
          <span>Lista de Padres de Famila / Encargados</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" >Nombre</th>
                    <th class="text-center" >Telefono</th>
                    <th class="text-center" >Identidad</th>
                    <th class="text-center">Acciones</th>

                </tr>
            </thead>
            <tbody>
              <?php
              if ($totalEncargados == 0) {
                echo "<script>console.log('chivas')</script>";
                echo "<tr><td colspan='4'>Nada Para Mostrar, dirijase a <a href='ck-insertarEncargado.php'>Ingresar Padre de Familia/Encargado</a></td><tr>";
              }

               while ($row = mysqli_fetch_assoc($encargados)){ ?>
                <tr>
                    <td class="text-center" ><?php echo $row['nombreEncargado']." ".$row['apellidoEncargado']; ?></td>
                    <td class="text-center" ><?php echo $row['telefono']; ?></td>
                    <td class="text-center" ><?php echo $row['identidad']; ?></td>
                    <td class="text-center">
                        <div class='btn-group btn-group-sm'>
                          <button name='eliminarEncargado' type="button" class='btn btn-danger' value="<?php echo $row['idEncargado']; ?>" title='Eliminar Encargado'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></button>
                          <button name='editarEncargado' type="button" value="<?php echo $row['idEncargado']; ?>" data-toggle='modal' data-target='#modalEditarEncargado' class='btn btn-warning' title='Editar Empleado' ><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></button>
                          <button name='verPerfil' type="button" value="<?php echo $row['idEncargado']; ?>" data-toggle='modal' data-target='#modalPerfilEncargado' class='btn btn-info' title='Ver Perfil' ><span class='glyphicon glyphicon-user' aria-hidden='true' ></span></button>
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
<div id="modalEditarEncargado" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modificar informacion del Padres de Familia</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
              <label for="">Nombre</label>
              <input type="text" name="nuevoNombreEncargado" id="nuevoNombreEncargado" class="form-control" value="">
          </div>
          <div class="col-md-3">
              <label for="">Apellidos</label>
              <input type="text" name="nuevoApellidoEncargado" id="nuevoApellidoEncargado" class="form-control" value="">
          </div>
          <div class="col-md-2">
              <label for="">Telefono</label>
              <input type="text" name="telefono" id="telefono" class="form-control" value="">
          </div>
          <div id="divIdentidad" class="col-md-2">
              <label class="control-label" for="inputError">Identidad</label>
                <input type="text" name="identidadEncargado" class="form-control" id="identidadEncargado" onblur="comprobarIdentidad()" required>
                <input type="hidden" name="" id="indentidadMatch" value="">
            </div>
          <div class="col-md-2">
              <label for="">Genero</label>
              <button type="button" class="btn btn-default btn-block" name="buttonGenero" id="buttonGenero" value=""></button>
              <input type="hidden" name="nuevoGeneroEncargado" value="">
              <small class="text-muted">Click para Cambiar</small>
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-4">
              <label for="">Direccion</label>
              <input type="text" class="form-control" name="direccionEncargado" id="direccionEncargado" value="">
          </div>

          <div class="col-md-4">
              <label for="">Profesion</label>
              <input type="text" class="form-control" name="profesion" id="profesion" value="">
          </div>
          <div class="col-md-4">
              <label for="">Correo</label>
              <input type="text" class="form-control" name="correo" id="correo" value="">
          </div>

        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" name="editarEncargadoConfirmado" id="editarEncargadoConfirmado" value="" class="btn btn-success">Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="modalPerfilEncargado" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

</form>

   <script type="text/javascript">
   function comprobarIdentidad() {
     $.ajax({
       method:"POST",
       url:"class/ck-scriptComprobarIdentidadEncargado.php",
       data:{identidad: $("#identidadEncargado").val()},
       success:function (respuesta) {
         console.log(respuesta);
         if (respuesta > 0) {
           $("#editarEncargadoConfirmado").attr("disabled","disabled");

           $("#divIdentidad").removeClass("has-success has-feedback");
           $("#iconoexito").remove()
           $("small[id='mensajeError']").remove()

           $("#divIdentidad").addClass("has-error has-feedback");
           $("#divIdentidad").append("<span id='iconoError' class='glyphicon glyphicon-remove form-control-feedback'></span>")
           if ($("#identidadEncargado").val() == "") {
             $("#divIdentidad").append("<small id='mensajeError' style='color:#ca0303'>Ingrese la Indentidad</small")
           }else {
             $("#divIdentidad").append("<small id='mensajeError' style='color:#ca0303'>Ya existe un registro con esa Identidad</small")
           }
         }else {
           $("#editarEncargadoConfirmado").removeAttr("disabled");
           $("#divIdentidad").removeClass("has-error has-feedback");
           $("#iconoError").remove()
           $("small[id='mensajeError']").remove()

           if ($("#identidadEncargado").val() == "") {
             $("#divIdentidad").append("<small id='mensajeError' style='color:#ca0303'>Ingrese la Identidad</small")
           }else {
             $("#iconoError").remove()
             $("#divIdentidad").addClass("has-success has-feedback");
             $("#divIdentidad").append("<span id='iconoExito' class='glyphicon glyphicon-ok form-control-feedback'></span>")
           }
         }
       }
     })
   }

   $("button[name='eliminarEncargado']").click(function (even) {
     var idEncargado = $(this).val();
     var botonPresionado = $(this);
      bootbox.confirm({
      title: "Confirmacion",
      message: "Desea eliminar este registro?, <strong>Advertencia:</strong> Los registros de los estudiantes que tuviere este Padre de Familia/Encargado seran eliminados (Notas,cuadros,datos Personales etc).",
      buttons: {
          cancel: {
              label: '<i class="fa fa-times"></i> Cancelar'
          },
          confirm: {
              label: '<i class="fa fa-check"></i> Eliminar',
              className: 'btn-danger'
          }
      },
      callback: function (result) {
          if (result == true) {
            botonPresionado.attr("type","submit");
            botonPresionado.attr("name","eliminarEncargadoConfirmado");

          $("button[name='eliminarEncargadoConfirmado']").click();
          }else {
            console.log("aca");
          }
      }
    });

   })


   $("button[name='editarEncargado']").on("click",function () {
     var idEncargadoBoton = $(this).val();

     $.ajax({
       method:'POST',
       data: {idEncargado: idEncargadoBoton},
       url:"class/ck-scriptObtenerEncargados.php",
       dataType:'json',
       success:function (respuesta) {
         console.log(respuesta);
         var encargado = respuesta
         $("#nuevoNombreEncargado").val(encargado.nombreEncargado);
         $("#nuevoApellidoEncargado").val(encargado.apellidoEncargado);
         $("#telefono").val(encargado.telefono)
         $("#identidadEncargado").val(encargado.identidad);
         $("#buttonGenero").val(encargado.genero);
         $("#buttonGenero").html(encargado.genero);
         $("input[name='nuevoGeneroEncargado").val(encargado.genero);
         $("#direccionEncargado").val(encargado.direccion)
         $("#profesion").val(encargado.profesion);
         $("#correo").val(encargado.correo);
         $("#editarEncargadoConfirmado").val(encargado.idEncargado);

         $("#indentidadMatch").val(encargado.identidad);

         // $("#nuevoNombreEmpleado").val("1")
       }
     })
   })
   $("#buttonGenero").on("click",function () {

     if ($(this).html() == "Femenino") {
       $(this).html("Masculino")
       $("input[name='nuevoGeneroEncargado").val("Masculino")
     }else {
       $(this).html("Femenino")
       $("input[name='nuevoGeneroEncargado").val("Femenino")
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
