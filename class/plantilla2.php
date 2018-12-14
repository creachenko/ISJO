<?php
require_once "conexionbd.php";
$conexion = new conexionBD;
$identidad = $_POST['identidadEstudiante'];
//Pregunto en que año estamos
$sql = "SELECT YEAR(CURDATE()) AS anio";
$resp = $conexion->bd->query($sql)->fetch_assoc();
$anio = $resp['anio'];

$sql ="SELECT * FROM estudiantes
       INNER JOIN matricula
       ON estudiantes.idEstudiante = matricula.idEstudiante
       INNER JOIN cursos
       ON matricula.idCurso = cursos.idCurso
       INNER JOIN modalidades
       ON cursos.idModalidad = modalidades.idModalidad
       WHERE identidad = '$identidad'";

$resp = $conexion->bd->query($sql);

$row = mysqli_fetch_assoc($resp);

$idEstudiante = $row['idEstudiante'];

//Pregunto si ya esta matriculado ese aniolectivo

$sql ="SELECT * FROM matricula
        INNER JOIN estudiantes
        ON matricula.idEstudiante = estudiantes.idEstudiante
        INNER JOIN cursos
        ON matricula.idCurso = cursos.idCurso
        INNER JOIN aniolectivo
        ON aniolectivo.idAnioLectivo = cursos.idAnioLectivo
        WHERE anio = '$anio' AND estudiantes.idEstudiante = '$idEstudiante' ";

$resp = $conexion->bd->query($sql);


if ($resp->num_rows > 0) {
  $row2 = $resp->fetch_assoc();?>
  <div class="alert alert-danger" role="alert">Este estudiante ya cuenta con una matricula este año en:<strong> <?php echo $row2['nombreCurso']." - ".$row2['seccion']?></strong></div>
<?php }else{ ?>
  <div class="alert alert-info" role="alert">Estudiante de Reingreso: Escoja un Curso Para Matricularlo</div>

<?php } ?>


<div class="row">
  <div class="col-md-6">
    <label for="">Nombre</label>
    <input type="text" class="form-control" name="nombreEstudiante" id="nombreEstudiante"   value="<?php echo $row['nombreEstudiante'] ?>" disabled>
  </div>
  <div class="col-md-6">
    <label for="">Apellidos</label>
    <input type="text" class="form-control" name="apellidoEstudiante" id="apellidoEstudiante"  value="<?php echo $row['apellidoEstudiante'] ?>" disabled>
  </div>
</div>
<hr>
<div class="row">
  <div class="col-md-4">
    <label>Genero</label>
    <input type="text" class="form-control" name="generoEstudiante" id="generoEstudiante" value="<?php echo $row['genero'] ?>" disabled>
  </div>
  <div class="col-md-4">
    <label>Nacimiento</label>
    <input type="date" class="form-control" name="nacimientoEstudiante" id="nacimientoEstudiante" value="<?php echo $row['fechaNacimiento'] ?>" disabled>
  </div>
  <div class="col-md-4">
    <label>Direccion</label>
    <input type="text" class="form-control" name="direccionEstudiante" id="direccionEstudiante" value="<?php echo $row['direccion'] ?>" disabled>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <label for="">Telefono</label>
    <input type="number" class="form-control" name="telefonoEstudiante" id="telefonoEstudiante" value="<?php echo $row['telefono'] ?>" disabled>
  </div>
  <div class="col-md-6">
    <label>Correo</label>
    <input type="text" class="form-control" name="correoEstudiante" id="correoEstudiante" value="<?php echo $row['correo'] ?>" disabled>
  </div>
</div>
