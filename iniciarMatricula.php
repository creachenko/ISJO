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
if (isset($_POST['guardar'])){
  $obj->insertarEncargado($_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['genero'],$_POST['identidadNewEncargado'],$_POST['correo'],$_POST['profesion'],$_POST['direccion']);
  $notifyVerification=["Padre de Familia/ Encargado: ".$_POST['nombre'].$_POST['apellido']." ha sido registrado, proceda a llenar datos del alumno",'success'];
}

if (isset($_POST["matricularAlumno"])) {

    $nombreEstudiante = ucwords(strtolower($_POST["nombreEstudiante"]));
    $apellidoEstudiante = ucwords(strtolower($_POST["apellidoEstudiante"]));

    $obj->matricularAlumno($nombreEstudiante,$apellidoEstudiante,$_POST["identidadEstudiante"],$_POST["correoEstudiante"],$_POST["nacimientoEstudiante"],$_POST["generoEstudiante"],$_POST["direccionEstudiante"],$_POST["hiddenIdEncargado"],$_POST["hiddenParentescoEncargado"],$_POST["telefonoEstudiante"],$_POST["selectCurso"]);

    $notifyVerification = ["<strong>".$nombreEstudiante." ".$apellidoEstudiante."</strong> Matriculado Exitosamente",'success'];
}

$modalidades = $obj->obtenerModalidades();

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Matricular Alumno
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-briefcase" aria-hidden="true"></i> Estudiante
            </li>
            <li class="active">
                <i class="fa fa-briefcase" aria-hidden="true"></i> Matricular Alumno
            </li>
        </ol>
    </div>
</div>

<form action="#" method="post">
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-red">
      <div class="panel-heading">
        <h1 class="panel-title">Datos del Estudiante</h1>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <label for="">Nombre</label>
            <input type="text" class="form-control" name="nombreEstudiante" id="nombreEstudiante" onkeyup="nombreEstudianteCorfirmar()" value="">
          </div>
          <div class="col-md-6">
            <label for="">Apellidos</label>
            <input type="text" class="form-control" name="apellidoEstudiante" id="apellidoEstudiante" onkeyup="nombreEstudianteCorfirmar()" value="">
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-md-3" id="divIdentidadEstudiante">
            <label for="">Identidad</label>
            <div class="form-group">
              <input type="number" class="form-control" name="identidadEstudiante" id="identidadEstudiante" value="">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary" id="buttonVerficarIdentidadEncargado" name="buttonVerficarIdentidadEncargado">Verificar</button>
            </span>
            </div>
          </div>
          <div class="col-md-3">
            <label>Genero</label>
            <select class="form-control" name="generoEstudiante" id="generoEstudiante" onchange="generoEstudianteCorfirmar()">
              <option>Masculino</option>
              <option>Femenino</option>
            </select>
          </div>
          <div class="col-md-3">
            <label>Nacimiento</label>
            <input type="date" class="form-control" name="nacimientoEstudiante" id="nacimientoEstudiante" value="">
          </div>
          <div class="col-md-3">
            <label>Direccion</label>
            <input type="text" class="form-control" name="direccionEstudiante" id="direccionEstudiante" value="">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="">Telefono</label>
            <input type="number" class="form-control" name="telefonoEstudiante" id="telefonoEstudiante" value="" placeholder="(Opcional)">
          </div>
          <div class="col-md-6">
            <label>Correo</label>
            <input type="text" class="form-control" name="correoEstudiante" id="correoEstudiante" value="" placeholder="(Opcional)">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="panel panel-yellow">
      <div class="panel-heading">
        <h1 class="panel-title">Datos del Encargado: Ingrese el numero de Identidad</h1>
      </div>
      <div class="panel-body">
        <div class="col-md-12" id="divIdentidadEncargado">
          <label for="">Indentidad Encargado</label>
          <div class="input-group">
            <input type="number" id="identidadEncargado" class="form-control" name="identidad" value="" placeholder="Identidad Aqui">
            <span class="input-group-btn">
              <button type="button" class="btn btn-primary" id="buttonVerficarIdentidadEncargado" name="buttonVerficarIdentidadEncargado">Verificar</button>
            </span>
          </div>
        </div>
        <div class="" id="divParentescoEncargado">
          <input type="hidden" id="hiddenIdEncargado" name="hiddenIdEncargado" value="">
          <input type="hidden" id="hiddenParentescoEncargado" name="hiddenParentescoEncargado" value="">
        </div>
      </div>
    </div>
  </div>

    <div class="col-md-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h1 class="panel-title">Asignar a Curso</h1>
        </div>
        <div class="panel-body">
          <div class="col-md-6">

              <label>Modalidad</label>
              <button type="button" id="dropdownModalidades" class="btn btn-default dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Modalidad <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <?php while ($aux = mysqli_fetch_assoc($modalidades)) { ?>
                  <li> <button type="button" id="butttonDropdownModalidades" class="btn btn-default" value="<?php echo $aux['idModalidad']; ?>"><?php echo $aux['nombreModalidad'] ?></button> </li>
                <?php } ?>
              </ul>

          </div>
          <div class="col-md-6">
            <label for="">Curso y Seccion</label>
            <select class="form-control" name="selectCurso" id="selectCurso" onchange="cursoCorfirmar()" disabled>

            </select>
          </div>

        </div>
      </div>
    </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="panel panel-green">
      <div class="panel-heading">
        <h1 class="panel-title">Resumen Matricula</h1>
      </div>
      <div class="panel-body">
        <div class="col-md-4">
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#">Datos Personales</a></li>
            <li role="presentation"><a href="#"> <strong>Nombre:</strong> <text class="pull-right" id="nombreEstudianteResumen"> <i>(Informacion no Ingresada)</i> </text> </a></li>
            <li role="presentation"><a href="#"><strong>Identidad:</strong> <text class="pull-right" id="identidadEstudianteResumen">(Informacion no Ingresada))</text></a></li>
            <li role="presentation"><a href="#"><strong>Edad:</strong> <text class="pull-right" id="edadEstudiante"> <i>(Informacion no Ingresada)</i></text></a></li>
            <li role="presentation"><a href="#"><strong>Genero:</strong> <text class="pull-right" id="generoEstudianteResumen"> <i>Masculino</i> </text></a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#">Datos del Encargado</a></li>
            <li role="presentation"><a href="#"> <strong>Nombre:</strong> <text class="pull-right" id="nombreEncargadoResumen"> <i>(Informacion no ingresada)</i> </text></a></li>
            <li role="presentation"><a href="#"><strong>Identidad:</strong> <text class="pull-right" id="identidadEncargadoResumen"><i>(Informacion no ingresada)</i></text></a></li>
            <li role="presentation"><a href="#"><strong>Parentesco</strong> <text class="pull-right" id="parentescoEncargadoResumen">(Informacion no ingresada)</text></a></li>
            <li role="presentation"><a href="#"><strong>Perfil</strong> <text class="pull-right"> <button type="button" name="button" class="btn btn-info btn-sm">Ver Perfil</button> </text></a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <ul class="nav nav-pills nav-stacked">
            <li role="presentation" class="active"><a href="#">Matricula</a></li>
            <li role="presentation"><a href="#"><strong>Modalidad:</strong> <text class="pull-right" id="modalidadResumen">(informacion no ingresada)</text></a></li>
            <li role="presentation"><a href="#"> <strong>Curso y Seccion</strong> <text class="pull-right" id="cursoResumen">(informacion no ingresada)</text></a></li>

          </ul>
        </div>

        <hr>
      </div>
      <div class="panel-footer">
        <input type="submit" name="matricularAlumno" value="Matricular Alumno" class="btn btn-success btn-block btn-lg">
      </div>
    </div>
  </div>
</div>


</form>
<!-- Modal -->
<div id="modalAgregarEncargado" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresar Padre de Familia</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Ingrese los datos Personales del padre de familia o encargado </span>
             </strong>
            </div>
            <div class="panel-body">
              <form method="post" action="">
                <div class="row">
                  <div class="col-md-3">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombres del Encargado" required>
                  </div>
                  <div class="col-md-3">
                    <label for="">Apellidos</label>
                      <input type="text" class="form-control" name="apellido" placeholder="Ingrese Apellidos del Encargado" required>
                  </div>
                  <div class="col-md-2">
                    <label for="">Celular</label>
                      <input type="numeric" class="form-control" name="telefono" placeholder="Telefono del Encargado" required>
                  </div>
                  <div class="col-md-2">
                    <label for="status">Genero</label>
                    <select class="form-control" name="genero">
                      <option>Masculino</option>
                      <option>Femenino</option>
                    </select>
                  </div>

                    <div id="divIdentidad" class="col-md-2">
                        <label class="control-label" for="inputError">Identidad</label>
                          <input type="text" name="identidadNewEncargado" class="form-control" id="identidadNewEncargado" onblur="comprobarIdentidad()" required>
                      </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-2">
                    <label for="">Correo</label>
                    <input type="text" class="form-control" name="correo" placeholder="(Opcional)">
                  </div>

                  <div class="col-md-2">
                    <label for="">Profesio/Oficio</label>
                    <input type="text" class="form-control" name="profesion" placeholder="Profesion u Oficio" required>
                  </div>
                  <div class="col-md-2">
                    <label for="status">Direccion</label>
                    <input type="text" class="form-control" name="direccion" placeholder="Direccion de Encargado" required>
                  </div>
                  <div class="col-md-4">
                    <hr>
                    <div class="col-md-6">
                      <button type="reset" class="btn btn-warning btn-block">Limpiar Campos</button>
                    </div>
                    <div class="col-md-6">
                      <button type="submit" id="guardar" name="guardar" class="btn btn-success btn-block">Enviar</button>
                    </div>

                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">

                  </div>
                </div>
            </form>
          </div>
          <div class="panel-footer">

          </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="vaciarIdentidadEncargado()">Close</button>
      </div>
    </div>

  </div>
</div>

   <script type="text/javascript">
   //Confirmar Cursos segun modalidad
   $("button[id='butttonDropdownModalidades']").on("click",function (ev) {
     $("#dropdownModalidades").html($(this).html());
     var idModalidad1 = $(this).val();
     $("#modalidadResumen").html($(this).html());
      $.ajax({
        method:"POST",
        url:"class/scriptObtenerCursosAnioLectivo.php",
        data:{idModalidad: idModalidad1},
        dataType: "json",
        success:function (respuesta) {
          $("#selectCurso").removeAttr("disabled");
          $("#selectCurso").empty();
          $.each(respuesta,function (key,value) {
            $("#selectCurso").append("<option value="+value.idCurso+">"+value.nombreCurso+" - "+value.seccion+"</option>")
            console.log(key + " "+ value.nombreCurso)
          })
          //Muestro el primer curso seleccionado en la ficha de resumen
          var optionSelected = $("#selectCurso");
          $("#cursoResumen").html($('option:selected', optionSelected).html());

        },
        error:function (error,error1,error2) {
          console.log("Hubo un error");
        }
      })

   })

   //Compiar Nombre en la ficha de resumen
   function nombreEstudianteCorfirmar() {
    $("#nombreEstudianteResumen").html($("#nombreEstudiante").val() +" "+ $("#apellidoEstudiante").val());
   }
   //copiar curso y seccion en la ficha resumen
   function cursoCorfirmar() {
     var optionSelected = $("#selectCurso");
     $("#cursoResumen").html($('option:selected', optionSelected).html());
   }
   //Comprobar si no existe otra Identidad Igual
   $("#identidadEstudiante").on("blur",function () {
     var identidad = $(this).val()
     $.ajax({
       method:"post",
       data: {identidadEstudiante:identidad},
       url:"class/scriptComprobarIdentidadEstudiante.php",
       success:function (respuesta) {
         if (respuesta > 0) {
           $("#divIdentidadEstudiante").removeClass("has-success has-feedback");
           $("#iconoExitoIdentidadEstudiate").remove()

           $("#divIdentidadEstudiante").addClass("has-error has-feedback");
           $("#divIdentidadEstudiante").append("<small id='mensajeErrorIdentidadEstudiante' style='color:#ca0303'>Ingrese la Identidad</small")
           window.alert("Ya existe un alumno con ese Numero de Identidad, revise nuevamente")
         }else {
           $("#divIdentidadEstudiante").removeClass("has-error has-feedback");
           $("#mensajeErrorIdentidadEstudiante").remove()


           $("#divIdentidadEstudiante").addClass("has-success has-feedback");
           $("#divIdentidadEstudiante").append("<span id='iconoExitoIdentidadEstudiate' class='glyphicon glyphicon-ok form-control-feedback'></span>")
           $("#identidadEstudianteResumen").html(identidad)
         }
       }
     })
   })
   //Comprueba los datos del encargado
   $("#buttonVerficarIdentidadEncargado").on("click",function () {

     var identidadEncargado = $("#identidadEncargado").val();

     $.ajax({
       method:'POST',
       data: {identidad: identidadEncargado},
       url:"class/scriptObtenerInformacionEncargadoConIdentidad.php",
       dataType:'json',
       success:function (respuesta) {

         console.log(respuesta);

         if (respuesta == null) {
           var modal = bootbox.confirm({
                 message: "Espere",
                 buttons: {
                     confirm: {
                         label: '<i>Espere</i>',
                         className: 'btn-default'
                     },
                     cancel: {
                         label: "Cancelar",
                         className: 'btn-danger'
                     }
                 },
                 callback: function (result) {

                    if (result == true) {
                      $("#modalAgregarEncargado").modal("show");
                    }else {
                      vaciarIdentidadEncargado();
                    }
                     console.log('This was logged in the callback: ' + result);
                 }
              });
            modal.init(function () {
              setTimeout(function () {
                modal.find('.bootbox-body').html("Padre de Familia no encontrado, proceda a <strong>Registrar Padre de Familia</strong>");
                var botonExito = modal.find('.btn-default').removeClass('btn-default').addClass('btn-success').html("Registrar Padre de Familia");
              },2000)
            });
            $("#hiddenIdEncargado").val(0);
         }else {
           var promtParentesco = bootbox.prompt({
             title: "Registro Encontrado: "+respuesta.nombreEncargado+" "+respuesta.apellidoEncargado,
             inputType: 'text',
             closeButton: false,
             callback: function (result) {
               console.log(result);
                 if (result != null) {
                   $("#hiddenParentescoEncargado").val(result);
                   $("#parentescoEncargadoResumen").html(result);
                   $("#hiddenIdEncargado").val(respuesta.idEncargado);
                   $("#nombreEncargadoResumen").html(respuesta.nombreEncargado+' '+respuesta.apellidoEncargado);
                   $("#identidadEncargadoResumen").html(respuesta.identidad);

                 }else {
                   $("#hiddenParentescoEncargado").val(0);
                   $("#identidadEncargado").val("")
                 }
             }
         });
         promtParentesco.init(function () {
           promtParentesco.find('.bootbox-body').append('Ingrese el Parentesco del encargado con el Estudiante');
         })
         }
       }
     })
   })
   //Copio el genero en la ficha de resumen
   function generoEstudianteCorfirmar() {
    $("#generoEstudianteResumen").html($("#generoEstudiante").val());
   }
   //Calculo la edad del Estudiantes
   $("#nacimientoEstudiante").on("blur",function () {
     $.ajax({
       url:"class/calcularEdad.php",
       method:"post",
       data:{nacimiento:$(this).val()},
       success: function (respuesta) {
        $("#edadEstudiante").html(respuesta+" Años");
       }
     })
   })
   //Comprobar identidad del encargado si no existe un registro de el
   function comprobarIdentidad() {
     $.ajax({
       method:"POST",
       url:"class/scriptComprobarIdentidadEncargado.php",
       data:{identidad: $("#identidadNewEncargado").val()},
       success:function (respuesta) {
         console.log(respuesta);
         if (respuesta > 0) {
           $("#guardar").attr("disabled","disabled");

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
           $("#guardar").removeAttr("disabled");
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

   //vaciar campo de identidad encargados
   function vaciarIdentidadEncargado() {
     $("#identidadEncargado").val("");
   }
   </script>
   <?php
  //Recibo cualquier notificacion y la muestro
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }?>
   <?php include_once('layouts/footer.php'); ?>
