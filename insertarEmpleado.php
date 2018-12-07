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
//Escucho si se quiere guardar un empleado y de ser asi lo guardo
if (isset($_POST['guardarEmpleado'])) {
  $nombreEmpleado = ucwords(strtolower($_POST["nombreEmpleado"]));
  $apellidoEmpleado = ucwords(strtolower($_POST["apellidoEmpleado"]));
  $obj->insertarEmpleado($nombreEmpleado,$apellidoEmpleado,$_POST['identidadEmpleado'],$_POST['correoEmpleado'],$_POST['cumpleEmpleado'],$_POST['selectGenero'],$_POST['imprema'],$_POST['cargoEmpleado'],$_POST['direccionEmpleado'],$_POST['fechaIniLabores'],$_POST['celularEmpleado'],$_POST['tituloMedia'],$_POST['tituloUniversitario']);
  $notifyVerification=['Empleado Ingresados con Exito <strong><a href="modificarEmpleados.php"> Ir a Empleados</a></strong>','success'];
}

$cargos = $obj->obtenercargos();
$anios = $obj->obtenerAnioLectivos();

?>
<?php include_once('layouts/header.php'); ?>


  <div class="row">
      <div class="col-lg-12">
        <div class="page-header">
          <h1>Registrar Empleado <small>Ingrese la informacion de las nomina de Personal</small> </h1>
        </div>
          <ol class="breadcrumb">
              <li>
                  <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
              </li>
              <li>
                  <i class="fa fa-briefcase" aria-hidden="true"></i> Empleados
              </li>
              <li class="active">
                  <i class="fa fa-briefcase" aria-hidden="true"></i> Agregar Empleado
              </li>
              <a href="modificarEmpleados.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar </a>
          </ol>
      </div>
  </div>


     <div class="row">
      <div class="col-md-12">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h2 class="panel-title"><i class="fa fa-user" aria-hidden="true"></i> Insertar Empleado</h2>
          </div>
          <form method="post" action="">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3">
                  <label for="">Nombre</label>
                  <input type="text" name="nombreEmpleado" class="form-control" value="">
                </div>
                <div class="col-md-3">
                  <label for="">Apellido</label>
                  <input type="text" name="apellidoEmpleado" class="form-control" value="">
                </div>
                <div class="col-md-3">
                  <label for="">identidad</label>
                  <input type="number" name="identidadEmpleado" class="form-control" value="">
                </div>
                <div class="col-md-3">
                  <label for="">Correo e-Mail</label>
                  <input type="email" name="correoEmpleado" class="form-control" value="">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <label for="">Fecha Nacimiento</label>
                  <input type="date" class="form-control" name="cumpleEmpleado" value="">
                </div>
              <div class="col-md-2">
                <label for="">Genero</label>
                <select class="form-control" name="selectGenero" name="selectGenero">
                  <option>Femenino</option>
                  <option>Masculino</option>
                </select>
              </div>
              <div class="col-md-2">
                <label>Numero imprema</label>
                <input type="text" name="imprema" value="" class="form-control">
              </div>
              <div class="col-md-2">
                <label>Cargo</label>
                <select class="form-control" name="cargoEmpleado">
                  <?php while($cargo = mysqli_fetch_assoc($cargos)){ ?>
                    <option value="<?php echo $cargo['idCargo']; ?>"><?php echo $cargo['nombreCargo'] ?></option>
                <?php  } ?>

                </select>
                <small> <a href="#">Ir a Cargos</a> </small>
              </div>
              <div class="col-md-4">
                <label for="">Direccion</label>
                <input type="text" name="direccionEmpleado" class="form-control" value="">
              </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-2">
                  <label for="">Inicio Labores</label>
                  <input type="date" class="form-control" name="fechaIniLabores" value="">
                </div>
                <div class="col-md-2">
                  <label for="">Celular</label>
                  <input type="number" class="form-control" name="celularEmpleado" value="">
                </div>
                <div class="col-md-4">
                  <label for="">Titulo Nivel Media</label>
                  <input type="text" class="form-control" name="tituloMedia" value="">
                </div>
                <div class="col-md-4">
                  <label for="">Titulo Nivel Universitario</label>
                  <input type="text" class="form-control" name="tituloUniversitario" value="">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" name="button" class="btn btn-warning">Limpiar Campos</button>
              <button type="submit" name="guardarEmpleado" class="btn btn-success">Guardar Empleado</button>
            </div>
          </form>
        </div>
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
