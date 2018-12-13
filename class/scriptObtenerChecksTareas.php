<?php
require_once "funciones.php";

$obj = new funcionesBD;

$estudiantes = $obj->obtenerEstudiantesPorClase($_POST["idClaseCheckTarea"]);

 $i = 1;
 while ($row = mysqli_fetch_assoc($estudiantes)) { ?>
       <button name="buttonEstudiante" class="list-group-item <?php $check = $obj->revisarSiExisteTarea($row["idEstudiante"],$_POST["checkTarea"]);
                     $rows = $check->num_rows;
                      if ($rows > 0) { ?>
                       <?php echo "list-group-item-success";
                              $icono = "<i class='fa fa-check' aria-hidden='true'></i>";?>
                     <?php }else{ ?>
                       <?php echo "list-group-item-danger" ;
                              $icono = "<i class='fa fa-times-circle-o' aria-hidden='true'></i>";?>
                     <?php }?>" value="<?php echo $row["idEstudiante"] ?>" id="<?php echo $i ?>" >
         <text id="flecha" class=""></text> <?php echo $i.". ".$icono." ".$row["nombreCompleto"]."" ?>
         </button>

<?php $i++;} ?>
