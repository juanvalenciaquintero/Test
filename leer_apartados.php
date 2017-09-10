<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
	$tema=$_GET['tema'];

?>

<form id="formulario" action="numero_preguntas.php" method="get" >
	<p><label for="temas">Tema elegido: <?php echo "  " . $tema?></label>
    	<input type="hidden" name="tema" value="<?php echo $tema?>">
    </p>
       <p><label for="apartado">Apartado:</label>
    <select name='apartado' id='apartado'>
		<option>Título I</option>
        <option>Título II</option>
        <option>Título III</option>;
       </select></p>
	<p><label for='preguntas'>Preguntas:</label>
    <select name='preguntas' id='preguntas' hidden="true" >
		<option>15</option>
        <option>25</option>
        <option>50</option>;
       </select></p>
       <p><input type="submit" name="formulario" value="Ejecutar"></p>
</form>
</body>
</html>