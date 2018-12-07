<?php
require_once "configuracion.php";
class conexionBD{
//propiedades
	public $bd;

	public function __construct(){
        $this->bd= new mysqli(HOST,USER,PASS,BD);
        if ($this->bd->connect_errno){
        	echo "Error al conectar a MSQL :".$this->bd->connect_error;
            return;
        }
        $this->bd->set_charset(CHARSET);
	}

}

 ?>
