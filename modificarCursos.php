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
            Modificar Cursos
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-barcode" aria-hidden="true"></i> Cursos
            </li>
            <li class="active">
                <i class="fa fa-pencil" aria-hidden="true"></i> Modificar Cursos
            </li>

            <a href="insertarCurso.php" class="btn btn-primary btn-xs pull-right">+ Agregar Curso</a>
        </ol>
    </div>
</div>
<form action="" method="post">

   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Modificar Cursos</span>
         </strong>
        </div>

          <div class="col-md-5">
            <i class="material-icons pull-left">help</i><small class="text-muted pull-left">Año Lectivo: Carga la Lista de Cursos Registrados para ese Año</small class="text-muted pull-left">
          </div>
          <div class="col-md-4">
            <small for="">Cambiar Año Lectivo</small>
            <select class="form-control pull-right" name="">
              <option value="">2019</option>
            </select>
          </div>
          <hr>

        <div class="panel-body">

            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Nombre Curso</th>
                  <th>Seccion</th>
                  <th>Modalidad</th>
                  <th>Año</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = mysqli_fetch_assoc($cursos)) { ?>
                  <tr>
                    <td id="nombreCurso<?php echo $row['idCurso'] ?>"> <?php echo $row['nombreCurso'] ?></td>
                    <td id="seccionCurso<?php echo $row['idCurso'] ?>"><?php echo $row['seccion'] ?></td>
                    <td><?php echo $row['nombreModalidad'] ?></td>
                    <td><?php echo $row['anio'] ?></td>
                    <td>
                      <div class='btn-group btn-group-sm'>
                        <button name='eliminarCurso' value='<?php echo $row['idCurso'] ?>'   class='btn btn-danger' title='Eliminar Curso'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></button>
                        <button type="button" name='editarCurso' id="editarCurso" value='<?php echo $row['idCurso'] ?>'  class='btn btn-warning' title='Editar Curso' data-toggle="modal" data-target="#modalEditarCurso" ><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></button>
                      </div>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>

        </div>
      </div>
    </div>
    </div>

    <!-- Modal -->
<div id="modalEditarCurso" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Renombrar Curso</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label for="">Nombre Curso</label>
            <input type="text" name="nuevoNombreCurso" value="" id="nuevoNombreCurso" class="form-control">
          </div>
          <div class="col-md-6">
            <label for="">Seccion</label>
            <input type="text" name="nuevoSeccionCurso" value="" id="nuevoSeccionCurso" class="form-control">
          </div>
          <input type="hidden" name="nuevoIdCurso" id="nuevoIdCurso" value="">
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="guardarNuevoCurso" class="btn btn-success">Aceptar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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

<?php }else{
   echo '<script>
  alert("No Tienes acceso a esta pagina");
   window.location= "home.php";

  </script>';
}
   include_once('layouts/footer.php'); ?>
