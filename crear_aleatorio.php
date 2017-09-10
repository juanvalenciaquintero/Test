<?php

class Crea_aleatorio {
	
	private $limite;
	
	public function __construct() {
		$this->aleatorios;	
	}
	
	public function get_Aleatorio($preguntas, $contador) {
		
	for ($i=0;$i<$preguntas;$i++){
	
		$matriz[$i]=rand(1,$contador);	
	
	}

	
	for ($limite=1;$limite<($contador);$limite++){
		$cont=$limite;
		do {
			$cont--;
		
		
			if ($matriz[$cont]==$matriz[$limite]){
				
				$matriz[$limite]=rand(1,$contador);
				$cont=$limite;
			} 
		} while ($cont>0);
		

	}
	$this->aleatorios=$matriz;

	return $this->aleatorios;
		
		
	}
	
	
}




?>