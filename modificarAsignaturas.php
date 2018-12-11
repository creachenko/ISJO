<?php
$arr;
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

if (isset($_POST[])) {
  // code...
}

$modalidades = $obj->obtenerModalidades();

?>
<?php include_once('layouts/header.php'); ?>

<form action="" method="post">

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
        <div class="panel panel-red">
          <div class="panel-heading">
            <h1 class="panel-title">Ingresar Asignatura</h1>
          </div>
        <div class="panel-body">
          <label>Modalidad</label>
          <select class="form-control" name="idModalidad" id="selectModalidad" onchange="agregarCampo()">
            <option value="" selected disabled>--Seleccione una Modalidad--</option>
            <?php while ($row = mysqli_fetch_assoc($modalidades)) { ?>
                <option value="<?php echo $row['idModalidad'] ?>"><?php echo $row["nombreModalidad"] ?></option>
            <?php } ?>
          </select>
        </div>
        <table class="table">
          <tbody id="inputAsignaturas">

          </tbody>
        </table>
        <div class="panel-footer">
          <div class="btn-group btn-group-justified">
            <div class="btn-group">
              <button type="button" name="agregarCampo" class="btn btn-primary " disabled onclick="agregarCampo()" >+ Agregar Campo</button>
            </div>
            <div class="btn-group">
              <button type="submit" name="guardarAsignaturas" value="" disabled class="btn btn-success ">Guardar Asignaturas</button>
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

            </tbody>
          </table>
        </div>
      </div>
      </div>
    </form>

    <script type="text/javascript">
    //Habilito la opcion de ingrear asignaturas cuando se selecciona una modalidades
    var plantilla = "<tr><td><input type='text' class='form-control' name='asignatura:i:' placeholder='Nombre de la Asignatura aqui'></td></tr>";
    var i = 1;

    function agregarCampo() {
      $("button[name='agregarCampo']").removeAttr("disabled");
      $("button[name='guardarAsignaturas']").removeAttr("disabled");
      var input = plantilla.replace(":i:",i);
      $("#inputAsignaturas").append(input);
      $("button[name='guardarAsignaturas']").val(i);
      i++;
    }


    </script>
  <?php
  if (isset($notifyVerification)) {
    echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
  }
  include_once('layouts/footer.php'); ?>
