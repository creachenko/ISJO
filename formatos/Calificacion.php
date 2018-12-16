<?php
include 'plantillapdfgeneral.php';
require_once "../class/funciones.php";
$obj=new PDF('L','mm','LETTER');
$obj->AddPage();//agregar pagina






//celdas


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

$obj->cell(57,5,'',0,1,'c');

$obj->setxy(132,30);
$obj->cell(57,5,'',0,1,'c');
  $obj->setxy(130,30);
$obj->cell(57,5,'|',0,1,'c');
$obj->setFont('Arial','','5	');
    $obj->setxy(90,33);
$obj->cell(57,5,'',0,1,'c');
$obj->ln(20);
// lETRAS CON NEGRITA



$obj->Output();
?>
