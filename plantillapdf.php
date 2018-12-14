<?php
require 'pdf/fpdf.php';

/**
*
*/
class PDF extends FPDF{
	public function header()
	{
		$this->Image('img/logo1.png',100);
		$this->setFont('Arial','B','16');
		$this->cell(50);
		$this->cell(120,10,'Departamentos de Honduras',0,1,'l');
		$this->ln(20);
	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}


?>
