<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>

<?php

include ("conexion.php");

$sql="SELECT * FROM temas";

$resultado=$conexion->prepare($sql);

$resultado->execute(array());

while($tema=$resultado->fetch(PDO::FETCH_ASSOC)){
	
	echo "Tema: " . $tema['Tema'] . "<br>";
	
}

$resultado->closeCursor();

?>
</body>
</html>