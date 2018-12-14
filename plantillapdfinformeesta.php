<?php
require 'pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{

				$this->setFont('Arial','B','10');
				$this->cell(50);
				$this->setxy(119,8);
				$this->cell(45,5,'REPUBLICA DE HONDURAS',0,1,'c');

				$this->cell(50);
				$this->setxy(116,17);
				$this->cell(48,5,'SECRETARIA DE EDUCACION',0,1,'c');
				$this->setxy(94,24);

				$this->cell(75,5,'DIRECCION DEPARTAMENTAL DE EDUCACION DE OLANCHO',0,1,'l');
				$this->setxy(95,30);

				$this->cell(37,5,'INFORME ESTADISTICO MENSUAL DE EDUCACION MEDIA',0,1,'c');

	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
