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
if($_SESSION['nivelAcceso'] == 3){
//Escucho si se quiere eliminar una modalidad, de ser asi la Eliminado
if (isset($_POST['eliminarModalidadConfirmado'])) {
  
  $obj->eliminarModalidad($_POST['eliminarModalidadConfirmado']);
}
if (isset($_POST['editarNewModalidad'])) {

  $obj->editarModalidad($_POST['editarNewModalidad'],$_POST['nombreNewModalidad'],$_POST['jornadaNewModalidad']);

}




$modalidades = $obj->obtenerModalidades();
$totalModalidades = mysqli_num_rows($obj->obtenerModalidades());


?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Modificar Modalidades
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
            </li>
            <li>
                <i class="fa fa-barcode" aria-hidden="true"></i> Cursos
            </li>
            <li class="active">
                <i class="fa fa-pencil" aria-hidden="true"></i> Modalidades
            </li>

            <a href="insertarModalidad.php" class="btn btn-primary btn-xs pull-right">+ Insertar Modalidad</a>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-pencil"></span>
          <span>Lista de Modalidades</span>
       </strong>
      </div>
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th class="text-center" style="width: 100px;">nombre</th>
                    <th class="text-center" style="width: 100px;">jornada</th>
                    <th class="text-center" style="width: 100px;">parciales</th>
                    <th class="text-center" style="width: 100px;">Acciones</th>

                </tr>
            </thead>
            <tbody>
              <?php
              if ($totalModalidades == 0) {
                echo "Nada Para Mostrar, dirijase a <a href='insertarModalidad.php'>Ingresar Modalidades</a>";
              }

               while ($row = mysqli_fetch_assoc($modalidades)){ ?>
                <tr>
                    <td class="text-center"><?php echo $row['idModalidad']; ?></td>
                    <td class="text-center"><?php echo $row['nombreModalidad']; ?></td>
                    <td class="text-center"><?php echo $row['jornada']; ?></td>
                    <td class="text-center"><?php echo $row['parciales']; ?></td>
                    <td class="text-center">
                      <form action="" method="post">

                        <div class='btn-group btn-group-sm'>
                          <button name='eliminarModalidad' class='btn btn-danger' value="<?php echo $row['idModalidad']; ?>" title='Eliminar Modalidad'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></button>
                          <button name='editarModalidad' type="button" value="<?php echo $row['idModalidad']; ?>"  class='btn btn-warning' title='Editar Modalidad' data-toggle="modal" data-target="#modalEditarModalidad"><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></button>
                        </div>
                      </form>
                    </td>

                </tr>
              <?php }; ?>
            </tbody>
          </table>

    </div>
  </div>
</div>
<form  action="" method="post">

<div id="modalEditarModalidad" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Modalidad</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label>Nombre Modalidad</label>
            <input type="text" name="nombreNewModalidad" class="form-control" required value="">
          </div>
          <div class="col-md-6">
            <label>Jornada</label>
            <input type="text" name="jornadaNewModalidad" class="form-control" required value="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="editarNewModalidad" class="btn btn-success" >Aceptar</button>
      </div>
    </div>

  </div>
</div>

</form>

   <script type="text/javascript">
   $("button[name='editarModalidad']").on("click",function () {
     $("button[name='nombreNewModalidad']").attr("require","required")
     $("button[name='jornadaNewModalidad']").attr("require","required")
     $("button[name='editarNewModalidad']").val($(this).val());
   })


   var vecesApretadoConfirmarEliminarModalidad = 0;
   $("button[name='eliminarModalidad']").click(function (even) {

     if (vecesApretadoConfirmarEliminarModalidad == 0) {
       even.preventDefault();
       console.log('apretaste '+ $(this).val());
       $(this).html('Eliminar?');
       $(this).attr('name','eliminarModalidadConfirmado')
       $(this).attr('type','submit')
       vecesApretadoConfirmarEliminarModalidad = vecesApretadoConfirmarEliminarModalidad + 1;
     }else {
       $("button[name='nombreNewModalidad']").removeAttr("require")
       $("button[name='jornadaNewModalidad']").removeAttr("require")

       console.log('Eliminar confirmado');
     }

   })
   </script>
<?php }else{
   echo '<script>
  alert("No Tienes acceso a esta pagina");
   window.location= "home.php";

  </script>';
}include_once('layouts/footer.php'); ?>
