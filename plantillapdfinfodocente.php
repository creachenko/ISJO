<?php
require 'pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{


		$this->setFont('Arial','B','8');

		$this->setxy(110,20);
		$this->cell(45,5,'DIRECCION DISTRITAL DE EDUCACION',0,1,'c');

		$this->setxy(119,25);
		$this->cell(48,5,'JUTICALPA,OLANCHO',0,1,'c');
		$this->setxy(100,30);
		$this->cell(48,5,'INFORMACION GENERAL DOCENTES DE JUTICALPA',0,1,'c');


		$this->setxy(20,40);
		$this->cell(45,5,'ÁÑO:',0,1,'c');
		$this->setxy(60,40);
		$this->cell(48,5,'NIVEL:',0,1,'c');
		$this->setxy(130,40);
		$this->cell(48,5,'CENTRO EDUCATIVO:',0,1,'c');
		$this->setxy(210	,40);
		$this->cell(27,5,'CODIGO:',0,0,'C');

		$this->setxy(33,40);
		$this->cell(45,5,'2018',0,1,'c');
		$this->setxy(73,40);
		$this->cell(48,5,'MEDIO',0,1,'c');
		$this->setxy(163,40);
		$this->cell(48,5,'INST."SAN JORGE DE OLANCHO"',0,1,'c');
		$this->setxy(227,40);
		$this->cell(27,5,'150100203-M02',0,0,'C');

		$this->setFont('Arial','','6');

		$this->setxy(20,65);
		$this->cell(5,15,'N°',1,0,'C');
		$this->setxy(25,65);
		$this->cell(30,15,'NOMBRE DEL DOCENTE',1,0,'C');
		$this->setxy(55,65);
		$this->cell(25,15,'N° DE IDENTIDAD',1,1,'C');
		$this->setxy(80,65);
		$this->cell(25,15,'TITULO,NIVEL MEDIO',1,1,'C');
		$this->setFont('Arial','','6');
		$this->setxy(105,65);
		$this->Multicell(17	,15,'IMPREMA',1,'C');
		$this->setxy(122,65);
		$this->Multicell(19,7.5,'TITULO,NIVEL UNIVERSITARIO',1,'C');
		$this->setFont('Arial','','6');
		$this->setxy(141,65);
		$this->Multicell(17,15,'CARGO',1,'C');
		$this->setxy(158,65);
		$this->cell(25,15,'AÑOS DE SERVICIO',1,0,'C');
		$this->setxy(183,65);
		$this->cell(27,15,'LUGAR DE RESIDENCIA',1,0,'C');
		$this->setxy(210	,65);
		$this->cell(27,15,'TELEFONO',1,0,'C');
/*
*/
}


	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
