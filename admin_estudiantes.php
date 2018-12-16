<?php
session_start();
require_once "class/funciones.php";
if (isset($_SESSION["ses_id"])) {
  $obj=new funcionesBD();
}else{
  echo '<script>
  alert("Tienes que loguearte");
  window.location= "index.php";
  </script>';
};


$objeto= new funcionesBD();
if (!isset($_GET["id"])OR !is_numeric($_GET["id"])){
  die("ERROR 404");
}
$datos=$objeto->obtener_estudiantes($_GET["id"]);
if(sizeof($datos)==0){
  die("ERROR 404");
}
if(isset($_POST['guardar'])){
  $objeto->editar_estudiante();
  header("location: listadoEstudiantes.php");
}
?>
<?php include_once('layouts/header.php'); ?>


   <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Modificar Estudiante</span>
         </strong>
         <a href="listadoEstudiantes.php" class="btn btn-primary btn-xs pull-right"> Regresar</a>
        </div>

        <div class="panel-body">
          <form method="POST" >
            

  <div class="form-group">
  <input type="text" class="form-control" name="nombre" value="<?php echo $datos[0]['nombreEstudiante'];?>">
            </div>
             
              <div class="form-group">
    <input type="text" class="form-control" name="apellido" value="<?php echo $datos[0]['apellidoEstudiante'];?>">
            </div>

<div class="form-group">
          <input type="numeric" class="form-control" name="identidad" value="<?php echo $datos[0]['identidad'];?>">
            </div>	
             
<div class="form-group">
<input type="text" class="form-control" name="correo" value="<?php echo $datos[0]['correo'];?>">
            </div>

         <div class="form-group">
<input type="date" class="form-control" name="fechaNacimiento" value="<?php echo $datos[0]['fechaNacimiento'];?>">
            </div>
             


          <div class="form-group">
          <label for="status">Genero</label>
            <select class="form-control" name="genero">
     
              <option value=<?php  echo $datos[0]['genero'];?>> 
              </option>
              <option value="Masculino">Masculino</option>
              <option value="Femenino">Femenino</option>
            </select>
        </div>

             
             <div class="form-group">
          <input type="text" class="form-control" name="direccion" value="<?php echo $datos[0]['direccion'];?>">
            </div>

             <div class="form-group">
    <input type="numeric" class="form-control" name="celular" value="<?php echo $datos[0]['telefono'];?>">
            </div>   
          
<input type="hidden" name="id" value="<?php echo $datos[0]['idEstudiante'];?>">
      
            
          
          
            <button type="submit" name="guardar" class="btn btn-primary pull-right">Enviar</button>
          
        </form>
        </div>
      </div>
    </div>
    </div>

  <?php include_once('layouts/footer.php'); ?>
