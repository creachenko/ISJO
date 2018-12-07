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

//Escucho si se ingresado datos en cargos, de ser asi los ingreso a la BD---
if (isset($_POST['submitCargo'])) {
  $obj->ingresarCargos($_POST['nombreCargo'],$_POST['descripcion']);
  $notifyVerification = ["Cargo ".$_POST['nombreCargo']." Ingresado Exitosamente",'success']; // Muestro notificacion de exito
}
//Escucho si se quiere eliminar datos en Cargos, de ser asi lo elimino
if (isset($_POST['eliminarCargoConfirmado'])) {
  $obj->eliminarCargo($_POST['eliminarCargoConfirmado']);
  //echo "<script>window.alert(".$_POST['eliminarCargoConfirmado'].")</script>";
  $notifyVerification = ["Eliminado con Exito",'danger']; // Muestro notificacion de exito
}
//Escucho si se quiere editar datos en Cargos, de ser asi lo edito
if (isset($_POST['idCargoUpdate'])) {


  $obj->editarCargo($_POST['idCargoUpdate'],$_POST['cargoUpdate']);
  //echo "<script>window.alert(".$_POST['eliminarCargoConfirmado'].")</script>";
  $notifyVerification = ["Cargo Editado con Exito: <strong>".$_POST['cargoUpdate']."</strong>",'warning']; // Muestro notificacion de exito
}

//Generar tabla cargos-----------------------------
function tablaCargos($cargos){
  $i = 0;
  while ($aux = mysqli_fetch_assoc($cargos)) {
    echo "<tr>";
    echo "<td id='".$i."'>".$aux['nombreCargo']."</td>";
    //botnes de accion
    echo "<td>
      <div class='btn-group btn-group-sm'>
        <button name='eliminarCargo' value='".$aux['idCargo']."' id='confirmarEliminarCargo'  class='btn btn-danger' title='Eliminar Tarea'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></button>
        <button name='editarCargo' value='".$aux['idCargo']."' id='$i' class='btn btn-warning' title='Editar Tarea'><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></button>
      </div>
    </td>";
    echo "</tr>";
    $i++;
  }

}

if (isset($_POST['guardar'])){
  $data = new funcionesBD();
  $data->RegistrarEmp();
}

?>
<?php include_once('layouts/header.php'); ?>

  <div class="page-header">
    <h1>Ajustes Generales</h1>
  </div>

   <div class="row">
    <div class="col-md-12">
      <div class="col-md-3">
        <button type="button" class="btn btn-info btn-lg btn-block" name="button" data-toggle="modal" data-target="#gestionarCargos">
          <i class="material-icons">view_list</i>
          Gestionar Cargos
        </button>
      </div>
      <div class="col-md-3">
        <button type="button" class="btn btn-warning btn-lg btn-block" name="button">
          <i class="material-icons">featured_play_list</i>
          Gestionar Nomina
        </button>
      </div>
      <div class="col-md-3">
        <button type="button" class="btn btn-warning btn-lg btn-block" name="button" id="prueba">
          <i class="material-icons">featured_play_list</i>
          proba
        </button>
      </div>
      <div class="col-md-3">
        <button type="button" class="btn btn-success btn-lg btn-block" name="button">
          <i class="material-icons">face</i>
          Gestionar Estudiantes
        </button>
      </div>
    </div>
    </div>


    <!-- Modal -->
<div id="gestionarCargos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Gestionar Cargos</h4>
      </div>
      <form class="" action="#" method="post" id="formNuevoCargo">
        <div class="modal-body">
          <p>Estos son los cargos que los empleados en la institucion pueden ostentar, cree y edite los cargos segun corresponda.</p>
          <div class="col-md-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h1 class="panel-title">Agregar Cargo</h1>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" name="nombreCargo" class="form-control" placeholder="P.j Secretaria" required>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <input type="text" name="descripcion" value="" class="form-control" placeholder="Descripcion (opcional)">
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-success btn-block" name="submitCargo"> <i class="material-icons" style="font-size:15px">done</i> </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
          <form class="" action="#" method="post">
          <div class="col-md-6">
            <div class="panel panel-warning">
              <div class="panel-heading">
                <h1 class="panel-title">Cargos Ingresados</h1>
              </div>
                <table class="table">
                  <thead>
                    <tr>
                      <th>Cargo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php tablaCargos($obj->obtenerCargos()); ?>
                  </tbody>
                </table>
            </div>
          </div>
          <div class="panel-body">
            <div class="row" id="inputEditarCargo">

            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

</div>
</div>

<?php if (isset($notifyVerification)){ // Verifico si hay una notificacion, si es asi la me=uestro
  echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
} ?>

<script type="text/javascript">
  var vecesApretadoConfirmarElinarCargo = 0;
  $("button[name='eliminarCargo']").click(function (even) {

    if (vecesApretadoConfirmarElinarCargo == 0) {
      even.preventDefault();
      console.log('apretaste '+ $(this).val());
      $(this).html('Eliminar?');
      $(this).attr('name','eliminarCargoConfirmado')
      $(this).attr('type','submit')
      vecesApretadoConfirmarElinarCargo = vecesApretadoConfirmarElinarCargo + 1;
    }else {
      console.log('Eliminar confirmado');
    }

  })
  //---------------------------------------------------------------------------------
  var apretadoEditarCargo = 0;
  $("button[name='editarCargo']").click(function (even) {
      even.preventDefault();
      var nombreCargo = $("td[id='"+$(this).attr("id")+"']").html();

      if ($("#inputEditarCargo").html() == "") {
        $("#inputEditarCargo").append("<label id='labelEditarCargo'>Editar Cargo : "+nombreCargo+"</label>");
        $("#inputEditarCargo").append("<textarea id='textareaEditarCargo'name='cargoUpdate' class='form-control' placeholder='Editar Cargo'></textarea>");
        $("#inputEditarCargo").append("<button value='"+$(this).val()+"' name='idCargoUpdate' class='btn btn-success btn-block'>Enviar</button>");
      }else{
        $("#labelEditarCargo").remove();
        $("#textareaEditarCargo").remove();
        $("button[name='idCargoUpdate']").remove();

        $("#inputEditarCargo").append("<label id='labelEditarCargo'>Editar Cargo : "+nombreCargo+"</label>");
        $("#inputEditarCargo").append("<textarea id='textareaEditarCargo' name='cargoUpdate' class='form-control' placeholder='Editar Cargo'></textarea>");
        $("#inputEditarCargo").append("<button value='"+$(this).val()+"' name='idCargoUpdate' class='btn btn-success btn-block'>Enviar</button>");

      }



      console.log('apretaste  '+ $("td[id='"+$(this).attr("id")+"']").html());




  })
</script>

</script>
  <?php include_once('layouts/footer.php'); ?>
