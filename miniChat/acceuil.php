<!DOCTYPE html>
<html>
<head>
	<title>Mini Chat</title>
	<meta charset="utf-8">
	<script type="text/javascript" src="ajax.js"></script>
	<link rel="stylesheet" type="text/css" href="minichat.css">
</head>
<body>
	<div id="historique">
	</div>
	<div id="ecrire">
		<form id="chat" method="POST" action="">
			<input type="text" name="auteur" id="auteur" placeholder="Auteur">
			<br />
			<input type="text" name="contenu" id="contenu" placeholder="Votre message (255 caractères MAX)">
			<input type="submit" name="submit" value="Envoyer">
		</form>
	</div>
</body>
</html>