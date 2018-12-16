<?php
require '../pdf/fpdf.php';


/**
*
*/
class PDF extends FPDF{
	public function header()
	{

		$this->setFont('Arial','B','15');
		$this->cell(50);
		$this->setxy(110,22);
		$this->cell(60,5,'HORARIO PEDAGOGICO',0,1,'C');

		$this->setFont('Arial','B','15');
		$this->cell(50);
		$this->setxy(110,30);
		$this->cell(60,5,'10° GRADO  BTP EN INFORMACTICA Y CONTADURIA Y FINANZAS II.SEMESTRE',0,1,'C');




	}

	public function footer(){
        $this->setY(-15);
        $this->setFont('Arial','I','8');
        $this->cell(0,10,'pagina'.$this->pageNO().'/{nb}',0,0,';');

	}
}

?>
