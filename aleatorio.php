<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Documento sin título</title>
</head>

<body>
<?php

$matriz[]="";

for ($i=0;$i<5;$i++){
	
	$matriz[$i]=rand(1,8);	
}

	
	for ($limite=1;$limite<6;$limite++){
		$contador=$limite;
		do {
			$contador--;
		
		
			if ($matriz[$contador]==$matriz[$limite]){
				
				$matriz[$limite]=rand(1,8);
				$contador=$limite;
			} 
		} while ($contador>0);
		

}
for ($i=0;$i<5;$i++){
	
	echo $matriz[$i] . ", ";	
}

?>
<p>
  <label>
    <input type="radio" name="RadioGroup1" value="a" id="RadioGroup1_0">
    Opción a</label>
  <br>
  <label>
    <input type="radio" name="RadioGroup1" value="b" id="RadioGroup1_1">
    Opción b</label>
  <br>
  <label>
    <input type="radio" name="RadioGroup1" value="c" id="RadioGroup1_2">
    Opción c</label>
  <br>
  <label>
    <input type="radio" name="RadioGroup1" value="d" id="RadioGroup1_3">
    Opción d</label>
  <br>
</p>
</body>
</html>