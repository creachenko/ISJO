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

//hasta aqui es la parte del logueo//
if (isset($_POST['guardar'])){

echo "<script>console.log('Apretado')</script>";

$obj->insertarEncargado($_POST['nombre'],$_POST['apellido'],$_POST['telefono'],$_POST['genero'],$_POST['identidadEncargado'],$_POST['correo'],$_POST['profesion'],$_POST['direccion']);
  $notifyVerification=["Registro Exitoso: ".$_POST['nombre'].$_POST['apellido'],'success'];
}

//aqui termina la validacion del post
$estudiantes = $obj->obtenerEstudiantes();
?>
<!--aqui empieza  el header-->

<?php include_once('layouts/header.php'); ?>

<div class="row">
  <h1 class="page-header">
      Listado Estudiantes </h1>

    <div class="col-md-6">
         <ol class="breadcrumb">
            <li><i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li><i class="fa fa-barcode" aria-hidden="true"></i> Estudiantes
            </li>
            <li class="active"><i class="fa fa-barcode" aria-hidden="true"></i> Listado Estudiantes
            </li>
             <a href="iniciarMatricula.php" class="btn btn-primary btn-xs pull-right">Matricular
             Alumno</a>

           </ol>
    </div>
    <div class="col-md-5">
      <ul class="nav nav-tabs">
        <li role="presentation" ><a href="listadoEstudiantes.php">Estudiantes</a></li>
        <li role="presentation" class="active"><a href="listadoMatricula.php">Matricula</a></li>
        <li role="presentation"><a href="modificarEncargados.php">Padres de Familia</a></li>
      </ul>
    </div>
        </div>




          <div class="row">
            <div class="col-md-12">
             <div class="panel panel-primary">
              <div class="panel-heading">
               <strong>
                 <span class="glyphicon glyphicon-pencil"></span>
                  <span>Listado Estudiantes Matriculados en el <?php echo date("Y"); ?></span>
                 </strong>
                     </div>
                       <table class="table" id="">
                          <thead>
                           <tr>
                            <th class="text-left" >#</th>
                              <th class="text-left" >Nombres</th>
                               <th class="text-left" >Apellidos</th>
                                <th class="text-left" >Identidad</th>
                                 <th class="text-left">Correo</th>
                                 <th class="text-left">Fecha Nacimiento</th>
                                  <th class="text-left">Genero</th>
                                   <th class="text-left">Direccion</th>
                                    <th class="text-left">Telefono</th>
                                    <th class="text-left">editar</th>
                                    <th class="text-left">Eliminar</th>




                                 </tr>

                                  </thead>

                                  <tbody>


<?php
$CantidadMostrar=10;

//Conexion  al servidor mysql
$conetar = new mysqli("localhost", "root", "", "isjobd");
if ($conetar->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
}


else{




  // Validado  la variable GET
    $compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
  $TotalReg =$conetar->query("SELECT estudiantes.idEstudiante,nombreEstudiante,apellidoEstudiante,identidad,nombreCurso,seccion FROM estudiantes
                              INNER JOIN matricula
                              ON estudiantes.idEstudiante = matricula.idEstudiante
                              INNER JOIN cursos
                              ON cursos.idCurso = matricula.idCurso
                              INNER JOIN aniolectivo
                              ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
                              WHERE anio = YEAR(CURDATE())");
  //Se divide la cantidad de registro de la BD con la cantidad a mostrar
  if ($TotalReg->num_rows == 0) {
    $dia = date("Y");

    echo "<h1 style='color:red'>No hay Estudiantes Matriculados en el ".$dia."</h1>";
  }
  $TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
  //echo "<b>La cantidad de resgistro se dividio a: </b>".$TotalRegistro." para mostrar 5 en 5<br><br>";


  //Consulta SQL
  $consultavistas ="SELECT estudiantes.idEstudiante,
                              nombreEstudiante,
                              apellidoEstudiante,
                              identidad,
                              correo,
                              fechaNacimiento,
                              genero,
                              direccion,
                              telefono FROM estudiantes
                              INNER JOIN matricula
                              ON estudiantes.idEstudiante = matricula.idEstudiante
                              INNER JOIN cursos
                              ON cursos.idCurso = matricula.idCurso
                              INNER JOIN aniolectivo
                              ON cursos.idAnioLectivo = aniolectivo.idAnioLectivo
                              WHERE anio = YEAR(CURDATE())
                              ORDER BY
                              estudiantes.idEstudiante ASC
                              LIMIT ".(($compag-1)*$CantidadMostrar)." , ".$CantidadMostrar;
                       // echo $consultavistas;
  $consulta=$conetar->query($consultavistas);




/* echo "<table>"
 <tr>
 <th>idEstudiante</th>
 <th>nombreEstudiante</th>
 <th>apellidoEstudiante</th>
 </tr>";*/
  while ($lista=$consulta->fetch_row()) {
       echo "<tr>
       <td>".$lista[0]."</td>
       <td>".$lista[1]."</td>
       <td>".$lista[2]."</td>
       <td>".$lista[3]."</td>
       <td>".$lista[4]."</td>
       <td>".$lista[5]."</td>
       <td>".$lista[6]."</td>
       <td>".$lista[7]."</td>
       <td>".$lista[8]."</td>
       <td><a href='admin_estudiantes.php?id=$lista[0]' class='btn btn-xs btn-info' data-toggle='tooltip' title='Editar'>
         <span class='glyphicon glyphicon-edit'></span>
         </a></td>
      <td>

      <a href='eliminar_estudiantes.php?id=$lista[0]'  class='btn btn-xs btn-danger' data-toggle='tooltip' title='Eliminar'>
        <span class='glyphicon glyphicon-trash'></span>
                        </a>
      </td

       </tr>";
  }

      echo "</table>";


    /*Sector de Paginacion */

    //Operacion matematica para boton siguiente y atras
  $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
    $DecrementNum =(($compag -1))<1?1:($compag -1);

  //echo "<ul><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">◀</a></li>";
   echo "<ul class=pagination><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">&laquo</a></li>";
    //Se resta y suma con el numero de pag actual con el cantidad de
    //numeros  a mostrar
     $Desde=$compag-(ceil($CantidadMostrar/2)-1);
     $Hasta=$compag+(ceil($CantidadMostrar/2)-1);

     //Se valida
     $Desde=($Desde<1)?1: $Desde;
     $Hasta=($Hasta<$CantidadMostrar)?$CantidadMostrar:$Hasta;
     //Se muestra los numeros de paginas
     for($i=$Desde; $i<=$Hasta;$i++){
      //Se valida la paginacion total
      //de registros
      if($i<=$TotalRegistro){
        //Validamos la pag activo
        if($i==$compag){
           echo "<li class=\"active\"><a href=\"?pag=".$i."\">".$i."</a></li>";
        }else {
          echo "<li><a href=\"?pag=".$i."\">".$i."</a></li>";
        }
      }
     }
  echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\">&raquo</a></li></ul>";

}


?>



          </table>
  </tbody>


          <div>

</ul>
</div>
    </div>
  </div>
</div>






   <!--aqui empiza la funcion script de java-->
   <script type="text/javascript">
   function comprobarIdentidad() {
     $.ajax({
       method:"POST",
       url:"class/ck-scriptComprobarIdentidadEncargado.php",
       data:{identidad: $("#identidadEncargado").val()},
       success:function (respuesta) {
         console.log(respuesta);
         if (respuesta > 0) {
           $("#editarEncargadoConfirmado").attr("disabled","disabled");

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
           $("#editarEncargadoConfirmado").removeAttr("disabled");
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

   $("button[name='eliminarEncargado']").click(function (even) {
     var idEncargado = $(this).val();
     var botonPresionado = $(this);
      bootbox.confirm({
      title: "Confirmacion",
      message: "Desea eliminar este registro?, <strong>Advertencia:</strong> Los registros de los estudiantes que tuviere este Padre de Familia/Encargado seran eliminados (Notas,cuadros,datos Personales etc).",
      buttons: {
          cancel: {
              label: '<i class="fa fa-times"></i> Cancelar'
          },
          confirm: {
              label: '<i class="fa fa-check"></i> Eliminar',
              className: 'btn-danger'
          }
      },
      callback: function (result) {
          if (result == true) {
            botonPresionado.attr("type","submit");
            botonPresionado.attr("name","eliminarEncargadoConfirmado");

          $("button[name='eliminarEncargadoConfirmado']").click();
          }else {
            console.log("aca");
          }
      }
    });

   })


   $("button[name='editarEncargado']").on("click",function () {
     var idEncargadoBoton = $(this).val();

     $.ajax({
       method:'POST',
       data: {idEncargado: idEncargadoBoton},
       url:"class/ck-scriptObtenerEncargados.php",
       dataType:'json',
       success:function (respuesta) {
         console.log(respuesta);
         var encargado = respuesta
         $("#nuevoNombreEncargado").val(encargado.nombreEncargado);
         $("#nuevoApellidoEncargado").val(encargado.apellidoEncargado);
         $("#telefono").val(encargado.telefono)
         $("#identidadEncargado").val(encargado.identidad);
         $("#buttonGenero").val(encargado.genero);
         $("#buttonGenero").html(encargado.genero);
         $("input[name='nuevoGeneroEncargado").val(encargado.genero);
         $("#direccionEncargado").val(encargado.direccion)
         $("#profesion").val(encargado.profesion);
         $("#correo").val(encargado.correo);
         $("#editarEncargadoConfirmado").val(encargado.idEncargado);

         $("#indentidadMatch").val(encargado.identidad);

         // $("#nuevoNombreEmpleado").val("1")
       }
     })
   })
   $("#buttonGenero").on("click",function () {

     if ($(this).html() == "Femenino") {
       $(this).html("Masculino")
       $("input[name='nuevoGeneroEncargado").val("Masculino")
     }else {
       $(this).html("Femenino")
       $("input[name='nuevoGeneroEncargado").val("Femenino")
     }
   })

   $("button[id='dropdownCargo']").on("click",function () {
     $("input[name='idCargoEmpleado']").val($(this).val());
     $("#buttonCargo").html($(this).html());
   })
   </script>
   <!--aqui termina el script de java -->






   <?php
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }?>
   <?php include_once('layouts/footer.php'); ?>
