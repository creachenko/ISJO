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
if (isset($_POST['guardar'])){
  $obj= new funcionesBD();

    $idModalidad = $obj->insertarModalidad($_POST['nombreModalidad'],$_POST['jornadaModalidad']);

    for ($i= 1; $i <= $_POST['parcialesModalidad'] ; $i++) {
      $j = $i;
       $obj->insertarParcialesPorModalidad($_POST['nombreParcial'.$j],$_POST['selectDesde'.$j],$_POST['selectHasta'.$j],$idModalidad);
    }

    $notifyVerification = ['Modalidad <strong>'.$_POST['nombreModalidad']."</strong> creada con exito",'success'];

}

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

            <a href="ck-modificarModalidades.php" class="btn btn-default btn-xs pull-right">Regresar</a>
        </ol>
    </div>
</div>
   <div class="row">
     <form method="post" action="">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Ingresar Modalidad</span>
           </strong>
          </div>
          <div class="panel-body">

              <div class="row">
                <div class="col-md-12">
                  <label for="status">Nombre</label>
                  <input type="text" class="form-control" name="nombreModalidad" id="nombre" placeholder="Nombre Modalidad" required>
                </div>
              </div>
          </div>
          <div class="panel-body">
              <div class="row">
                <div class="col-md-6">
                  <label for="status">Jornada</label>
                  <input type="text" class="form-control" name="jornadaModalidad" id="jornada" placeholder="Jornada" required>
                </div>
                <div class="col-md-6">
                  <label for="status">Cantidad de Parciales</label>
                  <input type="number" name="parcialesModalidad" class="form-control" id="cantParciales">
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-md-12">
                  <button type="button" id="botonConfirmarParciales" class="btn btn-success btn-block" data-toggle='modal' data-target='#modalConfirmarParciales' disabled>Enviar</button>
                </div>
              </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <div id="modalConfirmarParciales" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Rango Parciales</h4>
              <small>Defina los meses que comprenden los parciales</small>
            </div>
            <table class="table text-center">
              <thead>
                <tr>
                  <th>Parcial</th>
                  <th>Nombre Parcial</th>
                  <th>Desde</th>
                  <th>Hasta</th>
                </tr>
              </thead>
              <tbody id="tbodyParciales"></tbody>
            </table>
            <div class="panel-body">
              <button type="submit" name="guardar" class="btn btn-success btn-block">Guardar Modalidad</button>
            </div>
            <div class="modal-footer">
              <i class="material-icons pull-left">help</i><small class="text-muted pull-left">Nombre Parcial: campo que figurara en los cuadros de los maestro P.j Primer Parcial, Segundo Parcial, Primer Trismestre etc.</small class="text-muted pull-left">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
          </div>

        </div>
      </div>
    </form>
    </div>

    <script type="text/javascript">
    var desbloqueoBoton = 0;

    $("#nombre").on('change',function () {
      if($(this).val() != ""){
        desbloqueoBoton = desbloqueoBoton+1;
      }else {
        desbloqueoBoton = desbloqueoBoton-1;
      }
      console.log(desbloqueoBoton);
      if (desbloqueoBoton >= 3) {
        $("#botonConfirmarParciales").removeAttr('disabled')
      }else{
        $("#botonConfirmarParciales").attr('disabled','')
      }
    })

    $("#jornada").on('change',function () {
      if($(this).val() != ""){
        desbloqueoBoton = desbloqueoBoton+1;
      }else {
        desbloqueoBoton = desbloqueoBoton-1;
      }
      console.log(desbloqueoBoton);
      if (desbloqueoBoton >= 3) {
        $("#botonConfirmarParciales").removeAttr('disabled')
      }else {
        $("#botonConfirmarParciales").attr('disabled','')
      }
    })


    $("#cantParciales").on('change',function () {
      if($(this).val() != "" && $(this).val() != 0){
        desbloqueoBoton = desbloqueoBoton+1;
      }else {
        desbloqueoBoton = desbloqueoBoton-1;
      }

      console.log(desbloqueoBoton);
      if (desbloqueoBoton >= 3) {
        $("#botonConfirmarParciales").removeAttr('disabled')
      }else{
        $("#botonConfirmarParciales").attr('disabled','')
      }
    })
    //--------------------------------------------------------------
      $("#cantParciales").on('change',function () {
        var plantilla = "<tr id='trParcial'>"+
          "<td> <p>:parcial:</p> </td>"+
          "<td> <input type='text' name='nombreParcial:parcial:' class='form-control'> </td>"+
          "<td>"+
            "<select class='form-control' name='selectDesde:parcial:' id='selectDesde'>"+
              "<option value='0000-01-00' id='desdeEnero'>Enero</option>"+
              "<option value='0000-02-00' id='desdeFebrero'>Febrero</option>"+
              "<option value='0000-03-00' id='desdeMarzo'>Marzo</option>"+
              "<option value='0000-04-00' id='desdeAbril'>Abril</option>"+
              "<option value='0000-05-00' id='desdeMayo'>Mayo</option>"+
              "<option value='0000-06-00' id='desdeJunio'>Junio</option>"+
              "<option value='0000-07-00' id='desdeJulio'>Julio</option>"+
              "<option value='0000-08-00' id='desdeAgosto'>Agosto</option>"+
              "<option value='0000-09-00' id='desdeSeptiembre'>Septiembre</option>"+
              "<option value='0000-10-00' id='desdeOctubre'>Octubre</option>"+
              "<option value='0000-11-00' id='desdeNoviembre'>Noviembre</option>"+
              "<option value='0000-12-00' id='desdeDiciembre'>Diciembre</option>"+
            "</select>"+
          "</td>"+
          "<td>"+
            "<select class='form-control' name='selectHasta:parcial:' id='selectHasta'>"+
              "<option value='0000-01-00' id='hastaEnero'>Enero</option>"+
              "<option value='0000-02-00' id='hastaFebrero'>Febrero</option>"+
              "<option value='0000-03-00' id='hastaMarzo'>Marzo</option>"+
              "<option value='0000-04-00' id='hastaAbril'>Abril</option>"+
              "<option value='0000-05-00' id='hastaMayo'>Mayo</option>"+
              "<option value='0000-06-00' id='hastaJunio'>Junio</option>"+
              "<option value='0000-07-00' id='hastaJulio'>Julio</option>"+
              "<option value='0000-08-00' id='hastaAgosto'>Agosto</option>"+
              "<option value='0000-09-00' id='hastaSeptiembre'>Septiembre</option>"+
              "<option value='0000-10-00' id='hastaOctubre'>Octubre</option>"+
              "<option value='0000-11-00' id='hastaNoviembre'>Noviembre</option>"+
              "<option value='0000-12-00' id='hastaDiciembre'>Diciembre</option>"+
            "</select>"+
          "</td>"+
        "</tr>";

        if ($("#tbodyParciales").html() == "") {
          console.log("Positivo");
          $("#tbodyParciales").append(plantilla.replace(/:parcial:/g,1));
        }else {
          console.log("Negativo");
          $("tr[id='trParcial']").remove();
          for (var i = 0; i < $("#cantParciales").val(); i++) {
            $("#tbodyParciales").append(plantilla.replace(/:parcial:/g,i+1));
          }
        }

      })
      //Verificacion de meses

    </script>
  <?php
  if (isset($notifyVerification)) {
    echo $obj->notify($notifyVerification[0],$notifyVerification[1]);
  }
  include_once('layouts/footer.php'); ?>
