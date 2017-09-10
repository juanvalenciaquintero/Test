<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
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
	width:90%;
	
}

.opcion{
	
	width:30%;
}
.normal,.correcto,.resto{
    background-color:#FFDD9F;   
}
.resto{
    background-color:#E8E8E8;
}
.seleccionado{
    background-color:orange;
}
.acertado,.acertado_usuario{
    background-color:#63ffa6;
}
.fallado{
    background-color:#ff8367;
}

</style>

<script>
$(document).ready(function(){ 
    $(".preguntas td").mouseenter(function(){
        if($(this).attr('class')=='normal'){
            $(this).addClass('seleccionado');
        }
    });
    $(".preguntas td").mouseleave(function(){
        if($(this).attr('class')=='seleccionado'){
            $(this).removeClass().addClass('normal');
        }
      
    });
    $(".preguntas td").click(function(){
        if($(this).attr('class')=='seleccionado'){            /*si acierta*/
            $(this).removeClass().addClass('acertado_usuario');
            $(this).siblings('.normal').removeClass().addClass('resto');
        }
        else if($(this).attr('class') == 'seleccionado') {       /*si no acierta*/
            $(this).removeClass().addClass('fallado');
            $(this).siblings('.normal').removeClass().addClass('resto');
            $(this).siblings('.correcto').removeClass().addClass('acertado');
        }
        $(this).attr("disabled", true);
        $(this).siblings().attr("disabled", true);
        $(this).css('cursor', 'default');                         
        $(this).siblings().css('cursor', 'default');              
            
        correctas = $('.acertado_usuario').size();
        falladas = $('.fallado').size();
        no_answer = $('.correcto').size();
        $("#resultado_a").html("Correctas: "+correctas);
        $("#resultado_b").html("Incorrectas: "+falladas);
        $("#resultado_c").html("Sin respuesta: "+no_answer);
    });
});
</script>
</head>

<body>

<?php
	include ("crear_aleatorio.php");
	include ("conexion.php");
	$tema=$_GET['tema'];
	$apartado=$_GET['apartado'];
	$preguntas=$_GET['preguntas'];
	echo "<br>Ha elegido hacer el test con " . $preguntas . " preguntas.<br>";

	$sql_preguntas="SELECT * FROM preguntas WHERE Tema='" . $tema . "' and Apartado='" . $apartado . "'";
	$resultado_preguntas=$conexion->prepare($sql_preguntas);
	$resultado_preguntas->execute(array());  //Localizar las preguntas que coinciden con los criterios

	$contador=0;
while ($pregunta=$resultado_preguntas->fetch(PDO::FETCH_ASSOC)){
	
		
		$id=$pregunta['Id'];
		$preg=$pregunta['Pregunta'];
		$resp=$pregunta['Respuesta'];
		$tem=$pregunta['Tema'];
		$apart=$pregunta['Apartado'];
		
	
		
		
						
		$contador++;
		$num=$contador;
	
		$sql = "INSERT INTO Temporal (NumeroPregunta, Id, Pregunta, Respuesta, Tema, Apartado) VALUES (:num, :id, :preg, :resp, :tem, :apart)";
	
		$resultado=$conexion->prepare($sql);
		$resultado->execute(array(":num"=>$num, ":id"=>$id, ":preg"=>$preg, ":resp"=>$resp, ":tem"=>$tem, ":apart"=>$apart));
	
}


if ($preguntas>$contador){
	$preguntas=$contador;	
	
} else {
	
	
}

echo "Total de preguntas en la base de datos: " . $contador . "<br>";
echo "Hacer test con " . $preguntas . " preguntas.<br>";

$aleatorio= new Crea_aleatorio();
$matriz=$aleatorio->get_Aleatorio($preguntas,$contador);



for ($i=0;$i<$preguntas;$i++){
	
	$posicion=$i+1;
	//echo "Posición: " . $posicion . "<br>";
	
	$numero = $matriz[$i]; 
	//echo "Número: " . $numero . "; ";
	
	$sql="SELECT * FROM temporal WHERE NumeroPregunta = " . $numero . "";

	$resultado=$conexion->prepare($sql);
	$resultado->execute(array());
	$pregunta_aleatoria=$resultado->fetch(PDO::FETCH_ASSOC);
	
	$id=$pregunta_aleatoria['Id'];
	//echo "Id pregunta aleatoria: " . $id . ";  ";
	$resp=$pregunta_aleatoria['Respuesta'];
	//echo "Respuesta aleatoria: " . $resp . "; ";
	
	$sql_respuestas = "SELECT * FROM respuestas WHERE Id=" . $id . "";
	$resultado_respuestas=$conexion->prepare($sql_respuestas);
	$resultado_respuestas->execute(array());  //Localizar las respuestas de esas preguntas
		
	
	$matriz2=$aleatorio->get_Aleatorio(4,4);
	
	for ($x=0;$x<4;$x++){
		
		switch ($x) {
					case 0: $respu = 'a';
							break;
					case 1: $respu = 'b';
							break;
					case 2: $respu = 'c';
							break;
					case 3: $respu = 'd';
							break;
					}
	 switch ($matriz2[$x]) {
					case 1: $sol_alea = 'a';
							break;
					case 2: $sol_alea = 'b';
							break;
					case 3: $sol_alea = 'c';
							break;
					case 4: $sol_alea = 'd';
							break;
					}
		$sql_resultadoaleatorio="INSERT INTO resultadoaleatorio (Id, Resultado, ResultadoAleatorio) VALUES (:id, :res, :res_alea)";
		$resultado_aleatorio=$conexion->prepare($sql_resultadoaleatorio);
		$resultado_aleatorio->execute(array(":id"=>$posicion, ":res"=>$respu, ":res_alea"=>$sol_alea));
					
	} //Fin del bucle for		
	
	//echo "<br>Posición en tabla ResultadoAleatorio: " . $posicion . "<br>";
	//echo "Respuesta correcta: " . $resp . "<br>";
	
	$sql_seleccionarrespuesta="SELECT * FROM resultadoaleatorio WHERE Id=" . $posicion . " AND Resultado='" . $resp . "'";
	$resultado_correcto=$conexion->prepare($sql_seleccionarrespuesta);
	$resultado_correcto->execute(array());
	$resultado_co=$resultado_correcto->fetch(PDO::FETCH_ASSOC);
	$letra_resultado=$resultado_co['ResultadoAleatorio'];
	
	//echo "Resultado aleatorio: " . $letra_resultado . "<br>";				
		
	$sql="INSERT INTO resultados (Pregunta, Id, Solucion,RespuestaAleatoria ) VALUES (:num, :id, :sol, :sol_alea)";
	$resultado_aleatorio=$conexion->prepare($sql);
	$resultado_aleatorio->execute(array(":num"=>($i+1), ":id"=>$id, ":sol"=>$resp, ":sol_alea"=>$letra_resultado));
	
}

	$sql_preguntas="SELECT * FROM resultados";
	$resultado_preguntas=$conexion->prepare($sql_preguntas);
	$resultado_preguntas->execute(array());

	$contador=0;
while ($pregunta=$resultado_preguntas->fetch(PDO::FETCH_ASSOC)){
	
		echo "<table class='preguntas'><tr><td>";
		echo "<strong>Pregunta " . $pregunta['Pregunta'] . ":  ";
		$id=$pregunta['Id'];
		$sql_preg="SELECT * FROM preguntas WHERE Id=" . $id . "";
		$resultado_preg=$conexion->prepare($sql_preg);
		$resultado_preg->execute(array());
		$pregunt=$resultado_preg->fetch(PDO::FETCH_ASSOC);
		
		$preg=$pregunt['Pregunta'];
		$resp=$pregunt['Respuesta'];
		$tem=$pregunt['Tema'];
		$apart=$pregunt['Apartado'];
		
		echo "  " . $preg;
		echo "<br>Tema: " . $tem . "<br>Apartado: " . $apart;
		
		$sql_respuestas = "SELECT * FROM respuestas WHERE Id=" . $id . "";
		$resultado_respuestas=$conexion->prepare($sql_respuestas);
		$resultado_respuestas->execute(array());
		
		while($respuestas=$resultado_respuestas->fetch(PDO::FETCH_BOTH)){;
		
			echo "</strong></td></tr>";
			echo "<tr><td class='normal'><label>
    <input type='radio' name='RadioGroup" . $contador . "'  id='RadioGroup" . $contador . "_" . $respuestas[1] . "'></label><strong>" . $respuestas[1] . "</strong>: " . $respuestas[2] . "</td></tr>";
			
		}
	
	echo "</table>";
	
	
	$contador++;
	$num=$contador;
	
	
	
}

echo "<input type='button' id='comprobar' value='Comprobar'>";



?>
</body>
</html>