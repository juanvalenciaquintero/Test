<?php


try {
	$conexion=new PDO('mysql:host=localhost; dbname=id2700592_test', 'id2700592_root', '42180200');
	
	$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	$conexion->exec("SET CHARACTER SET utf8");
	
	
	

} catch (Exception $e){
	
	echo "Linea del error: " . $e->getLine() . "<br>";
	
	die("Error: " . $e->getMessage());
}





?>