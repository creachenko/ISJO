<?php
//consulta llenado de cuadro
include 'plantillapdfcuadro.php';
require_once "../class/funciones.php";
$obj=new PDF('l','mm','LETTER');
$obj->AddPage();//agregar pagina

$idClase = $_POST['idClaseReporte1'];

$methods=new funcionesBD();

$estudiantes = $methods->obtenerEstudiantesPorClase($idClase);
$datosClase = $methods->obtenerDatosClaseConId($idClase);

$y=$obj->Gety();
$x=$obj->GetX();
$obj->AliasNbpages();


// lETRAS CON NEGRITA

$obj->setFont('Arial','B','8');

$obj->setxy(20,45);
$obj->cell(45,5,'NOMBRE :',0,0,'c');
$obj->setxy(35,38);
$obj->cell(50,17,strtoupper($datosClase['nombreEmpleado']." ".$datosClase['apellidoEmpleado']),0,0,'C');
$obj->setxy(130,45);
$obj->cell(45,5,'JORNADA :',0,0,'c');
$obj->setxy(153,44);
$obj->cell(45,5,strtoupper($datosClase['jornada']),0,0,'c');
$obj->setxy(190,45);
$obj->cell(50,5,'MODALIDAD :',0,0,'c');
$obj->setxy(213,44);
$obj->cell(45,5,strtoupper($datosClase['nombreModalidad']),0,0,'c');
//LINEAS
$obj->Line(36, 48, 100, 48);

$obj->Line(148, 48, 188, 48);

$obj->Line(211, 48, 250, 48);


//Cabecera de la trabla

$obj->setxy(10,60);
$obj->cell(5,17,'#',1,1,'c');


$obj->setxy(15,60);
$obj->cell(50,17,'NOMBRE',1,0,'C');




$obj->cell(30,17,'IDENTIDAD',1,0,'C');



$obj->setxy(95,60);
$obj->cell(27,7,'PARCIAL I',1,1,'C');


$obj->setxy(135,60);
$obj->cell(27,7,'PARCIAL II',1,1,'C');


$obj->setxy(175,60);
$obj->cell(30,17,'NOTA FINAL',1,1,'C');

$obj->setxy(205,60);
$obj->cell(25,17,'RECUPERACION',1,1,'C');

$obj->setxy(230,60);
$obj->cell(40,17,'OBSERVACIONE',1,0,'C');

$obj->setxy(95,67);
$obj->cell(6,5,'N',1,0,'C');
$obj->setxy(101,67);
$obj->cell(7,5,'N',1,0,'C');
$obj->setxy(108,67);
$obj->cell(7,5,'N',1,0,'C');


$obj->setxy(95,72);
$obj->cell(6,5,'A',1,0,'C');
$obj->setxy(101,72);
$obj->cell(7,5,'E',1,0,'C');
$obj->setxy(108,72);
$obj->cell(7,5,'N',1,0,'C');
$obj->setxy(115,67);
$obj->setFont('Arial','B','6');
$obj->cell(7,10,'TOTAL',1,0,'C');
$obj->setxy(122,60);
$obj->cell(13,17,'Inasi',1,0,'C');


$obj->setFont('Arial','B','8');
$obj->setxy(135,67);
$obj->cell(9,5,'N',1,0,'C');
$obj->setxy(144 ,67);
$obj->cell(9,5,'N',1,0,'C');
$obj->setxy(135,72);
$obj->cell(9,5,'A',1,0,'C');
$obj->setxy(144,72);
$obj->cell(9,5,'E',1,0,'C');
$obj->setFont('Arial','B','6');
$obj->setxy(153,67);
$obj->cell(9,10,'TOTAL',1,0,'C');
$obj->setxy(162,60);
$obj->cell(13,17,'Inasi',1,0,'C');
$cont=0;

//AQUI COOMIENSA EL AUTOINCREMENTABLE
$parciales = $methods->obtenerParcialesConidModalidad($datosClase['idModalidad']);
$j = 0;
while ($row = mysqli_fetch_assoc($parciales)) {
	$array[$j] = $row["idParcialPorModalidad"];
	$j++;
}
$i=22;
while($row = mysqli_fetch_assoc($estudiantes)){

$cont=$cont+1;
  $obj->sety($y+$i);
  $obj->setx($x);
  $obj->cell(5,6,$cont,1,1,'c');

$obj->setFont('Arial','B','9');



  $obj->sety($y+$i);
  $obj->setx($x+5);
  $obj->cell(50,6,$row["nombreCompleto"],1,0,'L');
  $obj->sety($y+$i);
  $obj->setx($x+55);
  $obj->cell(30,6,$row["identidad"],1,0,'C');

  $primerParcial = $methods->obtenerSumaTareasEstudianPorParcialAcumulativa($row["idEstudiante"],$array[0]);
  $segundoParcial = $methods->obtenerSumaTareasEstudianPorParcialAcumulativa($row["idEstudiante"],$array[1]);

  $examen1 =$methods->obtenerSumaTareasEstudianPorParcialExamen($row["idEstudiante"],$array[0]);
  $examen2 = $methods->obtenerSumaTareasEstudianPorParcialExamen($row["idEstudiante"],$array[1]);
  $obj->sety($y+$i);
  $obj->setx($x+85);
  $obj->cell(6,6,$primerParcial,1,0,'C');
  $obj->sety($y+$i);
  $obj->setx($x+91);
  $obj->cell(7,6,$examen1,1,0,'C');
  $obj->sety($y+$i);
  $obj->setx($x+98);
  $obj->cell(7,6,"",1,0,'C');
  $obj->setFont('Arial','B','6');
  $obj->sety($y+$i);
  $obj->setx($x+105);
  $obj->cell(7,6,$primerParcial+$examen1,1,0,'C');
  $obj->sety($y+$i);
  $obj->setx($x+112);
  $obj->cell(13,6,'',1,0,'C');

  $obj->setFont('Arial','B','8');
  $obj->sety($y+$i);
  $obj->setx($x+125);
  $obj->cell(9,6,$segundoParcial,1,0,'C');//Acumulativo IIPacrcial
  $obj->sety($y+$i);
  $obj->setx($x+134);
  $obj->cell(9,6,$examen2,1,0,'C');//Examen IIPacrcial

  $obj->setFont('Arial','B','8');
  $obj->sety($y+$i);
  $obj->setx($x+143);
  $obj->cell(9,6,$segundoParcial+$examen2,1,0,'C');//Total II Parcial
  $obj->sety($y+$i);
  $obj->setx($x+152);
  $obj->cell(13,6,"",1,0,'C');

  $obj->sety($y+$i);
  $obj->setx($x+165);
  $obj->cell(30,6,$segundoParcial+$examen2+$primerParcial+$examen1,1,1,'C');

  $obj->sety($y+$i);
  $obj->setx($x+195);
  $obj->cell(25,6,'-',1,1,'C');

  $obj->sety($y+$i);
  $obj->setx($x+220);
  $obj->cell(40,6,'',1,0,'C');


$i=$i+6;
}




$obj->Output();


?>
