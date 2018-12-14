<?php
include 'plantillapdfhorariomAESTRO.php';
require_once "class/funciones.php";
$obj=new PDF('l','mm','LETTER');
$obj->AddPage();//agregar pagina
$ob=new funcionesBD();

$est=

$obj->AliasNbpages();


// lETRAS CON NEGRITA

$obj->setFont('Arial','B','14');

$obj->setxy(30,40);
$obj->cell(45,5,'DIA :',0,0,'c');

$obj->setxy(110,40);
$obj->cell(45,5,'FECHA :',0,0,'c');

$obj->setxy(30,50);
$obj->cell(50,5,'AÑO :',0,0,'c');

$obj->setxy(90,50);
$obj->cell(50,5,'SECCION :',0,0,'c');


//LETRAS SIN NEGRITA
$obj->setFont('Arial','','13');
$obj->setxy(50,50);
$obj->cell(50,5,'2017',0,1,'c');

$obj->setFont('Arial','','13');
$obj->setxy(125,50);
$obj->cell(50,5,' UNICA',0,1,'c');



$obj->setFont('Arial','','13');
$obj->setxy(50,40);
$obj->cell(50,5,'LUNES ',0,1,'c');


$obj->Line(132, 44, 190, 44);

//Cabecera de la trabla

$obj->setxy(20,60);
$obj->cell(35,10,'HORA',1,1,'C');
$obj->setxy(55,60);
$obj->cell(35,10,'ASIGNATURA',1,0,'C');
$obj->setxy(90,60);
$obj->cell(35,10,'TEMA',1,0,'C');
$obj->setxy(125,60);
$obj->cell(35,10,'DOCENTE',1,0,'C');
$obj->setxy(160,60);
$obj->cell(35,10,'FIRMA',1,0,'C');
$obj->setxy(195,60);
$obj->cell(35,10,'OBSERVACION',1,0,'C');
$obj->setxy(200 ,60);

$obj->setFont('Arial','','8');
//PRIMERA FILA
$obj->setxy(20,70);
$obj->cell(35,5,'6:50-7:30',1,1,'C');
$obj->setxy(55,70);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,70);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,70);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,70);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(195,70);
$obj->cell(35,5,'',1,0,'C');


//SEGUNDA FILA
$obj->setxy(20,75);
$obj->cell(35,5,'7:30-8:10',1,1,'C');
$obj->setxy(55,75);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,75);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,75);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,75);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(195,75);
$obj->cell(35,5,'',1,0,'C');


//TERCERA FILA
$obj->setxy(20,80);
$obj->cell(35,5,'8:10-8:50',1,1,'C');
$obj->setxy(55,80);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,80);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,80);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,80);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(195,80);
$obj->cell(35,5,'',1,0,'C');




//CUARTA FILA
$obj->setxy(20,85);

$obj->cell(35,5,'8:50-9:30',1,1,'C');
$obj->setxy(55,85);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,85);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,85);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,85);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(195,85);
$obj->cell(35,5,'',1,0,'C');


//QUINTA FILA
$obj->setxy(20,90);
$obj->cell(35,5,'9:30-9:50',1,1,'C');
$obj->setxy(55,90);
$obj->cell(175,5,'R E C E S O',1,0,'C');


//SEXTA FILA
$obj->setxy(20,95);
$obj->cell(35,5,'8:50-9:30',1,1,'C');
$obj->setxy(55,95);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,95);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,95);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,95);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(195,95);
$obj->cell(35,5,'',1,0,'C');


//SEPTIMA FILA
$obj->setxy(20,100);
$obj->cell(35,5,'8:50-9:30',1,1,'C');
$obj->setxy(55,100);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,100);
$obj->setFont('Arial','','7');
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,100);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,100);
$obj->cell(35,5,'',1,0,'C');
$obj->setFont('Arial','','8');
$obj->setxy(195,100);
$obj->cell(35,5,'',1,0,'C');


//OCTAVA FILA
$obj->setxy(20,105);
$obj->cell(35,5,'8:50-9:30',1,1,'C');
$obj->setxy(55,105);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,105);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,105);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,105);
$obj->cell(35,5,'',1,0,'C');
$obj->setFont('Arial','','8');
$obj->setxy(195,105);
$obj->cell(35,5,'',1,0,'C');


//NOVENA FILA
$obj->setxy(20,110);
$obj->cell(35,5,'8:50-9:30',1,1,'C');
$obj->setxy(55,110);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(90,110);
$obj->setFont('Arial','','7');
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(125,110);
$obj->cell(35,5,'',1,0,'C');
$obj->setxy(160,110);
$obj->cell(35,5,'',1,0,'C');
$obj->setFont('Arial','','8');
$obj->setxy(195,110);
$obj->cell(35,5,'',1,0,'C');



$obj->setfont('Arial','',10);
$obj->Output();


?>
