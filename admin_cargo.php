<?php
session_start();
include 'class/funciones.php';
if (isset($_SESSION["ses_id"])) {
  $obj=new funcionesBD();
}else{
  echo '<script>
  alert("Tienes que loguearte");
  window.location= "index.php";+
  </script>';
};

if (!isset($_GET["id"])OR !is_numeric($_GET["id"])){
  die("ERROR 404");
}
$datos=$obj->obtener_cargos($_GET["id"]);
if(sizeof($datos)==0){
  die("ERROR 404");
}
if(isset($_POST['guardar'])){
  $obj->editar_cargos();
  header("location: modificarCargos.php");
}
?>
<?php include_once('layouts/header.php'); ?>


   <div class="row">
    <div class="col-md-10">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Modificar Cargos</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="POST" >


            <div class="form-group">
        <input type="text" class="form-control" name="nombre" value="<?php echo $datos[0]['nombreCargo'];?>">
            </div>

              <div class="form-group">
    <input type="text" class="form-control" name="descripcion" value="<?php echo $datos[0]['descripcion'];?>">
            </div>

<input type="hidden" name="id" value="<?php echo $datos[0]['idCargo'];?>">

            <button type="submit" name="guardar" class="btn btn-primary">Enviar</button>
        </form>
        </div>
      </div>
    </div>
    </div>
  <?php include_once('layouts/footer.php'); ?>
