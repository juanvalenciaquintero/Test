<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<style>

table{
	width: 90%;
	border: #988D8D 3px solid;
	border-radius:10px;
	margin:auto;
	margin-bottom:10px;
		
}

.linea {
padding-left: 30px;	
	
}

</style>
</head>

<body>

<?php

include ("conexion.php");

$sql_preguntas="SELECT * FROM preguntas WHERE Id < 20";
$resultado_preguntas=$conexion->prepare($sql_preguntas);
$resultado_preguntas->execute(array());

while ($pregunta=$resultado_preguntas->fetch(PDO::FETCH_ASSOC)){
	
		echo "<table><tr><td>";
		echo "<strong>Pregunta: " . $pregunta['Pregunta'] ;
		
		$sql_respuestas = "SELECT * FROM respuestas WHERE Id=" . $pregunta['Id'] . "";
		$resultado_respuestas=$conexion->prepare($sql_respuestas);
		$resultado_respuestas->execute(array());
		
		while($respuestas=$resultado_respuestas->fetch(PDO::FETCH_BOTH)){;
		
			echo "</strong></td></tr>";
			echo "<tr><td class='linea'><strong>Respuesta " . $respuestas[1] . "</strong>: " . $respuestas[2] . "</td></tr>";
		}
	
	echo "</table>";
	
	
	
	
}






?>
</body>
</html>