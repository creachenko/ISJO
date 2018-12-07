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

//Escucho si se quiere eliminar datos en Cursos, de ser asi lo elimino
if (isset($_POST['eliminarCursoConfirmado'])) {
  $obj->eliminarCurso($_POST['eliminarCursoConfirmado']);
  //echo "<script>window.alert(".$_POST['eliminarCargoConfirmado'].")</script>";
  $notifyVerification = ["Eliminado con Exito",'danger']; // Muestro notificacion de exito
}

//Escucho si se quiere editar datos en Cursos, de ser asi lo editor
if (isset($_POST['guardarNuevoCurso'])) {
  $obj->editarCurso($_POST['nuevoNombreCurso'],$_POST['nuevoSeccionCurso'],$_POST['nuevoIdCurso']);
  $notifyVerification = ["Renombrado : ".$_POST['nuevoNombreCurso'],'info']; // Muestro notificacion de exito
}

$cursos = $obj->obtenerCursos();
$modalidades = $obj->obtenerModalidades();



?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Datos de la Institucion
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-barcode" aria-hidden="true"></i> Institucion
            </li>
        </ol>
    </div>
</div>
<form action="" method="post">

   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Informacion del Colegio</span>
         </strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-4">
              <label for="">Prefijo</label>
              <input type="text" class="form-control" name="" value="Instituto">
            </div>
            <div class="col-md-8">
              <label for="">Nombre Centro</label>
              <input type="text" class="form-control" name="" value="San Jorge de Olancho">
            </div>
          </div>
          <div class="row">
            <div class="col-md-3">
              <label for="">Codigo Centro</label>
              <input type="text" class="form-control" name="" value="150118753P3">
            </div>
            <div class="col-md-3">
              <label for="">Departamento</label>
              <input type="text" class="form-control" name="" value="Olancho">
            </div>
            <div class="col-md-3">
              <label for="">Municipio</label>
              <input type="text" class="form-control" name="" value="Juticalpa">
            </div>
            <div class="col-md-3">
              <label for="">Nota Apro.</label>
              <input type="text" class="form-control" name="" value="70">
            </div>
          </div>
          <div class="row">
            <div class="col-md-10">
              <label for="">Direccion</label>
              <textarea name="name" class="form-control">Punuare 1/2 kilometro del desvio de punuare</textarea>
            </div>
            <hr>
            <div class="col-md-2">
              <button type="submit" class="btn btn-success btn-block btn-block" name="button">Guardar</button>
            </div>
          </div>
        </div>


      </div>
    </div>
    </div>


</form>
    <?php if (isset($notifyVerification)){ // Verifico si hay una notificacion, si es asi la me=uestro
      echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
    } ?>

    <script type="text/javascript">
    var vecesApretadoConfirmarEliminarCurso = 0;

    $("button[name='eliminarCurso']").click(function (even) {

      if (vecesApretadoConfirmarEliminarCurso == 0) {
        even.preventDefault();
        console.log('apretaste '+ $(this).val());
        $(this).html('Eliminar?');
        $(this).attr('name','eliminarCursoConfirmado')
        $(this).attr('type','submit')
        vecesApretadoConfirmarEliminarCurso = vecesApretadoConfirmarEliminarCurso + 1;
      }else {
        console.log('Eliminar confirmado');
      }

    })

    $("button[name='eliminarCurso']").on("blur",function (even) {

        even.preventDefault();
        console.log('perdida de foco '+ $(this).val());
        $(this).html("<span class='glyphicon glyphicon-remove' aria-hidden='true' ></span>");
        $(this).attr('name','eliminarCurso')
        $(this).attr('type','button')
        vecesApretadoConfirmarEliminarCurso = vecesApretadoConfirmarEliminarCurso - 1;

    })

    $("button[id='editarCurso']").on("click",function () {
      console.log($(this).val());
      var nombreCurso = $("td[id='nombreCurso"+$(this).val()+"']").html()
      var seccionCurso = $("td[id='seccionCurso"+$(this).val()+"']").html()
      $("#nuevoNombreCurso").val(nombreCurso)
      $("#nuevoSeccionCurso").val(seccionCurso)
      $("#nuevoIdCurso").val($(this).val());
    })
    </script>
  <?php include_once('layouts/footer.php'); ?>
