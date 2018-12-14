<?php
require_once("class/funciones.php");
if (isset($_POST["enviarr"])) {
  $tra = new funcionesBD();
  $tra->verificar_questions($_POST['question1'],$_POST['question2'],$_POST['question3'],$_POST['idEmpleado']);
  }



  $obj=new funcionesBD();
$preguntas = $obj->questions();

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
      <h1>Responda Las Preguntas</h1>
      <p>Verificacion de Respuestas</p>
    </div>
       <form method="post" action="edit_pass.php" class="clearfix">
         <?php    while ($row = mysqli_fetch_assoc($preguntas)){ ?>
       <div class="form-group">
           <label for="Password" class="control-label">1. ¿<?php echo $row['pregunta1'] ?>?</label>
           <input type="text" name= "question1" class="form-control" placeholder="Respuesta">
           <br>
           <label for="Password" class="control-label">2. ¿<?php echo $row['pregunta2'] ?>?</label>
           <input type="text" name= "question2" class="form-control" placeholder="Respuesta">
           <br>
           <label for="Password" class="control-label">3. ¿<?php echo $row['pregunta3'] ?>?</label>
           <input type="text" name= "question3" class="form-control" placeholder="Respuesta">
           <p>
           <label for="Password" class="control-label">3. ¿<?php echo $row['idEmpleado'] ?>?</label>
             <?php } ?>
       <div class="form-group">
               <button type="submit" name="enviarr"  class="btn btn-info  pull-left">Responder</button>
       </div>
       <br><br>
                      <a href="index.php">Cancelar</a>
       <br>
       <br>
   </form>
</div>
<?php include_once('layouts/footer.php'); ?>
</body>
</html>
