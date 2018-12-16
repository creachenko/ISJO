<?php
include 'plantillapdfcalificaciones.php';
require_once "class/funciones.php";
$obj=new PDF('l','mm','LETTER');
$obj->AddPage();//agregar pagina
$ob=new funcionesBD();

$estudiante = $ob->report();
$dia = date("Y");
$info = $ob->infoc();//Cabecera
$infor = mysqli_fetch_assoc($info);

$y=$obj->Gety();
$x=$obj->GetX();
$obj->AliasNbpages();

		$obj->setFont('Arial','B','8');
		$obj->cell(50);
		$obj->setxy(119,5);
		$obj->cell(45,5,'REPUBLICA DE HONDURAS',0,1,'c');

		$obj->cell(50);
		$obj->setxy(118,10);
		$obj->cell(48,5,'SECRETARIA DE EDUCACION',0,1,'c');
		$obj->setxy(106,15);

		$obj->cell(75,5,'DIRECCION DEPARTAMENTAL DE EDUCACION',0,1,'l');
		$obj->setxy(113,20);

		$obj->cell(57,5,'CUADRO DE CALIFICACIONES No.1',0,1,'c');

		$obj->setxy(110,30);

		$obj->cell(57,5,$infor['codigoCentro'],0,1,'c');

		$obj->setxy(132,30);
		$obj->cell(57,5,$infor['nombreColegio'] ,0,1,'c');
			$obj->setxy(130,30);
		$obj->cell(57,5,'|',0,1,'c');
		$obj->setFont('Arial','','5	');
				$obj->setxy(90,33);
		$obj->cell(57,5,$infor['direccion'] ,0,1,'c');
		$obj->ln(20);
// lETRAS CON NEGRITA
$obj->setFont('Arial','B','8');
$obj->cell(50);
$obj->setxy(10,40);
$obj->cell(45,5,'ANIO :',0,0,'c');
$obj->setxy(10,45);
$obj->cell(45,5,'CURSO :',0,0,'c');
$obj->setxy(100,45);
$obj->cell(45,5,'MODALIDAD:',0,0,'c');
$obj->setxy(100,50);
$obj->cell(45,5,'JORNADA :',0,0,'c');
$obj->setxy(230,50);
$obj->cell(45,5,'SECCION :',0,0,'c');

$obj->setxy(10,50);
$obj->cell(45,5,'CATEDRATICO :',0,0,'c');

//LETRAS SIN NEGRITA
$obj->setFont('Arial','',8);
$obj->setxy(35,40);
$obj->cell(50,5,'PERIODO  '.$dia,0,1,'c');
$obj->setxy(35,45);
$obj->cell(50,5,'SEPIMO GRADO',0,1,'c');
$obj->setxy(35,50);
$obj->cell(50,5,'LUIS SANTIAGO',0,1,'c');
$obj->setxy(120,45);
$obj->cell(50,5,'TERCERO CICLO COMUN',0,1,'c');
$obj->setxy(120,50);
$obj->cell(50,5,'JORNADA VESPERTINA',0,1,'c');
$obj->setxy(246,50);
$obj->cell(50,5,'A',0,1,'c');

//Cabecera de la trabla

$obj->setxy(10,60);
$obj->cell(5,20,'#',1,1,'c');


$obj->setxy(15,60);
$obj->cell(50,20,'NOMBRE',1,0,'C');

$obj->cell(30,20,'IDENTIDAD',1,0,'C');

$obj->cell(135,5,'CIENTCIAS NATURALES',1,0,'C');

$obj->setxy(95,65);
$obj->cell(20,7,'PARCIAL I',1,1,'C');

$obj->setxy(115,65);
$obj->cell(20,7,'PARCIAL II',1,1,'C');


$obj->setxy(135,65);
$obj->cell(20,7,'PARCIAL III',1,1,'C');

$obj->setxy(155,65);
$obj->cell(20,7,'PARCIAL IV',1,1,'C');

$obj->setxy(175,65);
$obj->cell(30,15,'RECUPERACION',1,1,'C');

$obj->setxy(205,65);
$obj->cell(25,15,'PROMEDIO FINAL',1,1,'C');

$obj->setxy(230,60);
$obj->cell(40,20,'OBSERVACIONES',1,0,'C');

$obj->setxy(95,72);
$obj->cell(6,8,'IN',1,0,'C');
$obj->setxy(101,72);
$obj->cell(7,8,'NT',1,0,'C');
$obj->setxy(108,72);
$obj->cell(7,8,'NF',1,0,'C');


$obj->setxy(115,72);
$obj->cell(6,8,'IN',1,0,'C');
$obj->setxy(121,72);
$obj->cell(7,8,'NT',1,0,'C');
$obj->setxy(128,72);
$obj->cell(7,8,'NF',1,0,'C');


$obj->setxy(135,72);
$obj->cell(6,8,'IN',1,0,'C');
$obj->setxy(141,72);
$obj->cell(7,8,'NT',1,0,'C');
$obj->setxy(148,72);
$obj->cell(7,8,'NF',1,0,'C');

$obj->setxy(155,72);
$obj->cell(6,8,'IN',1,0,'C');
$obj->setxy(161,72);
$obj->cell(7,8,'NT',1,0,'C');
$obj->setxy(168,72);
$obj->cell(7,8,'NF',1,0,'C');

//auto-relleno
$a=1;
$i=70;


While($row = mysqli_fetch_assoc($estudiante)){

$obj->sety($y+$i);
$obj->cell(5,5,$a,1,1,'c');

$obj->sety($y+$i);
$obj->setx(15);
$obj->cell(50,5,$row['nombreEstudiante'],1,0,'C');
$obj->setx($y+$i);
$obj->setx(65);
$obj->cell(30,5,$row['identidad'],1,0,'C');
$obj->sety($y+$i);

$obj->setx(175);
$obj->cell(30,5,'',1,0,'C');
$obj->sety($y+$i);
$obj->setx(205);
$obj->cell(25,5,'',1,0,'C');
$obj->sety($y+$i);
$obj->setx(230);
$obj->cell(40,5,'',1,0,'C');


$obj->sety($y+$i);
$obj->setx(95);
$obj->cell(6,5,'',1,0,'C');
$obj->sety($y+$i);
$obj->setx(101);
$obj->cell(7,5,'',1,0,'C');
$obj->sety($y+$i);
$obj->setx(108);
$obj->cell(7,5,'',1,0,'C');

$obj->sety($y+$i);
$obj->setx(115);
$obj->cell(6,5,'',1,0,'C');
$obj->sety($y+$i);
$obj->setx(121);
$obj->cell(7,5,'',1,0,'C');
$obj->sety($y+$i);
$obj->setx(128);
$obj->cell(7,5,'',1,0,'C');


$obj->setx(135);
$obj->cell(6,5,'',1,0,'C');
$obj->setx(141);
$obj->cell(7,5,'',1,0,'C');
$obj->setx(148);
$obj->cell(7,5,'',1,0,'C');

$obj->setx(155);
$obj->cell(6,5,'',1,0,'C');
$obj->setx(161);
$obj->cell(7,5,'',1,0,'C');
$obj->setx(168);
$obj->cell(7,5,'',1,0,'C');

$a=$a+1;
$i=$i+5;
}





$obj->setfont('Arial','',10);
$obj->Output();
?>
