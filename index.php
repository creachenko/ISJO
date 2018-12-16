 <?php
require_once("class/funciones.php");
  if (isset($_POST["enviar"])) {
    $tra = new funcionesBD();
    $tra->logueo2($_POST['nombre'],$_POST['contrasena']);
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
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
<div class="login-page">
    <div class="text-center">
       <h1>Bienvenido</h1>
       <p>Iniciar sesión </p>
     </div>
        <form method="post" action="" class="clearfix">
        <div class="form-group">
              <label for="username" class="control-label">Usuario</label>
              <input type="name" class="form-control" name="nombre" placeholder="Usario">
        </div>
        <div class="form-group">
            <label for="Password" class="control-label">Contraseña</label>
            <input type="password" name= "contrasena" class="form-control" placeholder="Contraseña">
        </div>
        <div class="copyRightInfo"><a href="restpass.php">Olvide mi contraseña</a></div>
        <p>
         <div class="copyRightInfo">Copyright &copy; 2018 <br/>Proyecto Ucenm. <br/>Derechos Reservados.</div>
          <br>
        <div class="form-group">
                <button type="submit" name="enviar"  class="btn btn-info  pull-left">Login</button>
        </div>
        <br>
        <br>
        <div class="form-group">
                <button type="submit"><a href="nuevoUsuario.php" class="btn btn-danger  pull-right">Registrar</a></button>
    </div>
    </form>
</div>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
