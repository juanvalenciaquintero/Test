<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<style>
h1{
	
	width:40%;
	text-align:center;
	background-color:#1B5796;
	color:#FDFDFD;
	border-radius:15px;
	padding: 20px 30px;
	box-shadow:#7F7D7D 5px 5px 10px;
	margin:auto;
	margin-top:20px;
	
}

#formulario{
	
	width:60%;
	background-color:#E2F5E3;
	border: 1px #000000 solid;
	padding:40px 40px 5px 40px;
	margin:auto;	
	margin-top:40px;
	border-radius:15px;
	
}
#formulario2{
	
	width:60%;
	background-color:#E2F5E3;
	border: 1px #000000 solid;
	padding:40px;
	margin:auto;	
	
}

#borrar{
	margin-left:20px;	
}

</style>
</head>

<body>
<?php

	include("conexion.php");
	
	
	
	if (!isset($_POST["formulario"])){
	
		$sql_temas="SELECT * FROM temas";
		$resultado=$conexion->prepare($sql_temas);
		$resultado->execute(array());
	} else {
		echo "Tema elegido<br>";
		
		if (isset($_GET['apartado'])){	
			$apartado=$_GET['apartado_elegido'];
			echo "Boton Elegir Apartado pulsado";
		
		} else {
			
			$tema = $_GET['tema'];
			$sql_apartados="SELECT * FROM apartados WHERE Tema = '" . $tema . "'";
			$result_apartados=$conexion->prepare($sql_apartados);
			$result_apartados->execute(array());
			echo "Boton Elegir Tema pulsado: " . $tema . "<br>";
			
		}
	
	}
	



?>
<h1>Test Oposiciones</h1>
<form id="formulario" action="<?php echo $_SERVER['PHP_SELF'];  ?>" method="post" >
<?php
	if($num_preguntas==0){
		if ($tema=="") {  //Si no se ha elegido un Tema preparar el formulario para elegirlo
			echo "<p><label for='tema'>Tema: </label>";
    		echo "<select name='tema' id='tema'  contenteditable='false'>";
			while($registros=$resultado->fetch(PDO::FETCH_ASSOC)){ // Rellenar las opciones de temas				
				echo "<option>" . $registros['Tema'] . "</option><br>";	
			}
    	} else {		// Si ya se ha elegido un tema, hay que elegir un apartado
    		echo "<p><label>Tema elegido: " . $tema . "</label><input type='hidden' name='tema_elegido' value='" . $tema . "'>";
			echo "<p><label for='tema'>Apartado: </label>";
   			echo "<select name='apartado' id='tema'>";
			while($registros=$result_apartados->fetch(PDO::FETCH_ASSOC)){ //Rellenar los apartados correspondientes a ese tema
				
				echo "<option>" . $registros['Apartado'] . "</option><br>";	
			}
		}
		
	} else {
		echo "<p><label>Tema elegido: " . $tema . "</label>";
		echo "<p><label>Apartado elegido: " . $apartado . "</label><input type='hidden' name='apartado_elegido' value='" . $apartado . "'>";
		echo "<select name='preguntas' id='preguntas'>";
		echo "<option>15</option><option>25</option><option>50</option>";
		
	}
	
		?>
        
    </select></p>
    <p><input type="submit" name="formulario" value="
	<?php 
		if ($tema=="") {  // Si no se ha elegido un tema, agregar un boton de elegir tema
			echo "Elegir Tema";
		} else { // Si ya se ha elegido un tema, agregar un botón de elegir apartado
			if ($apartado==""){
			echo "Elegir Apartado";
			} else {
				echo "Elegir Preguntas";
			}
		} 
	?>"><a href="elegir_test.php"><input type="button" value="Borrar selección" name="borrar" id="borrar"></a></p>
    </form>

</body>
</html>