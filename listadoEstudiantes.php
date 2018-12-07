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

  echo "<script>console.log('Apretado')</script>";

  $obj->insertarEncargado($_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['genero'],$_POST['identidadEncargado'],$_POST['correo'],$_POST['profesion'],$_POST['direccion']);
  $notifyVerification=["Registro Exitoso: ".$_POST['nombre'].$_POST['apellido'],'success'];
}

$estudiantes = $obj->obtenerEstudiantes();

?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
  <h1 class="page-header">
      Listado Estudiantes
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
                <i class="fa fa-barcode" aria-hidden="true"></i> Listado Estudiantes
            </li>

            <a href="iniciarMatricula.php" class="btn btn-primary btn-xs pull-right">Matricular Alumno</a>

        </ol>
    </div>
    <div class="col-md-5">
      <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a href="#">Estudiantes</a></li>
        <li role="presentation"><a href="modificarEncargados.php">Padres de Familia</a></li>
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
          <span>Listado Estudiantes Matriculados</span>
       </strong>
      </div>
          <table class="table" id="">
            <thead>
                <tr>
                    <th class="text-center" >Nombre</th>
                    <th class="text-center" >Identidad</th>
                    <th class="text-center" >Curso</th>
                    <th class="text-center" >Seccion</th>
                    <th class="text-center">Perfil</th>
                </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($estudiantes)){ ?>
                <tr>
                  <td><?php echo $row['nombreEstudiante']." ".$row['apellidoEstudiante']; ?></td>
                  <td><?php echo $row['identidad'] ?></td>
                  <td><?php echo $row['nombreCurso'] ?></td>
                  <td><?php echo $row['seccion'] ?></td>
                  <td> <button type="button" class="btn btn-primary" name="button">Ver Perfil</button> </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
    </div>
  </div>
</div>




</form>

   <script type="text/javascript">
   function comprobarIdentidad() {
     $.ajax({
       method:"POST",
       url:"class/scriptComprobarIdentidadEncargado.php",
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
       url:"class/scriptObtenerEncargados.php",
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
