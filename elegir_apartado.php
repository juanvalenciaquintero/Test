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
	
	$sql_apartados="SELECT * FROM apartados WHERE Tema = '" . $tema . "'";
	$result_apartados=$conexion->prepare($sql_apartados);
	$result_apartados->execute(array());
				
?>

<h1>Test Oposiciones</h1>
<form id="formulario" action="elegir_preguntas.php" method="get" >
	<p><label for='tema'>Tema elegido: <?php  echo "  " . $tema?></label><input name="tema" type="hidden" value="<?php echo $tema?>"></p>
    <p><label for='apartado'>Apartado: </label>
    <select name='apartado' id='apartado' >
    <?php
			while($registros=$result_apartados->fetch(PDO::FETCH_ASSOC)){ //Rellenar los apartados correspondientes a ese tema
				
				echo "<option>" . $registros['Apartado'] . "</option><br>";	
			}
	?>
    </select></p>
    <p><input type="submit" name="formulario" value="Elegir Apartado">
    <a href="elegir_tema.php"><input type="button" value="Borrar selección" name="borrar" id="borrar"></a></p>





</form>
</body>
</html>