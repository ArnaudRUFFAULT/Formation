<?php
var_dump($_POST);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formulaire</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="formulaire.js"></script>
</head>
<body>
	<form action="formulaire.php" method="POST" novalidate>
		<label>texte:</label>
		<input id="texte" type="texte" name="texte">
		<br />
		<br />
		<label>nombre:</label>
		<input id="nombre" type="number" name="nombre">
		<br />
		<br />
		<label>Email:</label>
		<input id="email" type="email" name="email">
		<br />
		<br />
		<label>Tel:</label>
		<input id="tel" type="tel" name="tel">
		<br />
		<br />
		<label>Select:</label>
		<select id="select" id="" name="select">
			<option value="1">01</option>
			<option value="2">02</option>
			<option value="3">03</option>
			<option value="4">04</option>
			<option value="5">05</option>
		</select>
		<br />
		<br />
		<label>Radio:</label>
		<input id="matin" type= "radio" name="tarif" value="matin"> matin
		<input id="midi" type= "radio" name="tarif" value="midi"> midi
		<input id="soir" type= "radio" name="tarif" value="soir"> soir
		<br />
		<br />
		<label>Des choix mutliples:</label><br />
		<input id="petanque" type="checkbox" name=sport value="Petanque">La pétanque <br />
    	<input id="billard" type="checkbox" name=sport value="Billard">Le billard <br />
    	<input id="tennis" type="checkbox" name=sport value="Tennis">Le tennis <br />
		<br />
		<input id="submit" type="submit" value="Valider">
	</form>
</body>
</html>