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
	$tema=$_GET['tema'];
	$apartado=$_GET['apartado'];
		
				
?>

<h1>Test Oposiciones</h1>
<form id="formulario" action="crear_test.php" method="get" >
	<p><label for='tema'>Tema elegido: <?php  echo "  " . $tema?></label><input name="tema" type="hidden" value="<?php echo $tema?>"></p>
    <p><label for='apartado'>Apartado elegido: <?php  echo "  " . $apartado?></label><input name="apartado" type="hidden" value="<?php echo $apartado?>"></p>
    <p><label for='preguntas'>Número de preguntas: </label>
    <select name='preguntas' id='preguntas' >
   		<option>15</option>	
		<option>25</option>
		<option>50</option>
    </select></p>
    <p><input type="submit" name="formulario" value="Crear test">
    <a href="elegir_tema.php"><input type="button" value="Borrar selección" name="borrar" id="borrar"></a></p>





</form>
</body>
</html>