<?php
require 'pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{

		$this->setFont('Arial','B','15');
		$this->cell(50);
		$this->setxy(110,5);
		$this->cell(60,5,'HORARIO INDIVIDUAL',0,1,'C');


		$this->setxy(90,15);
		$this->cell(105,8,'INSTITUTO. "SAN JORGE DE OLANCHO"',0,1,'l');
		$this->setxy(113,20);




	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
