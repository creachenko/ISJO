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
}; ?>
<style media="screen">

.degradadoGris{
  border-radius: 70px;
  background: -moz-linear-gradient(top, rgba(186,186,186,0.65) 0%, rgba(51,51,51,0) 63%, rgba(0,0,0,0) 87%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(186,186,186,0.65) 0%,rgba(51,51,51,0) 63%,rgba(0,0,0,0) 87%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(186,186,186,0.65) 0%,rgba(51,51,51,0) 63%,rgba(0,0,0,0) 87%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#a6bababa', endColorstr='#00000000',GradientType=0 ); /* IE6-9 */
}

</style>
<?php include_once('layouts/header.php');

if (isset($_POST["checkTarea"])) {

}else {
  echo "<script>window.alert('No tiene Acceso a este Modulo Aun');
        window.location = 'clases.php'</script>";
}

$estudiantes = $obj->obtenerEstudiantesPorClase($_POST["idClaseCheckTarea"]);
$tarea = $obj->obtenerTareaPorId($_POST["checkTarea"])->fetch_assoc();
 ?>
 <h1 class="page-header">
     Revisar Tarea
 </h1>
 <div class="row">
     <div class="col-md-12">

         <ol class="breadcrumb">
             <li>
                 <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
             </li>
             <li>
                 <i class="fa fa-briefcase" aria-hidden="true"></i> Mis Clases
             </li>
             <li>
                 <i class="fa fa-briefcase" aria-hidden="true"></i> Revisar Tarea
             </li>
             <a href="clases.php" class="btn btn-default btn-xs pull-right">Regresar</a>
       	</ol>
     </div>
 </div>
 <div class="col-md-3">
   <div class="panel panel-yellow">
     <div class="panel-heading">
       <h1 class="panel-title">Listado Alumnos</h1>
     </div>
     <table class="table">
       <thead>
         <tr>
           <th>Nombre</th>
           <th>Revisado</th>
         </tr>
       </thead>
     </table>
     <ul class="list-group">

         <?php while ($row = mysqli_fetch_assoc($estudiantes)) { ?>
             <li class="list-group-item">
               <?php echo "<a value=".$row["idEstudiante"].">".$row["nombreEstudiante"]."</a>" ?>
             <?php $check = $obj->revisarSiExisteTarea($row["idEstudiante"],$_POST["checkTarea"]);
                        $rows = $check->num_rows;
                         if ($rows > 0) { ?>
                          <span class="label label-success pull-right">Tarea Revisada</span>
                        <?php }else{ ?>
                          <span class="label label-danger pull-right">No Revisada</span>
                        <?php }  ?></li>
         <?php } ?>
      </ul>

   </div>
 </div>
    <div class="col-md-9">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Revisar Tarea</span>
       </strong>
      </div>
        <form>
          <div class="panel-body">
              <div class="col-md-7 degradadoGris">
                <div class="page-header text-center">
                  <h4><small>Nombre Tarea</small></h4>
                  <h2><?php echo $tarea['nombreTarea'] ?></h2>
                </div>
              </div>
              <div class="col-md-1">

              </div>
              <div class="col-md-3 degradadoGris">
                <div class="page-header text-center">
                  <h4><small>Valor de la Tarea</small></h4>
                  <h2><?php echo $tarea['valorTarea'] ?> <small>Pts</small>  </h2>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-9">
                  <label>Nombre Estudiante</label>
                  <input type="text" name="nombreEstudiante" value="Luis Santiago Cruz" class="form-control" disabled>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="inputCity">Puntaje Obtenido</label>
                  <input type="number" class="form-control">

                </div>
         </div>
         <div class="form-row">
           <div class="col-md-12">
             <button type="button" name="button" class="btn btn-success btn-lg btn-block" >Asignar Puntaje</button>
           </div>
         </div>
       </div>
       <hr>
       <div class="panel-body">
         <div class="col-md-8">
           <textarea name="name" placeholder="Razon por la que el estudiante no presento la tarea (Opcional)" class="form-control"></textarea>
         </div>
         <div class="col-md-4">
           <button type="button" class="btn btn-danger btn-block" name="button">No hizo la Tarea</button>
         </div>

       </div>
      </form>


   <?php include_once('layouts/footer.php'); ?>
