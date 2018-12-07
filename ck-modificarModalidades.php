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
//Escucho si se quiere eliminar una modalidad, de ser asi la Eliminado
if (isset($_POST['eliminarModalidadConfirmado'])) {
  $obj->eliminarModalidad($_POST['eliminarModalidadConfirmado']);
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

            <a href="ck-insertarModalidad.php" class="btn btn-primary btn-xs pull-right">+ Insertar Modalidad</a>
        </ol>
    </div>
</div>
<form action="#" method="post">
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
                echo "Nada Para Mostrar, dirijase a <a href='ck-insertarModalidad.php'>Ingresar Modalidades</a>";
              }

               while ($row = mysqli_fetch_assoc($modalidades)){ ?>
                <tr>
                    <td class="text-center"><?php echo $row['idModalidad']; ?></td>
                    <td class="text-center"><?php echo $row['nombreModalidad']; ?></td>
                    <td class="text-center"><?php echo $row['jornada']; ?></td>
                    <td class="text-center"><?php echo $row['parciales']; ?></td>
                    <td class="text-center">
                        <div class='btn-group btn-group-sm'>
                          <button name='eliminarModalidad' class='btn btn-danger' value="<?php echo $row['idModalidad']; ?>" title='Eliminar Modalidad'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span></button>
                          <button name='editarModalidad'  class='btn btn-warning' title='Editar Modalidad'><span class='glyphicon glyphicon-pencil' aria-hidden='true' ></span></button>
                        </div>
                    </td>

                </tr>
              <?php }; ?>
            </tbody>
          </table>

    </div>
  </div>
</div>
</form>

   <script type="text/javascript">
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
       console.log('Eliminar confirmado');
     }

   })
   </script>
   <?php include_once('layouts/footer.php'); ?>
