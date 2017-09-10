<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<link rel="stylesheet" href="estilos.css">
</head>

<body>
<?php

	include("conexion.php");
	$sql_temas="SELECT * FROM temas";
	$resultado=$conexion->prepare($sql_temas);
	$resultado->execute(array());
				
?>

<h1>Test Oposiciones</h1>
<form id="formulario" action="elegir_apartado.php" method="get" >
	<p><label for='tema'>Tema: </label>
    <select name='tema' id='tema'>
    <?php
			while($registros=$resultado->fetch(PDO::FETCH_ASSOC)){ // Rellenar las opciones de temas				
				echo "<option>" . $registros['Tema'] . "</option><br>";	
			}
	?>
    </select></p>
    <p><input type="submit" name="formulario" value="Elegir Tema">
    <a href="elegir_tema.php"><input type="button" value="Borrar selección" name="borrar" id="borrar"></a></p>





</form>
</body>
</html>