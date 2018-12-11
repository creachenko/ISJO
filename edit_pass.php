<?php
require_once("class/funciones.php");
if (isset($_POST["enviar"])) {
  $tra = new funcionesBD();
  $tra->edit_pass($_POST['pass1'],$_POST['pass2'],$_POST['idempleado']);
  }

  $obj=new funcionesBD();
$preguntas = $obj->verificar_questions();

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf8">
 <title>Nueva Contraseña</title>
   <script  type="text/javascript" src="js/funciones.js"></script>
</head>
<body>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
   <link rel="stylesheet" href="libs/css/main.css" />
<div class="login-page">
   <div class="text-center">
      <h1>Cambiar Contraseña</h1>
      <p>Verificacion de Usuario Registrado</p>
    </div>
       <form method="post" action="" class="clearfix">
       <div class="form-group">
            <?php
            if(mysqli_num_rows($preguntas) > 0){
            while ($row = mysqli_fetch_assoc($preguntas)){
               ?>
     <label for="Password" class="control-label">Escriba su nueva contraseña</label>
                 <input type="password" class="form-control" name="pass1" value="" placeholder="Contraseña"><br>
     <label for="Password" class="control-label">Escriba otra vez su nueva contraseña</label>
                 <input type="password" class="form-control" name="pass2" value="" placeholder="Verificar Contraseña">
                 <input type="hidden" class="form-control" name="idempleado" value="<?php echo $row["idEmpleado"]; ?>">
                 <hr>
                 <div class="form-group">
                         <button type="submit" name="enviar"  class="btn btn-info  pull-left">Cambiar</button>
                                 <div class="copyRightInfo"></div>
                 </div>

                 <br><br>
                                <a href="index.php">Cancelar</a>


            <?php }  }else {

               ?>
            <label for="username" class="control-label"><h4>Las respuesas no son correctas.</h4></label>
                <br>
               <a href="javascript:window.history.back();">Intentar otra vez</a>

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
