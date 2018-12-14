<?php
require 'pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{
$this->Image('img/ESCUDO.png',25,20,20);
		$this->setFont('Arial','B','8');

		$this->setxy(57,20);
		$this->cell(45,5,'REPUBLICA DE HONDURAS',0,1,'c');

		$this->setxy(56,25);
		$this->cell(48,5,'SECRETARIA DE EDUCACION',0,1,'c');
		$this->setxy(50,30);

		$this->cell(75,5,'BOLETOA DE INSCRIPCION DE MATRICULA',0,1,'l');
		$this->setxy(113,20);
		$this->setFont('Arial','B','6');
		$this->setxy(50,35);
		$this->cell(43,5,'Año Electivo',0,1,'c');
		$this->setxy(50,40);
		$this->cell(63,5,'Fecha Matricula',0,1,'l');

				$this->setFont('Arial','B','8');

		$this->setxy(70,35);
		$this->cell(20,5,'2018',1,0,'c');

		$this->setxy(70,40);
		$this->cell(20,5,'28/11/2018',1,0,'l');

				$this->setFont('Arial','','8');
		$this->setxy(94,40);
		$this->cell(80,5,'7° Grado',0,0,'l');

		$this->setxy(150,40);
		$this->cell(40,5,'',1,0,'l');
		$this->setxy(220,40);
		$this->cell(40,5,'',1,0,'l');
				$this->setFont('Arial','','5');
		$this->setxy(128,40);
		$this->cell(40,5,'NOMBRE DEL DOCENTE',0,0,'l');
		$this->setxy(208.5,40);
		$this->cell(40,5,'IDENTIDAD',0,0,'l');

				$this->setFont('Arial','','5');
				$this->setxy(86,20);
				$this->cell(95,5,'CODIGO DEL CENTRO EDUCATIVO',0,0,'C');
		$this->setxy(86,25);
		$this->cell(96,5,'NOMBRE DEL CENTRO EDUCATIVO',0,0,'C');
		$this->setxy(86,30);
		$this->cell(92.5,5,'DIRECCION DEL CENTRO EDUCATIVO',0,0,'C');

		$this->setxy(280,30);
		$this->cell(15,10,'NIVEL',1,0,'C');
		$this->setxy(295,30);
		$this->cell(35,5,'EDUCACION MEDIA',1,0,'C');
		$this->setxy(295,35);
		$this->cell(35,5,'E',1,0,'C');


				$this->setFont('Arial','','8');
				$this->setxy(150,20);
				$this->cell(10,5,'1',1,1,'C');
				$this->setxy(160,20);
				$this->cell(10,5,'5	',1,1,'C');
				$this->setxy(170,20);
				$this->cell(10,5,'0',1,1,'C');
				$this->setxy(180,20);
				$this->cell(10,5,'1',1,1,'C');
				$this->setxy(190,20);
				$this->cell(	20,5,'0',1,1,'C');
				$this->setxy(210,20);
				$this->cell(10,5,'0',1,1,'C');
				$this->setxy(220,20);
				$this->cell(20,5,'2',1,1,'C');
				$this->setxy(240,20);
				$this->cell(20,5,'0',1,1,'C');
				$this->setxy(260,20);
				$this->cell(10,5,'3',1,1,'C');

		$this->setxy(150,25);
		$this->cell(110,5,'INSTITUTO "SAN JORGE DE OLANCHO"',1,1,'C');
		$this->setxy(150,30);
		$this->cell(110,5,'PUNUARE,JUTICALPA,OLANCHO',1,1,'C');


		$this->setFont('Arial','','7');
		$this->setxy(10,60);
		$this->cell(5,20,'N°',1,1,'C');
		$this->setxy(15,60);
		$this->cell(35,20,'NOMBRE DEL ALUMNO (A)',1,1,'C');

		$this->setxy(50,60);
		$this->cell(177.5,5,'DATOS DE ALUMNO',1,1,'C');

		$this->setxy(50,65);
		$this->cell(15,15,'CURSO',1,0,'C');
		$this->setxy(65,65);
		$this->cell(15,15,'SECCION',1,0,'C');
		$this->setxy(80,65);
		$this->cell(15,15,'JORNADA',1,1,'C');
		$this->setxy(95,65);
		$this->cell(25,15,'N° DE IDENTIDAD',1,1,'C');
		$this->setFont('Arial','','6');
		$this->setxy(120,65);
		$this->cell(7,15,'SEXO',1,1,'C');
		$this->setxy(127,65);
		$this->cell(9,15,'REPITE',1,1,'C');
		$this->setxy(136,65);
		$this->cell(27,5,'FECHA DE NACIMIENTO',1,1,'C');
		$this->setxy(136,70);
		$this->cell(9,10,'DIA',1,0,'C');
		$this->setxy(145,70);
		$this->cell(9,10,'MES',1,0,'C');
		$this->setxy(154,70);
		$this->cell(9,10,'AÑO',1,0,'C');
		$this->setxy(163,65);
		$this->cell(9,15,'EDAD',1,0,'C');
		$this->setxy(172,65);
		$this->cell(55.5,5,'SITUACION LABORAL',1,0,'C');
		$this->setFont('Arial','','6');
		$this->setxy(172,70);
		$this->Multicell(12,5,'TRABAJA SI/NO',1,'C');
		$this->setxy(184,70);
		$this->cell(11,10,'JORNADA',1,0,'C');
		$this->setxy(195,70);
		$this->cell(19,10,'REMUNERACION',1,0,'C');
		$this->setxy(214,70);
		$this->Multicell(13.5,5,'RAMA DE  ACTIVIDAD',1,'C');
/*
*/
$this->setFont('Arial','','7');
$this->setxy(227.5,60);
$this->cell(112.2,5,'DATOS DEL PADR/MADRE/ENCARGADO',1,0,'C');
$this->setFont('Arial','','6');
$this->setxy(227.5,65);
$this->Multicell(25,7.5,'NOMBRE DEL ENCARGADO',1,'C');
$this->setxy(252.5,65);
$this->cell(20,15,'IDENTIDAD',1,0,'C');
$this->setxy(272.5,65);
$this->Multicell(15	,4.97,'PADRE O ENCARGADO  (P/E)',1,'C');
$this->setxy(287.5,65);
$this->Multicell(17.5,7.5,'PROFECION U OFICIO',1,'C');
$this->setxy(305,65);
$this->Multicell(17.5,15,'DIRECCION',1,'C');
$this->setxy(322.3,65);
$this->Multicell(17.5,7.5	,'TELEFONO CELULAR',1,'C');



$this->setxy(15,150);
$this->Multicell(120,40,'',1,'C');

$this->setxy(15,150);
$this->Multicell(40	,7,'NOMBRE DEL DIRECTOR',1,'C');

$this->setxy(55	,150);
$this->Multicell(70	,7,'MSC.MARIA A. OWEN GARCIA',1,'C');

$this->setxy(125,150);
$this->Multicell(10,7,'',1,'C');


$this->setxy(20,167);
$this->Multicell(50	,7,'IDENTIDAD',0,'C');

$this->setxy(55,167);
$this->Multicell(70	,7,'0801-1995-03021',1,'C');


$this->LINE(55,185,125,185);

$this->setxy(10,180);
$this->Multicell(70	,7,'FIRMA Y SELLO ',0,'C');


$this->setxy(142,167);
$this->Multicell(70	,7,'',1,'C');


$this->setxy(142,180);
$this->Multicell(70	,7,'',1,'C');

$this->setxy(200,180);
$this->Multicell(70	,7,'FIRMA Y SELLO ',0,'C');
$this->LINE(244,185,270,185);

$this->setxy(220,150);
$this->Multicell(110,40,'',1,'C');


$this->setxy(297,170);
$this->Multicell(30,15,'',1,'C');

$this->setxy(270,175);
$this->Multicell(30,3,'N° DE IDENTIDAD DISTRITAL',0,'C');


$this->setxy(220,150);
$this->Multicell(40	,7,'NOMBRE DE LA DISTRITAL',1,'C');

$this->setxy(260,150);
$this->Multicell(70	,7,'VICTOR MANUEL OLIVEIRA',1,'C');
	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
