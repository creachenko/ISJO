<?php
session_start();
include "class/funciones.php";
if (isset($_POST["enviarr"])) {
  $tra = new funcionesBD();
  $tra->verificar_questions($_POST['question1'],$_POST['question2'],$_POST['question3'],$_POST['idEmpleado']);
  }
$obj= new funcionesBD();


?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <h1 class="page-header">
      Reportes PDF
  </h1>



    </div>

</div>

<form action="#" method="post">
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Listado de Reportes en PDF</span>
       </strong>
      </div>
          <table class="table stacktable" id="tabla">
            <thead>
                <tr>
                    <th class="text-center" >Nombre</th>

                </tr>
            </thead>
            <tbody>
              <tr>
                <td>Cuadro de Calificaciones</td>
                <td class="text-center"> <a href="Reporte1.php" type="button " class="btn btn-primary" name="A">Ver</a </td>
                    </tr>
                <tr>
                <td> Cuadro</td>
                <td class="text-center"> <a href="cuadropdf.php" type="button " class="btn btn-primary" name="B">Ver</a </td>
                </tr>
                <tr>
                <td>Horario</td>
                <td class="text-center"> <a href="Horariopdf.php" type="button " class="btn btn-primary" name="C">Ver</a </td>
                </tr>
                <tr>
                  <td>Diario Pedagogo</td>
                  <td class="text-center"> <a href="HorarioMaestro.php" type="button " class="btn btn-primary" name="D">Ver</a </td>
                      </tr>
                  <tr>
                  <td>Informe Mensual de Educacion</td>
                  <td class="text-center"> <a href="informeestadistico.php" type="button " class="btn btn-primary" name="E">Ver</a </td>
                  </tr>
                  <tr>
                  <td>Hoja de Asistencia</td>
                  <td class="text-center"> <a href="asistenciapadre.php" type="button " class="btn btn-primary" name="F">Ver</a </td>
                  </tr>
                  <td>Plan Operativo Anual</td>
                  <td class="text-center"> <a href="PlanOPAnual.php" type="button " class="btn btn-primary" name="D">Ver</a </td>
                      </tr>
                  <tr>
                  <td>Certificado de Estudio</td>
                  <td class="text-center"> <a href="Cartificacionestudio.php" type="button " class="btn btn-primary" name="E">Ver</a </td>
                  </tr>
                  <tr>
                  <td>Constancia de Conducta</td>
                  <td class="text-center"> <a href="constanciacond.php" type="button " class="btn btn-primary" name="F">Ver</a </td>
                  </tr>
                  <td>Boleta de Inscripcion de Matricula</td>
                  <td class="text-center"> <a href="inscripcion.php" type="button " class="btn btn-primary" name="D">Ver</a </td>
                      </tr>
                  <tr>
                  <td>Informacion de Docentes</td>
                  <td class="text-center"> <a href="informedocente.php" type="button " class="btn btn-primary" name="E">Ver</a </td>
                  </tr>
                  <tr>
                  <td>Constancia de Matricula</td>
                  <td class="text-center"> <a href="Consmatricula.php" type="button " class="btn btn-primary" name="F">Ver</a </td>
                  </tr>

            </tbody>
          </table>
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
