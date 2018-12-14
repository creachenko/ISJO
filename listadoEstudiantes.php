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
if($_SESSION['nivelAcceso'] == 3){
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

    <div class="col-md-7">
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
        <li role="presentation" class="active"><a href="#">Estudiantes</a></li>
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
                  <span>Listado Estudiantes Matriculados</span>
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
                                 </tr>
                                  </thead>
                                  <tbody>


<?php
$CantidadMostrar=25;

//Conexion  al servidor mysql
$conetar = new mysqli("localhost", "root", "", "isjobd");
if ($conetar->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $conetar->connect_errno . ") " . $conetar->connect_error;
}


else{




  // Validado  la variable GET
    $compag =(int)(!isset($_GET['pag'])) ? 1 : $_GET['pag'];
  $TotalReg =$conetar->query("SELECT * FROM estudiantes");
  //Se divide la cantidad de registro de la BD con la cantidad a mostrar
  $TotalRegistro  =ceil($TotalReg->num_rows/$CantidadMostrar);
  //echo "<b>La cantidad de resgistro se dividio a: </b>".$TotalRegistro." para mostrar 5 en 5<br><br>";


  //Consulta SQL
  $consultavistas ="SELECT
            idEstudiante,
            nombreEstudiante,
            apellidoEstudiante,
            identidad,
            correo,
            fechaNacimiento,
            genero,
            direccion,
            telefono
            FROM
            estudiantes
            ORDER BY
            idEstudiante ASC
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


       </tr>";
  }
      echo "</table>";

    /*Sector de Paginacion */

    //Operacion matematica para boton siguiente y atras
  $IncrimentNum =(($compag +1)<=$TotalRegistro)?($compag +1):1;
    $DecrementNum =(($compag -1))<1?1:($compag -1);

  //echo "<ul><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">◀</a></li>";
   echo "<div class='panel-body text-center'><ul class=pagination><li class=\"btn\"><a href=\"?pag=".$DecrementNum."\">&laquo</a></li>";
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
  echo "<li class=\"btn\"><a href=\"?pag=".$IncrimentNum."\">&raquo</a></li></ul></div>";

}



?>

            </tbody>
          </table>

          <div>

</ul>
</div>
    </div>
  </div>
</div>

   <?php
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }
}
else{
   echo '<script>
  alert("No Tienes acceso a esta pagina");
   window.location= "home.php";

  </script>';
}
?>
   <?php include_once('layouts/footer.php'); ?>
