<?php
include 'plantillapdfcalificaciones.php';
require_once "class/funciones.php";
$obj=new PDF('L','mm','LETTER');
$obj->AddPage();//agregar pagina






//celdas
$obj->setFont('Arial','B','8');
$obj->setxy(119,5);
$obj->cell(45,5,'CUADRO DE CALIFICACIONES',0,1,'c');




$obj->Output();
?>
