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
include 'layouts/header.php'; ?>

<div class="jumbotron">
<h3>Hola</h3>

<h1>Esta página está en desarrollo</h1>
<a href="reportes.php" class="btn btn-default btn-sm pull-right"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar </a>
<img src="img/col.jpg"  width="1000" height="453">
</div>



                <!-- /.row -->
<?php include 'layouts/footer.php'; ?>
