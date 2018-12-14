<?php
require 'pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{

				$this->setFont('Arial','B','13');
				$this->cell(50);
				$this->setxy(113,12);
				$this->cell(45,5,'PLAN OPERATIVO ANUAL',0,1,'c');

				$this->setFont('Arial','B','10');
				$this->cell(50);
				$this->setxy(	29,22);
				$this->cell(45,5,'INSTITUTO SAN JORGE DE OLANCHO',0,1,'c');

				$this->setFont('Arial','B','10');
				$this->cell(50);
				$this->setxy(99,22);
				$this->cell(45,5,'CARGO :',0,1,'c');
				$this->setFont('Arial','B','10');
				$this->cell(50);
				$this->setxy(149,22);
				$this->cell(45,5,'PROFA :',0,1,'c');+

				$this->setFont('Arial','B','10');
				$this->cell(50);
				$this->setxy(209,22);
				$this->cell(45,5,'AÑO :',0,1,'c');

				$this->Line(116, 26, 146, 26);
				$this->Line(166, 26, 206, 26);
				$this->Line(222, 26, 243, 26);
	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
