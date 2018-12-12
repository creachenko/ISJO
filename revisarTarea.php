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
<?php

if (isset($_POST["checkTarea"])) {

}else {
  echo "<script>window.alert('No tiene Acceso a este Modulo Aun');
        window.location = 'clases.php'</script>";
}

$estudiantes = $obj->obtenerEstudiantesPorClase($_POST["idClaseCheckTarea"]);
$tarea = $obj->obtenerTareaPorId($_POST["checkTarea"])->fetch_assoc();
$nombreCurso =  $obj->obtenerClasePorId($_POST["idClaseCheckTarea"])->fetch_assoc();

 ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>

     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="description" content="">
     <meta name="author" content="">

     <title>Instituto San Jorge de Olancho</title>

     <!-- Bootstrap Core CSS -->
     <link href="css/bootstrap.css" rel="stylesheet">

     <!-- Custom CSS -->
     <link href="css/sb-admin.css" rel="stylesheet">
     <link href="css/animate.css" rel="stylesheet">

     <!-- Morris Charts CSS -->
     <link href="css/plugins/morris.css" rel="stylesheet">

     <!-- Custom Fonts -->
     <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     <link href="fonts/material-icons.css" rel="stylesheet" type="text/css">

     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
     <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
     <![endif]-->
 <script src="js/jquery.js"></script>
 </head>

 <body>
   <div id="page-wrapper">

       <div class="container-fluid">

 <h1 class="page-header">
     Revisar Tarea <small>Seleccione un Estudiante del panel amarillo y asignele un Puntaje</small>
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
                  <i class="fa fa-graduation-cap" aria-hidden="true"></i><?php echo $nombreCurso['curso'] ?>
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
       <hr style="margin-top: 3px;margin-bottom: 1px;">
       <small>Rojo: Tarea no Revisada </small> <br>
       <small>Verde: Tarea Revisada </small>
     </div>
     <input type="hidden" id="idTarea" value="<?php echo $_POST["checkTarea"] ?>">
     <div class="list-group">

         <?php $i = 1;
          while ($row = mysqli_fetch_assoc($estudiantes)) { ?>
             <button name="buttonEstudiante" class="list-group-item <?php $check = $obj->revisarSiExisteTarea($row["idEstudiante"],$_POST["checkTarea"]);
                           $rows = $check->num_rows;
                            if ($rows > 0) { ?>
                             <?php echo "list-group-item-success";
                                    $icono = "<i class='fa fa-check' aria-hidden='true'></i>";?>
                           <?php }else{ ?>
                             <?php echo "list-group-item-danger" ;
                                    $icono = "<i class='fa fa-times-circle-o' aria-hidden='true'></i>";?>
                           <?php }?>" value="<?php echo $row["idEstudiante"] ?>">
               <?php echo $i.". ".$icono." ".$row["nombreCompleto"]."" ?>
               </button>
         <?php $i++;} ?>
      </div>

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
                  <input type="text" name="nombreEstudiante" value="---" class="form-control" disabled>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-3">
                  <label for="">Puntaje Obtenido</label>
                  <input type="number" name="puntaje" value="0" class="form-control">

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

<script type="text/javascript">
  $("button[name='buttonEstudiante']").on("click",function () {
    var idEstudiante1 = $(this).val();
    var idTarea1 = $("#idTarea").val();
    console.log(idEstudiante1 + idTarea1);
    $.ajax({
      method:"POST",
      url:"class/scriptObtenerTarea.php",
      data:{idEstudiante: idEstudiante1,idTarea:idTarea1},
      dataType: "json",
      success:function (respuesta) {
        console.log(respuesta);

        $("input[name='nombreEstudiante']").val(respuesta.nombreCompleto);
        $("input[name='puntaje']").val(respuesta.puntajeObtenido);


      },
      error:function (error,error1,error2) {
        console.log(error2);
      }
    })
  })
</script>

   <?php include_once('layouts/footer.php'); ?>
