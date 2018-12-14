<?php
include 'plantillapdfgeneral.php';

require_once "class/funciones.php";

$obj=new PDF('P','mm','legal');
$obj->AddPage();//agregar pagina

$y=$obj->Gety();
$x=$obj->GetX();



$ob=new funcionesBD();

$certi = $ob->cert();
$certi1 = $ob->cert();
$certi3 = $ob->cert();
$obj->line(71,22.5,151,22.5);
$obj->line(103,39,200,39);

$obj->line(9,59.5,162,59.5);
$obj->line(9,149.5,162,149.5);
$obj->line(9,249.5,162,249.5);

$obj->setFont('Times','B','16');
$obj->setxy(85,12);




$obj->AliasNbpages();
// lETRAS CON NEGRITA
$obj->setFont('times','B','15');
$obj->setxy(70,10);
$obj->cell(70,20,'CERTFICACION  DE ESTUDIOS',0,0,'c');
$obj->setFont('times','','14 ');
$obj->setxy(10,20);
$obj->cell(10,20,'La Suscrita Secretaria del instituto: "San Jorge de Olancho" de la aldea de punuare, con codigo',0,0,'c');
$obj->setxy(7 ,27);
$obj->cell(10,20,' N° 150100203M02, Certifica Que al alumno:',0,0,'c');
$obj->setFont('times','B','14');
$obj->setxy(120 ,27);
$obj->cell(5,20,'',0,0,'c');
$obj->setFont('times','','14');
$obj->setxy(8,33);
$obj->cell(5,20,',CON R.N.E. ',0,0,'c');
$obj->setxy(36,33);
$obj->cell(35,20,'{identidad}',0,0,'c');
$obj->setxy(71,33);
$obj->cell(10,20,', Realizo Sus Estudios  En  Este  Centro  Educativo  conforme a ',0,0,'c');
$obj->setxy(8,38);
$obj->cell(10,20,'continuacion se detalla :',0,0,'c');

$obj->setFont('times','b','14');
$obj->setxy(8,50);
$obj->cell(10,15,'SEPTIMO GRADO DEL TERCER CICLO DE EDUCACION BASICA: ',0,0,'c');
$obj->setFont('times','b','13');
$obj->setxy(8,57);
$obj->cell(10,15,'AÑO :',0,0,'c');
$obj->setxy(65,57);
$obj->cell(30,15,'SECCION :',0,0,'c');
$obj->setxy(115,57);
$obj->cell(10,15,'JORNADA :',0,0,'c');

$obj->setxy(24,57);
$obj->cell(30,15,'2018',0,0,'c');
$obj->setxy(88,57);
$obj->cell(30,15,' "A" ',0,0,'c');
$obj->setxy(143,57);
$obj->cell(10,15,'VESPERTINA',0,0,'c');


$obj->setFont('times','B','14');
$obj->setxy(105,27);
$obj->cell(10,20,' Alumno ',0,0,'c');






$obj->setFont('Arial','B','8');

$obj->setxy(10,165);
$obj->cell(10,10,'N°',1,0,'c');
$obj->setxy(20,165);
$obj->cell(30,10,'ASIGNATURAS ',1,0,'C');
$obj->setxy(50,165);
$obj->cell(15,10,'NOTA',1,0,'C');
$obj->setxy(65,165);
$obj->cell(50,10,'DENOMINACION',1,0,'C');
$obj->setxy(115,165);
$obj->cell(45,4,'I RECUPERACION',1,0,'C');
$obj->setxy(160,165);
$obj->cell(45,4,'II RECUPERACION',1,0,'C');
$obj->setxy(115,169);
$obj->cell(10,6,'NOTA',1,0,'C');
$obj->setxy(160,169);
$obj->cell(10,6,'NOTA',1,0,'C');
$obj->setxy(125,169);
$obj->cell(35,6,'DENOMINACION',1,0,'C');
$obj->setxy(170,169);
$obj->cell(35,6,'DENOMINACION',1,0,'C');
$a=162;

$i=1;
WHILE($row = mysqli_fetch_assoc($certi)){
$obj->setY($a+13);
$obj->setx(10);
$obj->cell(10,5,$i,1,0,'c');
$obj->setx(20);
$obj->cell(30,5 ,$row['nombreAsignatura'],1,0,'C');
$obj->setx(50);
$obj->cell(15,5 ,'',1,0,'C');
$obj->setx(65);
$obj->cell(50,5 ,'',1,0,'C');
$obj->setx(115);
$obj->cell(10,5 ,'',1,0,'C');
$obj->setx(160);
$obj->cell(10,5 ,'',1,0,'C');
$obj->setx(125);
$obj->cell(35,5 ,'',1,0,'C');
$obj->setx(170);
$obj->cell(35,5 ,'',1,0,'C');
$i=$i+1;
$a=$a+5;
}
$obj->setFont('times','b','14');
$obj->setxy(8,140);
$obj->cell(10,15,'OCTAVO GRADO DEL TERCER CICLO DE EDUCACION BASICA: ',0,0,'c');
$obj->setFont('times','b','13');
$obj->setxy(8,150);
$obj->cell(10,15,'AÑO :',0,0,'c');
$obj->setxy(65,150);
$obj->cell(30,15,'SECCION :',0,0,'c');
$obj->setxy(115,150);
$obj->cell(10,15,'JORNADA :',0,0,'c');

$obj->setxy(24,150);
$obj->cell(30,15,'2018',0,0,'c');
$obj->setxy(88,150);
$obj->cell(30,15,' "A" ',0,0,'c');
$obj->setxy(143,150);
$obj->cell(10,15,'VESPERTINA',0,0,'c');


$obj->setFont('Arial','B','8');

$obj->setxy(10,73);
$obj->cell(10,10,'N°',1,0,'c');
$obj->setxy(20,73);
$obj->cell(30,10,'ASIGNATURAS ',1,0,'C');
$obj->setxy(50,73);
$obj->cell(15,10,'NOTA',1,0,'C');
$obj->setxy(65,73);
$obj->cell(50,10,'DENOMINACION',1,0,'C');
$obj->setxy(115,73);
$obj->cell(45,4,'I RECUPERACION',1,0,'C');
$obj->setxy(160,73);
$obj->cell(45,4,'II RECUPERACION',1,0,'C');
$obj->setxy(115,77);
$obj->cell(10,6,'NOTA',1,0,'C');
$obj->setxy(160,77);
$obj->cell(10,6,'NOTA',1,0,'C');
$obj->setxy(125,77);
$obj->cell(35,6,'DENOMINACION',1,0,'C');
$obj->setxy(170,77);
$obj->cell(35,6,'DENOMINACION',1,0,'C');
$a=70;

$i=1;
WHILE($row = mysqli_fetch_assoc($certi1)){
$obj->setY($a+13);
$obj->setx(10);
$obj->cell(10,5,$i,1,0,'c');
$obj->setx(20);
$obj->cell(30,5 ,$row['nombreAsignatura'],1,0,'C');
$obj->setx(50);
$obj->cell(15,5 ,'',1,0,'C');
$obj->setx(65);
$obj->cell(50,5 ,'',1,0,'C');
$obj->setx(115);
$obj->cell(10,5 ,'',1,0,'C');
$obj->setx(160);
$obj->cell(10,5 ,'',1,0,'C');
$obj->setx(125);
$obj->cell(35,5 ,'',1,0,'C');
$obj->setx(170);
$obj->cell(35,5 ,'',1,0,'C');
$i=$i+1;
$a=$a+5;
}


$obj->setFont('times','B','14');
$obj->setxy(8,240);
$obj->cell(10,15,'NOVENO GRADO DEL TERCER CICLO DE EDUCACION BASICA: ',0,0,'c');
$obj->setFont('times','b','13');
$obj->setxy(8,250);
$obj->cell(10,15,'AÑO :',0,0,'c');
$obj->setxy(65,250);
$obj->cell(30,15,'SECCION :',0,0,'c');
$obj->setxy(115,250);
$obj->cell(10,15,'JORNADA :',0,0,'c');

$obj->setxy(24,250);
$obj->cell(30,15,'2018',0,0,'c');
$obj->setxy(88,250);
$obj->cell(30,15,' "A" ',0,0,'c');
$obj->setxy(143,250);
$obj->cell(10,15,'VESPERTINA',0,0,'c');


$obj->setFont('Arial','B','8');

$obj->setxy(10,263);
$obj->cell(10,10,'N°',1,0,'c');
$obj->setxy(20,263);
$obj->cell(30,10,'ASIGNATURAS ',1,0,'C');
$obj->setxy(50,263);
$obj->cell(15,10,'NOTA',1,0,'C');
$obj->setxy(65,263);
$obj->cell(50,10,'DENOMINACION',1,0,'C');
$obj->setxy(115,263);
$obj->cell(45,4,'I RECUPERACION',1,0,'C');
$obj->setxy(160,263);
$obj->cell(45,4,'II RECUPERACION',1,0,'C');
$obj->setxy(115,267);
$obj->cell(10,6,'NOTA',1,0,'C');
$obj->setxy(160,267);
$obj->cell(10,6,'NOTA',1,0,'C');
$obj->setxy(125,267);
$obj->cell(35,6,'DENOMINACION',1,0,'C');
$obj->setxy(170,267);
$obj->cell(35,6,'DENOMINACION',1,0,'C');
$a=260;

$i=1;
WHILE($row = mysqli_fetch_assoc($certi3)){
$obj->setY($a+13);
$obj->setx(10);
$obj->cell(10,5,$i,1,0,'c');
$obj->setx(20);
$obj->cell(30,5 ,$row['nombreAsignatura'],1,0,'C');
$obj->setx(50);
$obj->cell(15,5 ,'',1,0,'C');
$obj->setx(65);
$obj->cell(50,5 ,'',1,0,'C');
$obj->setx(115);
$obj->cell(10,5 ,'',1,0,'C');
$obj->setx(160);
$obj->cell(10,5 ,'',1,0,'C');
$obj->setx(125);
$obj->cell(35,5 ,'',1,0,'C');
$obj->setx(170);
$obj->cell(35,5 ,'',1,0,'C');
$i=$i+1;
$a=$a+5;
}

$obj->AddPage();//agregar pagina
$obj->line(15,39,68,39);
$obj->line(145,39,198,39);


$obj->setFont('times','b','14');
$obj->setxy(68,30);
$obj->cell(10,15,'ES CONFORME A SU ORIGINAL ',0,0,'c');
$obj->setFont('times','b','13');
$obj->setxy(25,45);
$obj->cell(10,15,'Extendida en Punuare,a los que  dias del mes de  del año .',0,0,'c');


$obj->line(123,154,180,154);

$obj->setxy(25,150);
$obj->cell(30,15,'Licda.Karla Y. Rodriges',0,0,'c');
$obj->setxy(40,155);
$obj->cell(35,15,'Directora',0,0,'c');


$obj->line(20,154,80,154);

$obj->setxy(125,150);
$obj->cell(70,15,'Licda. Lilian L. Figueroa',0,0,'c');
$obj->setxy(144,155);
$obj->cell(10,15,'Secretaria',0,0,'c');



$obj->Output();


?>
