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
if (isset($_POST['guardarNuevoUsuario'])) {
    $obj->guardarNusuario($_POST['guardarNuevoUsuario'], md5($_POST['nuevaContrasenaUsuario']));

  $notifyVerification = ["Contraseña Actualizada con Exito: <strong>".$_POST['nuevaContrasenaUsuario']."</strong>",'info']; // Muestro notificacion de exito
}
$empleados = $obj->editarmiusuario();


?>
<?php include_once('layouts/header.php'); ?>
<h1 class="page-header">
    Perfil del Empleado
</h1>
<div class="row">
    <div class="col-md-8">

        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-briefcase" aria-hidden="true"></i> Perfil
            </li>
            <li class="active">
                <i class="fa fa-briefcase" aria-hidden="true"></i> Editar Perfil
            </li><?php while ($row = mysqli_fetch_assoc($empleados)){ ?>
            <button name='editarUsuario' type="button" value="<?php echo $row['idUsuario']; ?>" data-toggle='modal' data-target='#modalEditarUsuario' class="btn btn-primary btn-sm pull-right" title='Editar Usuario' >
            <span class='glyphicon glyphicon-pencil' aria-hidden='true' >Editar U</span></button>
                        </ol>
    </div>
      <div class="col-md-4">
      <ul class="nav nav-tabs">
        <li role="presentation" ><a href="perfil.php">Perfil Empleados</a></li>
        <li role="presentation"  class="active"><a href="editarMiUsuario.php">Usuario del Empleado</a></li>
      </ul>
    </div>
</div>
<form action="#" method="post">
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Usuario</span>
       </strong>
      </div>
        <div class="panel-body">
       <ul class="nav nav-pills nav-stacked">
   
            <li role="presentation"><a href="#"> <strong>Nombre de Usuario:</strong> 
            <text class="pull-right"> <i><?php echo $row['nombreUsuario']; ?></i> </text></a></li>
            <li role="presentation"><a href="#"><strong>Contraseña:</strong> 
            <text class="pull-right" ><i>------</i></text></a></li>
            <?php }; ?>
           </ul>
         
       </div>
    </div>
  </div>
</div>

<div id="modalEditarUsuario" class="modal fade" role="dialog">
<div class="modal-dialog modal-lg">

<!-- Modal content-->
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Editar el Usuario del Empleado</h4>
  </div>
  <div class="modal-body">
    <div class="row">
      
      <div class="col-md-3">
          <label for="">Nombre Usuario</label>
          <input type="text" name="nuevoNombreUsuario" id="nuevoNombreUsuario" class="form-control" value="" disabled="">
      </div>
      <div class="col-md-3">
          <label for="">Contraseña</label>
          <input type="text" name="nuevaContrasenaUsuario" id="nuevaContrasenaUsuario" class="form-control" value="">
      </div>
    
     
<hr>
  <div class="modal-footer">
    <button type="submit" name="guardarNuevoUsuario" class="btn btn-success" id="idUsuario" value="<?php echo $_SESSION['idUser'] ?>" >Aceptar</button>
    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
  </div>
</div>

</div>
</div> 
</form>
<script type="text/javascript">
   $("button[name='editarUsuario']").on("click",function () {
     $.ajax({
       method:'POST',
       data: {idUsuario: $(this).val()},
       url:"class/scriptObtenerUsuario.php",
       dataType:'json',
       success:function (respuesta) {
         // console.log(respuesta);
         var Usuario = respuesta

         $("#nuevoNombreUsuario").val(Usuario.nombreUsuario);
        
        
         // $("#nuevoNombreEmpleado").val("1")
       }
     })
   })
   </script>
   <?php
   if (isset($notifyVerification)) {
     echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
   }?>
   <?php include_once('layouts/footer.php'); ?>
