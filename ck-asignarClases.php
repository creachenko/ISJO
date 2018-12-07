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
if (isset($_POST['asignarAsignatura'])) {
  $resp = $obj->insertarClase($_POST["idAsignatura"],$_POST["idEmpleado"],$_POST["idCurso"],$_POST["horaClase"]);
  echo "<script>console.log(".$_POST["idEmpleado"].")</script>";
  if ($resp == "error") {
    $notifyVerification = ["Esa clase <strong>Ya Existe</strong>",'danger'];
  }else {
    $notifyVerification = ["Clase Creada Con <strong>Exito</strong>",'success'];
  }
}

$modalidades = $obj->obtenerModalidades();
$Empleados = $obj->obtenerEmpleados();
$clases = $obj->obtenerClases();
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Asignar Clases
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-briefcase" aria-hidden="true"></i> Clases
            </li>
            <li class="active">
                <i class="fa fa-briefcase" aria-hidden="true"></i> Asignar Clases
            </li>
        </ol>
    </div>
</div>

<form action="#" method="post">
<div class="row">
  <div class="col-md-6">
    <div class="panel panel-red">
      <div class="panel-heading">
        <h1 class="panel-title">Asignar Clase</h1>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-6">
            <label>Modalidad</label>
            <select class="form-control" name="" id="selectModalidad">
              <option value="" selected disabled required>-Seleccione Modalidad-</option>
              <?php while ($row = mysqli_fetch_assoc($modalidades)) { ?>
                <option value="<?php echo $row['idModalidad'] ?>"><?php echo $row['nombreModalidad'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
              <label>Curso</label>
              <select class="form-control" name="idCurso" disabled id="selectCurso" required>
                <option value="" selected disabled>-Seleccione Curso-</option>
              </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label>Empleado</label>
            <select class="form-control" name="idEmpleado" id="selectEmpleado" required>
              <option value="" selected disabled>-Seleccione Maestro-</option>
              <?php while ($row = mysqli_fetch_assoc($Empleados)) { ?>
                <option value="<?php echo $row['idEmpleado'] ?>"><?php echo $row['nombreEmpleado'] ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <label>Asignatura</label>
            <select class="form-control" name="idAsignatura" id="selectAsignatura" disabled>
              <option value="" selected disabled>-Seleccione Asignatura-</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Hora Clase</label>
            <input type="time" name="horaClase" class="form-control">
          </div>
        </div>
      </div>
      <div class="panel-footer">
        <button type="submit" class="btn btn-success btn-block" name="asignarAsignatura">Asignar Clase</button>
      </div>
    </div>
  </div>

  <div class="col-md-6">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h1 class="panel-title">Clases Asignadas</h1>
      </div>
      <table class="table">
        <thead>
        <th>Maestro</th>
        <th>Asignatura</th>
        <th>Curso</th>
        <th>Eliminar</th>
        </thead>
        <tbody>
          <?php while ($row2 = mysqli_fetch_assoc($clases)) { ?>
            <tr>
              <td><?php echo $row2['nombreEmpleado'] ?></td>
              <td><?php echo $row2['nombreAsignatura'] ?></td>
              <td><?php echo $row2['nombreCurso']." ".$row2['seccion'] ?></td>
              <td><button class="btn btn-danger btn-sm btn-block" name="eliminarClase<?php echo $row2["idClase"];?>"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td>

            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
</form>


   <script type="text/javascript">
   //Confirmar Cursos segun modalidad
   $("#selectModalidad").on("change",function (ev) {

     var idModalidad1 = $("#selectModalidad option:selected").val();

      $.ajax({
        method:"POST",
        url:"class/ck-scriptObtenerCursosAnioLectivo.php",
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

      $("#selectEmpleado").removeAttr("disabled");
      $("#selectAsignatura").removeAttr("disabled");

      $.ajax({
        method:"POST",
        url:"class/ck-scriptObtenerAsignaturasConIdModalidad.php",
        data:{idModalidad: idModalidad1},
        dataType: "json",
        success:function (respuesta) {
          $("#selectAsignatura").removeAttr("disabled");
          $("#selectAsignatura").empty();

          console.log(respuesta);

          $.each(respuesta,function (key,valor) {
            $("#selectAsignatura").append("<option value="+valor.idAsignatura+">"+valor.nombreAsignatura+"</option>")
            console.log(key + " "+ valor.nombreAsignatura)
          })
        },
        error:function (error,error1,error2) {
          console.log(error2);
        }
      })


   })
   </script>
   <?php
  //Recibo cualquier notificacion y la muestro
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }?>
   <?php include_once('layouts/footer.php'); ?>
