<?php

require '../pdf/fpdf.php';



/**
*
*/
class PDF extends FPDF{
	public function header()
	{

	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
