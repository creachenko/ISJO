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
  if (isset($_POST['guardar'])){

    for ($i=1; $i <= $_POST['cantAsignaturas'] ; $i++) {

      if ($_POST['nombre'.$i] !== "") {
        $nombreAsignatura = ucwords(strtolower($_POST['nombre'.$i]));
        $obj->insertarAsignatura ($nombreAsignatura ,$_POST['descripcion'.$i],$_POST['selectModalidad']);
      }
    }
    $notifyVerification = ["Asignaturas asignadas con Exito ",'success'];
  }
  $asignaturas = $obj->obtenerAsignaturas();

  $modalidades = $obj->obtenerModalidades();
?>
<?php include_once('layouts/header.php'); ?>
<form method="post" action="">
  <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1>Registrar Asignaturas <small>Ingrese las Asignaturas de la modalidad</small> </h1>
        </div>
          <ol class="breadcrumb">
              <li>
                  <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
              </li>
              <li>
                  <i class="fa fa-briefcase" aria-hidden="true"></i> Cursos
              </li>
              <li class="active">
                  <i class="fa fa-briefcase" aria-hidden="true"></i> Asignaturas
              </li>
              <a href="index.php" class="btn btn-default btn-xs pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar </a>
          </ol>
      </div>
  </div>

   <div class="row">
    <div class="col-md-4">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <h2 class="panel-title"><i class="material-icons">class</i>Agregar Nueva Asignatura</h2>
        </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <label for="">Modalidad</label>
                <select class="form-control" name="selectModalidad" id="selectModalidad" onchange="onChangeSelect()">
                  <option value="" selected disabled>-Seleccione una modalidad-</option>
                  <?php while ($row = mysqli_fetch_assoc($modalidades)) { ?>
                    <option value="<?php echo $row['idModalidad'] ?>"><?php echo $row['nombreModalidad'] ?></option>
                    <?php } ?>
                </select>
                <small class="text-muted">Selecione la Modalidad correspodientes a las asignaturas que va a ingresar</small>
              </div>
            </div>

          <div class="panel-body">
            <div class="row">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre Asignatura</th>
                    <th>Descripcion (opcional)</th>
                  </tr>
                </thead>
                <tbody id='trTbody'></tbody>
              </table>
            </div>

            <div class="row">
              <div class="col-md-12">
                <button type="button" class="btn btn-info btn-block" name="button" id='agregarCampo' disabled> + Agregar Campo </button>
              </div>
            </div>

          </div>
          </div>
          <div class="panel-body">
            <div class="row">
              <div class="col-md-12">
                <input type="hidden" name="cantAsignaturas" id="cantAsignaturas" value="0">
                <button type="submit" name="guardar" class="btn btn-success btn-block">Guardar Asignaturas</button>
              </div>
            </div>
          </div>


          </div>
        </div>
        <div class="col-md-8">
          <div class="panel panel-yellow">
            <div class="panel-heading">
              <h1 class="panel-title">Asignaturas Ingresadas</h1>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>Asignatura</th>
                  <th>Modalidad</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($asignaturas == "No hay datos para mostrar") {
                  echo "$asignaturas";
                }else{

                while ($row = mysqli_fetch_assoc($asignaturas)) { ?>
                  <tr>
                    <td><?php echo $row['nombreAsignatura'] ?></td>
                    <td><?php echo $row['nombreModalidad'] ?></td>
                    <td>
                      <div class="btn-group btn-group-xs">
                        <button type="button" class="btn btn-danger" title="Eliminar Asignatura" name="button"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-warning" title="Editar Asignatura" name="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>

                      </div>
                    </td>
                  </tr>
                <?php } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    </div>
  </form>

    <script>
      var vecesApretadoAgregarCampo = 0;
      var plantilla = "<tr>"+
        "<td>:i:</td>"+
        "<td><input type='text' class='form-control' name='nombre:i:' placeholder='Nombre Asignatura'></td>"+
        "<td><input type='text' class='form-control' name='descripcion:i:' placeholder='descripcion' ></td>"+
      "</tr>";

      function onChangeSelect() {
        if ($("#trTbody").html() == "") {
          vecesApretadoAgregarCampo++;
          $("#trTbody").append(plantilla.replace(/:i:/g,vecesApretadoAgregarCampo));
          $("#agregarCampo").removeAttr('disabled');
          $("#cantAsignaturas").val(vecesApretadoAgregarCampo);
        }
      }

      $("#agregarCampo").on("click",function () {
        vecesApretadoAgregarCampo++;
        $("#trTbody").append(plantilla.replace(/:i:/g,vecesApretadoAgregarCampo));
        $("#cantAsignaturas").val(vecesApretadoAgregarCampo);
      })
    </script>

  <?php
  if (isset($notifyVerification)) {
    echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
  }
}
else{
   echo '<script>
  alert("No Tienes acceso a esta pagina");
   window.location= "home.php";

  </script>';
}

  include_once('layouts/footer.php'); ?>
