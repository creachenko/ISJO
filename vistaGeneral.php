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
if($_SESSION['nivelAcceso'] == 2 or $_SESSION['nivelAcceso'] == 3){


$clases = $obj->obtenerClases()

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Vista General
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-briefcase" aria-hidden="true"></i> Vista General
            </li>

            <a href="index.php" class="btn btn-default btn-xs pull-right"><i class="fa fa-arrow-left"></i> Regresar</a>
        </ol>
    </div>
</div>

<?php if($clases->num_rows == 0){echo "<h1 style='color:red'>Aun no se le han asignado Clases</h1>";} ; while ($row = mysqli_fetch_assoc($clases)) { ?>
	<div class="col-md-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h1 class="panel-title"><?php echo $row['nombreCurso']."-". $row['seccion']." // ". $row['nombreAsignatura'] ?></h1>
				<small class="pull-rigth">Total Alumnos: <?php $row2 = $obj->contarEstudiantesPorClase($row['idCurso']);
															echo $row2['totalAlumnos'];?></small>
			</div>
			<div class="panel-body">
				<div class="btn-group btn-group-justified">
					<div class="btn-group">
						<button type="button" class="btn btn-warning btn-block" name="verAlumnos"  value="<?php echo $row['idClase'] ?>" data-toggle='modal' data-target='#modalCuadroAlumnos'><i class="fa fa-list-ol"></i> Ver Alumnos</button>
					</div>

				</div>

			</div>

		</div>
	</div>
<?php } ?>
<div id="modalCuadroAlumnos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Listado Alumnos</h4>
      </div>
      <div class="modal-body">
        <table class="table">
        	<thead>
        		<tr>
							<th>#</th>
        			<th>Nombre</th>
							<th>Acumulativo</th>
              <th>Examen</th>
        		</tr>
        	</thead>
					<tbody id="tableAlumnos"></tbody>
        </table>
      </div>
      <div class="modal-footer">
        <form action="formatos/reporte1.php" method="post">
          <input type="hidden" name="idClaseReporte1" value="">
          <button class="btn btn-primary pull-left">Cuadro 1(C.C)</button>
        </form>
        <form action="formatos/Cuadropdf.php" method="post">
          <input type="hidden" name="idClaseReporte1" value="">
          <button class="btn btn-info pull-left">Cuadro 1(bachillerao)</button>
        </form>


        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
$("button[name='verAlumnos']").on('click',function () {
  var idClase1 = $(this).val();
  $("#tableAlumnos").empty();

  $("input[name='idClaseReporte1']").val($(this).val());

  console.log(idClase1);
    $("#tableAlumnos").empty();

  $.ajax({
    method:"POST",
    url:"class/scriptObtenerEstudiantesPorClase.php",
    data:{idClase: idClase1},
    dataType: "json",
    success:function (respuesta) {
      console.log(respuesta);
      var i = 1;
      $.each(respuesta,function (key,value) {
        $.ajax({
          method:"POST",
          url:"class/scriptObtenerNotaEstudiante.php",
          data:{idClase: idClase1,idEstudiante:value.idEstudiante},
          success:function (respuesta) {
            $.ajax({
              method:"POST",
              url:"class/scriptObtenerNotaEstudianteExamen.php",
              data:{idClase: idClase1,idEstudiante:value.idEstudiante},
              success:function (respuesta2) {


                $("#tableAlumnos").append("<tr><td>"+i+"</td><td>"+value.nombreEstudiante+" "+value.apellidoEstudiante+"</td><td class='center-text'>"+respuesta+" <small class='text-muted'>pts</small></td><td class='center-text'>"+respuesta2+" <small class='text-muted'>pts</small></td></tr>")
                  i++;
              }
            })

          }
        })
      })

    },
    error:function (error,error1,error2) {
      console.log("Hubo un error");
    }
  })
})
</script>


<?php }
else{
   echo '<script>
  alert("No Tienes acceso a esta pagina");
   window.location= "home.php";

  </script>';
}?>
   <?php include_once('layouts/footer.php'); ?>
