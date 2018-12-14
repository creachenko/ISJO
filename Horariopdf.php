<?php
include 'plantillapdfhorario.php';
require_once "class/funciones.php";
$obj=new PDF('l','mm','LETTER');
$obj->AddPage();//agregar pagina
$ob=new funcionesBD();



$obj->AliasNbpages();


// lETRAS CON NEGRITA

$obj->setFont('Arial','B','8');

$obj->setxy(30,40);
$obj->cell(45,5,'NOMBRE :',0,0,'c');

$obj->setxy(90,40);
$obj->cell(45,5,'JORNADA :',0,0,'c');

$obj->setxy(50,55);
$obj->cell(50,5,'MODALIDAD :',0,0,'c');

//LETRAS SIN NEGRITA
$obj->setFont('Arial','',8);
$obj->setxy(69,55);
$obj->cell(50,5,'BACHILLERATO TECNICO PROFECIONAL EN INFORMATICA Y CONTADURIA Y FINANZAS  ',0,1,'c');



$obj->setFont('Arial','',8);
$obj->setxy(50,40);
$obj->cell(50,5,'CAREN MENDOZA ',0,1,'c');

$obj->setxy(110,40);
$obj->cell(50,5,'MATUTINA ',0,1,'c');


$obj->setxy(170,40);
$obj->cell(50,5,'I. PARCIAL ',0,1,'c');

$obj->setxy(220,40);
$obj->cell(50,5,'I. SEMESTRE',0,1,'c');
//Cabecera de la trabla

$obj->setxy(20,60);
$obj->cell(30,10,'HORA',1,1,'C');
$obj->setxy(50,60);
$obj->cell(30,10,'LUNES',1,0,'C');
$obj->setxy(80,60);
$obj->cell(30,10,'MARTES',1,0,'C');
$obj->setxy(110,60);
$obj->cell(30,10,'MIERCOLES ',1,0,'C');
$obj->setxy(140,60);
$obj->cell(30,10,'JUEVES',1,0,'C');
$obj->setxy(170,60);
$obj->cell(30,10,'VIERNES',1,0,'C');
$obj->setxy(200 ,60);
$obj->cell(30,10,'SABADO  ',1,0,'C');

//PRIMERA FILA
$obj->setxy(20,70);
$obj->cell(30,10,'6:50-7:30',1,1,'C');
$obj->setxy(50,70);
$obj->cell(30,10,'LENG.LITER.II.BACH',1,0,'C');
$obj->setxy(80,70);
$obj->cell(30,10,'LENG.LITER.II.BACH',1,0,'C');
$obj->setxy(110,70);
$obj->cell(30,10,'LENG.LITER.II.BACH',1,0,'C');
$obj->setxy(140,70);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(170,70);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,70);
$obj->cell(30,10,'LENG.LITER.II.BACH ',1,0,'C');

//SEGUNDA FILA
$obj->setxy(20,80);
$obj->cell(30,10,'7:30-8:10',1,1,'C');
$obj->setxy(50,80);
$obj->cell(30,10,'ESPANIOL I.I BACH',1,0,'C');
$obj->setxy(80,80);
$obj->cell(30,10,'ESPANIOL I.I BACH',1,0,'C');
$obj->setxy(110,80);
$obj->cell(30,10,'ESPANIOL I.I BACH',1,0,'C');
$obj->setxy(140,80);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(170,80);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,80);
$obj->cell(30,10,'ESPANIOL I.I BACH ',1,0,'C');

//TERCERA FILA
$obj->setxy(20,90);
$obj->cell(30,10,'8:10-8:50',1,1,'C');
$obj->setxy(50,90);
$obj->cell(30,10,'ESPANIOL I.I BACH',1,0,'C');
$obj->setxy(80,90);
$obj->cell(30,10,'ESPANIOL I.I',1,0,'C');
$obj->setxy(110,90);
$obj->cell(30,10,'INGLES I .BACH',1,0,'C');
$obj->setxy(140,90);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(170,90);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,90);
$obj->cell(30,10,'ESPANIOL I.I BACH ',1,0,'C');



//CUARTA FILA
$obj->setxy(20,100);
$obj->cell(30,10,'8:50-9:30',1,1,'C');
$obj->setxy(50,100);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(80,100);
$obj->cell(30,10,'INGLES I .BACH',1,0,'C');
$obj->setxy(110,100);
$obj->cell(30,10,'INGLES I .BACH',1,0,'C');
$obj->setxy(140,100);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(170,100);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,100);
$obj->cell(30,10,' ',1,0,'C');

//QUINTA FILA
$obj->setxy(20,110);
$obj->cell(30,10,'9:30-9:50',1,1,'C');
$obj->setxy(50,110);
$obj->cell(180,10,'R E C E S O',1,0,'C');


//SEXTA FILA
$obj->setxy(20,120);
$obj->cell(30,10,'8:50-9:30',1,1,'C');
$obj->setxy(50,120);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(80,120);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(110,120);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(140,120);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(170,120);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,120);
$obj->cell(30,10,' ',1,0,'C');

//SEPTIMA FILA
$obj->setxy(20,130);
$obj->cell(30,10,'8:50-9:30',1,1,'C');
$obj->setxy(50,130);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(80,130);
$obj->setFont('Arial','','7');
$obj->cell(30,10,'INGLES TECN, II.BACH',1,0,'C');
$obj->setxy(110,130);
$obj->cell(30,10,'INGLES TECN, II.BACH',1,0,'C');

$obj->setxy(140,130);
$obj->cell(30,10,'INGLES TECN, II.BACH',1,0,'C');
$obj->setFont('Arial','','8');
$obj->setxy(170,130);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,130);
$obj->cell(30,10,' ',1,0,'C');

//OCTAVA FILA
$obj->setxy(20,140);
$obj->cell(30,10,'8:50-9:30',1,1,'C');
$obj->setxy(50,140);
$obj->cell(30,10,'LENG.LITER.II.BACH',1,0,'C');

$obj->setxy(80,140);
$obj->cell(30,10,'LENG.LITER.II.BACH',1,0,'C');
$obj->setxy(110,140);
$obj->cell(30,10,'',1,0,'C');

$obj->setxy(140,140);
$obj->cell(30,10,'',1,0,'C');
$obj->setFont('Arial','','8');
$obj->setxy(170,140);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,140);
$obj->cell(30,10,' LENG.LITER.II.BACH',1,0,'C');

//NOVENA FILA
$obj->setxy(20,150);
$obj->cell(30,10,'8:50-9:30',1,1,'C');
$obj->setxy(50,150);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(80,150);
$obj->setFont('Arial','','7');
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(110,150);
$obj->cell(30,10,'',1,0,'C');

$obj->setxy(140,150);
$obj->cell(30,10,'',1,0,'C');
$obj->setFont('Arial','','8');
$obj->setxy(170,150);
$obj->cell(30,10,'',1,0,'C');
$obj->setxy(200 ,150);
$obj->cell(30,10,' ',1,0,'C');


$obj->setfont('Arial','',10);
$obj->Output();


?>
