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

if (isset($_POST["go"])) {

}else {
  echo "<script>window.alert('No tiene Acceso a este Modulo Aun');
        window.location = 'clases.php'</script>";
}
if (isset($_POST['examId'])) {
  $idExamen = $_POST['examId'];
}

if ($_POST["go"] == 0) {
  echo "<script>window.alert('LLamando para pedir un nuevo examen')</script>";
  $idExamen = $obj->insertarExamen($_POST['classId'],$_POST['examValue']);

}


$estudiantes = $obj->obtenerEstudiantesPorClase($_POST['classId']);
$tarea = $obj->obtenerTareaPorId($idExamen)->fetch_assoc();
$nombreCurso =  $obj->obtenerClasePorId($_POST['classId'])->fetch_assoc();

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
             <a href="clases.php" class="btn btn-default btn-xs pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a>
       	</ol>
     </div>
 </div>
 <div class="col-md-3">
   <div class="panel panel-yellow">
     <div class="panel-heading">
       <h1 class="panel-title"><i class="fa fa-list-ol" aria-hidden="true"></i><strong> Listado Alumnos</strong></h1>
       <hr style="margin-top: 3px;margin-bottom: 1px;">
       <small>Rojo: Tarea no Revisada </small> <br>
       <small>Verde: Tarea Revisada </small>
     </div>
     <input type="hidden" id="activeItem" value="">
     <div class="list-group">

         <?php $i = 1;
          while ($row = mysqli_fetch_assoc($estudiantes)) { ?>
                <button name="buttonEstudiante" class="list-group-item <?php $check = $obj->revisarSiExisteTarea($row["idEstudiante"],$_POST["examId"]);
                              $rows = $check->num_rows;
                               if ($rows > 0) { ?>
                                <?php echo "list-group-item-success";
                                       $icono = "<i class='fa fa-check' aria-hidden='true'></i>";?>
                              <?php }else{ ?>
                                <?php echo "list-group-item-danger" ;
                                       $icono = "<i class='fa fa-times-circle-o' aria-hidden='true'></i>";?>
                              <?php }?>" value="<?php echo $row["idEstudiante"] ?>" id="<?php echo $i ?>" >
                  <text id="flecha" class=""></text> <?php echo $i.". ".$icono." ".$row["nombreCompleto"]."" ?>
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
        <form name="form">
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
                  <input type="number" name="puntaje" id='puntaje' value="" onchange="puntaje2()" min="0" max="<?php echo $tarea['valorTarea'] ?>" class="form-control">
                  <input type="hidden" name="" id="puntajeHidden" value="">
                  <input type="hidden" name="" id="puntajeHidden2" value="">
                </div>
         </div>
         <div class="form-row">
           <div class="col-md-12">
             <button type="button" name="asignarPuntaje" id="asignarPuntaje" value="" class="btn btn-success btn-lg btn-block" >Asignar Puntaje</button>
            <input type="hidden" name="idTarea" id="idTarea" value="<?php echo $idExamen ?>">
            <input type="hidden" name="idEstudiante" id="idEstudiante" value="">
            <input type="hidden" name="idEstadoTarea" id="idEstadoTarea" value="">
            <input type="hidden" name="idClase" value="<?php echo $_POST['classId'] ?>">
           </div>
         </div>
       </div>
       <div class="panel-body">
         <nav aria-label="...">
          <ul class="pager">
            <li class="previous"><a href="#" id='anterior' ><span aria-hidden="true">&larr;</span> Estudiante Anterior</a></li>
            <li class="next"><a href="#" id='siguiente'>Siguiente Estudiante <span aria-hidden="true">&rarr;</span></a></li>
          </ul>
        </nav>
       </div>
       <hr>

      </form>

<script type="text/javascript">
  //Obtengo la informacion del boton que se apreto
    var itemId;
    var itemClass;
  $("button[name='buttonEstudiante']").on("click",function () {
    console.log(itemId+" <->"+$(this).attr("id"));

    if (itemId != $(this).attr("id")) {
      $("#"+itemId).children("#flecha").removeClass("fa fa-arrow-right");
      $("#"+itemId).removeClass('list-group-item-info')
      $("#"+itemId).addClass(itemClass);

      itemId = $(this).attr('id');
      $("#activeItem").val(itemId);

      $(this).toggleClass('animated pulse');
      $(this).children("#flecha").addClass("fa fa-arrow-right");

      if ($(this).hasClass("list-group-item-danger")) {
        itemClass = 'list-group-item-danger'
        $(this).removeClass('list-group-item-danger')
      }else {
        itemClass = 'list-group-item-success'
        $(this).removeClass('list-group-item-success')
      }
      $(this).addClass('list-group-item-info')

      var idEstudiante1 = $(this).val();
      $("#idEstudiante").val(idEstudiante1);
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
          $("#puntajeHidden").val(respuesta.puntajeObtenido);
          $("input[name='idEstadoTarea']").val(respuesta.idEstadoTarea);

          if (respuesta.puntajeObtenido != 0) {
            $("#asignarPuntaje").html("Reasignar Puntaje")

            $("#asignarPuntaje").removeClass("btn-success")
            $("#asignarPuntaje").addClass("btn-warning")
          }else {
              $("#asignarPuntaje").html("Asignar Puntaje")

              $("#asignarPuntaje").removeClass("btn-warning")
              $("#asignarPuntaje").addClass("btn-success")
          }


        },
        error:function (error,error1,error2) {
          console.log(error2);
        }
      })
    }
  })
  // Puntaje
  function puntaje2() {
    $("#puntajeHidden2").val($("#puntaje").val());
    console.log("pt2 chk");
  }

  //Asignar puntaje
$("#asignarPuntaje").on("click",function () {

  if ($("input[name='puntaje']").val() == 0) {
    $.notify({
      icon: 'glyphicon glyphicon-remove',
      message:"Por Favor, ingrese un puntaje"
    },{
      placement: {
        from: "bottom",
        align: "center"
      },
      animate: {
        enter: 'animated zoomInUp',
        exit: 'animated zoomOutDown'
      },
      delay : 2000,
      type:"danger"
    })
  }else{
    if ($("#puntajeHidden2").val() > $("#puntaje").attr('max')) {
      console.log($("input[id='puntaje']").val()+" <-> "+$("#puntaje").attr('max')+ " comparacion");
      window.alert("Solo puede asignar un puntaje de "+$("#puntaje").attr('max')+" a esta tarea");
    }else {
      if ($("#puntajeHidden").val() != 0) {

        console.log($("input[name='idEstadoTarea']").val());

        $.ajax({
        method:"POST",
        url:"class/scriptReasignarPuntaje.php",
        data:{idEstadoTarea:$("input[name='idEstadoTarea']").val(),puntaje:$("#puntaje").val()},
        success:function (respuesta) {
          console.log(respuesta);
          //Actualizo la lista de Alumnos

          itemClass = "list-group-item-success";

          $.notify({
            icon: 'glyphicon glyphicon-retweet',
            message:"Puntuacion Reasignada"
          },{
            placement: {
          		from: "bottom",
          		align: "center"
          	},
            animate: {
          		enter: 'animated zoomInUp',
          		exit: 'animated zoomOutDown'
          	},
            delay : 1000,
            type:'warning'
          })
        }
      })


      }else {
        var datos = $("form[name='form']").serialize();
        console.log(datos);
        $.ajax({
        method:"POST",
        url:"class/scriptAsignarPuntaje.php",
        data:datos,
        success:function (respuesta) {

          //Actualizo la lista de Alumnos

          itemClass = "list-group-item-success";

          $.notify({
            icon: 'glyphicon glyphicon-ok',
            message:"Puntaje Asignado"
          },{
            placement: {
          		from: "bottom",
          		align: "center"
          	},
            animate: {
          		enter: 'animated zoomInUp',
          		exit: 'animated zoomOutDown'
          	},
            delay : 1000,
            type:'success'
          })
        }
      })
      }
    }
  }
})
  //seleccionar primer elemento
  $(function () {
      $("#1").click();
  })
  //Control de la paginacion


  $("#siguiente").on("click",function (ev) {
    ev.preventDefault();
    var activeItem = parseInt($("#activeItem").val(),10);
    console.log((activeItem+1));
    $("#"+(activeItem+1)).click();
  })

  $("#anterior").on("click",function (ev) {
    ev.preventDefault();
    var activeItem = parseInt($("#activeItem").val(),10);
    console.log((activeItem-1));
    $("#"+(activeItem-1)).click();
  })


</script>

   <?php include_once('layouts/footer.php'); ?>
