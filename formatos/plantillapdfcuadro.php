<?php
require 'pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{

		$this->setFont('Arial','B','8');
		$this->cell(50);
		$this->setxy(119,5);
		$this->cell(45,5,'REPUBLICA DE HONDURAS',0,1,'c');

		$this->cell(50);
		$this->setxy(118,10);
		$this->cell(48,5,'SECRETARIA DE EDUCACION',0,1,'c');
		$this->setxy(106,15);

		$this->cell(75,5,'DIRECCION DEPARTAMENTAL DE EDUCACION',0,1,'l');
		$this->setxy(123,20);
	$this->setFont('Arial','B','12');
		$this->cell(57,5,'CUADRO  No.1',0,1,'c');
	$this->setFont('Arial','B','8');
		$this->setxy(20,30);
		$this->cell(57,5,'CENTRO EDUCATIVO. "SAN JORGE DE OLANCHO"',0,1,'c');
		$this->setFont('Arial','B','8');
				$this->setxy(20,35);
		$this->cell(57,5,'MUNICIPIO: 01/JUTICALPA ',0,1,'c');
		$this->setxy(65,35);
$this->cell(57,5,'LUGAR: PUNUARE,JUTICALPA1.5 KILOMETROS DEL DESVIODE JUTICALPA CONDUCE A CATACAMAS. ',0,1,'c');

$this->setxy(130,30);
$this->cell(57,5,'DEPARTAMENTO: (15)OLANCHO.',0,1,'c');

		$this->ln(20);
	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
