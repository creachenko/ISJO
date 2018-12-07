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
  for ($i=1; $i <= $_POST['cantCursos'] ; $i++) {
    echo "<script>console.log('".$_POST['nombreCurso'.$i],$_POST['seccionCurso'.$i],$_POST['selectModalidad'],$_POST['selectAnioLectivo']."')</script>";
    $obj->insertarCurso($_POST['nombreCurso'.$i],$_POST['seccionCurso'.$i],$_POST['selectModalidad'],$_POST['selectAnioLectivo']);
  }
  $notifyVerification=['Cursos Ingresados con Exito <strong><a href="modificarCursos.php"> Ir a Cursos</a></strong>','success'];
}

$modalidades = $obj->obtenerModalidades();
$anios = $obj->obtenerAnioLectivos();

?>
<?php include_once('layouts/header.php'); ?>

  <div class="page-header">
    <h1>Registrar Cursos</h1>
  </div>


     <div class="row">
      <div class="col-md-10">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 class="panel-title"><i class="material-icons">class</i>Agregar Nuevos Cursos</h2>
          </div>
          <form method="post" action="">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <label for="">Modalidad</label>
                  <select class="form-control" name="selectModalidad" id="selectModalidad" onchange="onChangeSelect()" required>
                    <option value="" selected disabled>-Seleccione una modalidad-</option>
                    <?php while ($row = mysqli_fetch_assoc($modalidades)) { ?>
                      <option value="<?php echo $row['idModalidad'] ?>"><?php echo $row['nombreModalidad'] ?></option>
                      <?php } ?>
                  </select>
                  <small class="text-muted">Selecione la Modalidad correspodientes a los cursos que va a ingresar</small>
                </div>
                <div class="col-md-6">
                  <label for="">Año Lectivo</label>
                  <select class="form-control" name="selectAnioLectivo" id="selectAnioLectivo" onchange="onChangeSelect()" required>
                    <option value="" selected disabled>-Seleccione el Año-</option>
                    <?php while ($row = mysqli_fetch_assoc($anios)) { ?>
                      <option value="<?php echo $row['idAnioLectivo'] ?>"><?php echo $row['anio'] ?></option>
                      <?php } ?>
                  </select>
                  <small class="text-muted">Selecione la Modalidad correspodientes a los cursos que va a ingresar</small>
                </div>
              </div>

            <div class="panel-body">
              <div class="row">
                <table class="table">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre Curso</th>
                      <th>Seccion</th>
                    </tr>
                  </thead>
                  <tbody id='trTbody'></tbody>
                </table>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <button type="button" class="btn btn-info btn-block" name="button" id='agregarCampo' disabled> <i class="material-icons">plus_one</i> </button>
                </div>
              </div>

            </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-12">
                  <input type="hidden" name="cantCursos" id="cantCursos" value="0">
                  <button type="submit" name="guardar" class="btn btn-success btn-block">Guardar Cursos</button>
                </div>
              </div>
            </div>


            </div>
          </form>
          </div>
        </div>
      </div>
      </div>

    <script type="text/javascript">
    var vecesApretadoAgregarCampo = 0;
    var plantilla = "<tr>"+
      "<td>:i:</td>"+
      "<td><input type='text' class='form-control' name='nombreCurso:i:' placeholder='Nombre Curso'></td>"+
      "<td><input type='text' class='form-control' name='seccionCurso:i:' placeholder='Seccion' ></td>"+
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
      $("#cantCursos").val(vecesApretadoAgregarCampo);
    })
    </script>
  <?php
  if (isset($notifyVerification)) {
    echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
  }
  include_once('layouts/footer.php'); ?>
