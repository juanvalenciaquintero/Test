<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php
	$apartado=$_GET['apartado'];
	$tema=$_GET['tema'];
?>
<form id="formulario" action="crear_test.php" method="get" >
	<p><label for="temas">Tema elegido: <?php echo "  " . $tema?></label>
    	<input type="hidden" name="tema" value="<?php echo $tema?>">
    </p>
       <p><label for="apartado">Apartado elegido:  <?php echo "  " . $apartado?></label>
       <input type="hidden" name="apartado" value="<?php echo $apartado?>">
   </p>
	<p><label for='preguntas'>Preguntas:</label>
    <select name='preguntas' id='preguntas' >
		<option>15</option>
        <option>25</option>
        <option>50</option>;
       </select></p>
       <p><input type="submit" name="formulario" value="Ejecutar"></p>
</form>
</body>
</html>