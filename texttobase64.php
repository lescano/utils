<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Convertir texto a base 64</title>
</head>
<body>


	<h2>Ingrese texto</h2>
	<form method="POST" action="">
		<input type="text" name="textToConvert">
		<input type="submit" name="" value="Convertir">
	</form>
	


</body>
</html>

<?php

	if (isset($_POST['textToConvert'])){
		echo "<h2>texto: ".$_POST['textToConvert'];
		echo "<br>base 64: ".base64_encode($_POST['textToConvert'])."</h2>";
	}
?>
