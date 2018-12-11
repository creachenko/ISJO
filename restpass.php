<?php
require_once("class/funciones.php");
 if (isset($_POST["enviar"])) {
   $tra = new funcionesBD();
   $tra->vertarif($_POST['identidad']);
   }
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
      <h1>Recuperar Contraseña</h1>
      <p>Verificacion de Usuario Registrado </p>
    </div>
       <form method="post" action="verificacion_correcta.php" class="clearfix">
       <div class="form-group">
             <label for="username" class="control-label">Ingrese su numero de Identidad</label>
             <input type="number" class="form-control" name="identidad" placeholder="Identidad">
       </div>
       <div class="form-group">
               <button type="submit" name="enviar"  class="btn btn-info  pull-left">Recuperar</button>
       </div>
       <br><br>
<a href="javascript:window.history.back();">Cancelar</a>
       <br>
       <br>
   </form>
</div>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
