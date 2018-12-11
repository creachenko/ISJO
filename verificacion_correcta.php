<?php
require_once("class/funciones.php");
 if (isset($_POST["enviar"]) AND isset($_POST["idempleado"])) {
   $tra = new funcionesBD();
   $tra->questions($_POST['idempleado']);
   }

   $obj=new funcionesBD();
 $preguntas = $obj->vertarif();


?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf8">
 <title>Ingreso de usuarios </title>
   <script  type="text/javascript" src="js/funciones.js"></script>
</head>
<body>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
   <link rel="stylesheet" href="libs/css/main.css" />
<div class="login-page">
   <div class="text-center">
      <h1>Verificar Empleado</h1>
      <p>Verificacion de Usuario Registrado</p>
    </div>
       <form method="post" action="questions.php" class="clearfix">
       <div class="form-group">
            <?php
            if(mysqli_num_rows($preguntas) > 0){
            while ($row = mysqli_fetch_assoc($preguntas)){
               ?>

                 <label for="username" class="control-label"><h4><?php echo $row["nombreEmpleado"]; ?></h4></label>
                 <label for="username" class="control-label"><h4><?php echo $row["apellidoEmpleado"]; ?></h4></label><br>
                 <label for="username" class="control-label"><?php echo $row["nombreCargo"]; ?></label>
                 <input type="hidden" class="form-control" name="idempleado" value="<?php echo $row["idEmpleado"]; ?>">
                 <hr>
                 <div class="form-group">
                         <button type="submit" name="enviar"  class="btn btn-info  pull-left">Soy yo</button>
                                 <div class="copyRightInfo"></div>
                 </div>

                 <br><br>
  <a href="javascript:window.history.back();">Este no soy yo</a>

                 <br><br>
                                <a href="index.php">Cancelar</a>


            <?php }  }else {

               ?>
            <label for="username" class="control-label"><h4>Este espacio esta disponible solo para el Director.</h4></label>
               Cotacte al Director y solicite que restablezca su contraseña.
                <br>
               <a href="index.php">Aceptar</a>

<?php
            }
                 ?>

       </div>

       <br>
       <br>
   </form>
</div>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
