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

if(isset($_POST['idTareaEliminar'])){ ?>
  <script type="text/javascript" src="js/jquery.js"></script>

<form action="clases.php" id="formEliminar2" method="post">
  <input type="hidden" id="idTareaEliminar2" name="idTareaEliminar2" value="<?php echo $_POST['idTareaEliminar'] ?>">
</form>

<script type="text/javascript">
var r = confirm("Eliminar Tarea?");
if (r == true) {
  $("#formEliminar2").submit()
} else {
  window.location = "clases.php"
}

</script>
<?php } ?>
<?php include_once('layouts/header.php'); ?>

   <?php include_once('layouts/footer.php'); ?>
