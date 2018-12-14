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
  $obj->insertarEncargado($_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['genero'],$_POST['identidadEncargado'],$_POST['correo'],$_POST['profesion'],$_POST['direccion']);
  $notifyVerification=["Registro Exitoso: ".$_POST['nombre'].$_POST['apellido'],'success'];
}

?>
<?php include_once('layouts/header.php'); ?>

<h1 class="page-header">
    Padres de Familia
</h1>
  <div class="col-md-8">

      <ol class="breadcrumb">
          <li>
              <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
          </li>
          <li>
              <i class="fa fa-barcode" aria-hidden="true"></i> Estudiantes
          </li>
          <li>
              <i class="fa fa-barcode" aria-hidden="true"></i> Padres de Familia
          </li>
          <li class="active">
              <i class="fa fa-barcode" aria-hidden="true"></i> Agregar P.F
          </li>
          <a href="modificarEncargadoS.php" class="btn btn-primary btn-xs pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a>
      </ol>
  </div>
  <div class="col-md-4">
    <ul class="nav nav-tabs">
      <li role="presentation"><a href="ck-listadoEstudiantes.php">Estudiantes</a></li>
      <li role="presentation" class="active"><a href="modificarEncargados.php">Padres de Familia</a></li>
    </ul>
  </div>
</div>
   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Ingrese los datos Personales del padre de familia o encargado </span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="">
            <div class="row">
              <div class="col-md-3">
                <label for="">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Ingrese Nombres del Encargado" required>
              </div>
              <div class="col-md-3">
                <label for="">Apellidos</label>
                  <input type="text" class="form-control" name="apellido" placeholder="Ingrese Apellidos del Encargado" required>
              </div>
              <div class="col-md-2">
                <label for="">Celular</label>
                  <input type="numeric" class="form-control" name="telefono" placeholder="Telefono del Encargado" required>
              </div>
              <div class="col-md-2">
                <label for="status">Genero</label>
                <select class="form-control" name="genero">
                  <option>Masculino</option>
                  <option>Femenino</option>
                </select>
              </div>

                <div id="divIdentidad" class="col-md-2">
                    <label class="control-label" for="inputError">Identidad</label>
                      <input type="text" name="identidadEncargado" class="form-control" id="identidadEncargado" onblur="comprobarIdentidad()" required>
                  </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-md-2">
                <label for="">Correo</label>
                <input type="text" class="form-control" name="correo" placeholder="(Opcional)">
              </div>

              <div class="col-md-2">
                <label for="">Profesio/Oficio</label>
                <input type="text" class="form-control" name="profesion" placeholder="Profesion u Oficio" required>
              </div>
              <div class="col-md-2">
                <label for="status">Direccion</label>
                <input type="text" class="form-control" name="direccion" placeholder="Direccion de Encargado" required>
              </div>
              <div class="col-md-4">
                <hr>
                <div class="col-md-6">
                  <button type="reset" class="btn btn-warning btn-block">Limpiar Campos</button>
                </div>
                <div class="col-md-6">
                  <button type="submit" id="guardar" name="guardar" class="btn btn-success btn-block">Enviar</button>
                </div>

              </div>
            </div>
            <div class="row">
              <div class="col-md-12">

              </div>
            </div>
        </form>
      </div>
      <div class="panel-footer">

      </div>
      </div>
    </div>
    </div>

    <script type="text/javascript">
      function comprobarIdentidad() {
        $.ajax({
          method:"POST",
          url:"class/ck-scriptComprobarIdentidadEncargado.php",
          data:{identidad: $("#identidadEncargado").val()},
          success:function (respuesta) {
            console.log(respuesta);
            if (respuesta > 0) {
              $("#guardar").attr("disabled","disabled");

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
              $("#guardar").removeAttr("disabled");
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
    </script>
    <?php
    if (isset($notifyVerification)) {
      echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
    }?>
  <?php include_once('layouts/footer.php'); ?>
