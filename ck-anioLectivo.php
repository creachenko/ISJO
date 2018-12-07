<?php
session_start();
include 'class/funciones.php';
$obj=new funcionesBD();
if (isset($_SESSION["ses_id"])) {
}else{
  echo '<script>
  alert("Tienes que loguearte");
  window.location= "index.php";
  </script>';
};

if (isset($_POST['parciales'])) {
  echo "<script>console.log('".$_POST['parciales']."')</script>";
}

$parciales = $obj->obtenerParcialesActuales();


?>

1 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
2 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
3 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
4 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
          Año Actual
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

<div class="jumbotron">
  <h1 class="display-4">
    <small>Año Actual</small>

<?php $dia = date("Y");
    echo $dia;?>

</h1>
  <p class="lead">Este es el año actual en el cual se registraran datos con la fecha de este año.</p>
</div>
<h1 class="page-header">
  Establecer Parciales <small class="text-muted">Indique el parcial Actual para cada Modalidad, cuando termine un parcial, cambie al siguiente</small>
</h1>
<form action="" method="post">

<?php while ($row = mysqli_fetch_assoc($parciales)) { ?>
  <div class="col-md-4">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h1 class="panel-title"><?php echo $row["nombreModalidad"] ?></h1>
      </div>
      <div class="panel-body" >
        <label>Parcial Actual:</label>
        <input type="text" disabled name="" class="form-control" value="<?php echo $row['nombreParcialPorModalidad'] ?>">
        <hr>
        <label>Cambiar Parcial</label>
        <select class="form-control" name="parciales">
          <option value="" selected disabled>-seleccione parcial-</option>
          <?php
          $parcialesDeModalidad = $obj->obtenerParcialesDeModalidades($row['idModalidad']);

          while ($row2 = mysqli_fetch_assoc($parcialesDeModalidad)) { ?>
            <option value="<?php echo $row2['idParcialPorModalidad'] ?>"><?php echo $row2['nombreParcialPorModalidad'] ?></option>
          <?php } ?>
        </select>
        <input type="hidden" name="idParcialActual" id="idParcialActual" value="<?php echo $row['idParcialActual'] ?>">
      </div>
    </div>
  </div>
<?php } ?>
</form>

   <script type="text/javascript">

   $("select[name='parciales']").on("change",function () {
     var panelPadre = $(this).parent();
     var idParcialActual1 = panelPadre.find("input:hidden").val();
      console.log(idParcialActual1);

      var idParcial = $(this).val();


      		$.ajax({
      			method:"POST",
      			url:"class/ck-scriptActualizarParcialActual.php",
      			data:{idParcialActual: idParcialActual1,idParcialSet:idParcial},
      			success:function (respuesta) {
                location.reload();
      			},
      			error:function (error,error1,error2) {
      				console.log(error2);
      			}
      		})
      	})



   /*
    * Play with this code and it'll update in the panel opposite.
    *
    * Why not try some of the options above?
    */
   Morris.Donut({
     element: 'myfirstchart',
     data: [
       {label: "Aprobados", value: 12},
       {label: "Reprobados", value: 30},
     ],
     colors: [
    '#3FFF33',
    '#FF3333'
  ]
   });



   //Compiar Nombre en la ficha de resumen
   function nombreEstudianteCorfirmar() {
    $("#nombreEstudianteResumen").html($("#nombreEstudiante").val() +" "+ $("#apellidoEstudiante").val());
   }
   //Comprobar si no existe otra Identidad Igual
   $("#identidadEstudiante").on("blur",function () {
     var identidad = $(this).val()
     $.ajax({
       method:"post",
       data: {identidadEstudiante:identidad},
       url:"class/ck-scriptComprobarIdentidadEstudiante.php",
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
         }
       }
     })
   })
   //Comprueba los datos del encargado
   $("#identidadEncargado").on("blur",function () {

     var identidadEncargado = $(this).val();

     $.ajax({
       method:'POST',
       data: {identidad: identidadEncargado},
       url:"class/ck-scriptObtenerInformacionEncargadoConIdentidad.php",
       dataType:'json',
       success:function (respuesta) {

         console.log(respuesta);

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
                   console.log('This was logged in the callback: ' + result);
               }
            });
          modal.init(function () {
            setTimeout(function () {
              modal.find('.bootbox-body').html("Padre de Familia no encontrado, proceda a <strong>Registrar Padre de Familia</strong>");
              var botonExito = modal.find('.btn-default').removeClass('btn-default').addClass('btn-success').html("Registrar Padre de Familia");
            },2000)
          })
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
       url:"class/ck-calcularEdad.php",
       method:"post",
       data:{nacimiento:$(this).val()},
       success: function (respuesta) {
        $("#edadEstudiante").html(respuesta+" Años");
       }
     })
   })
   </script>
   <?php
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }?>
   <?php include_once('layouts/footer.php'); ?>
