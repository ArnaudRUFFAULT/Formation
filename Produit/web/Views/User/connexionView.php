<!DOCTYPE html>
<html>
<head>
	<title>Produits</title>
	<meta charset="utf-8">
</head>
<body>
	<form action="index.php?controller=User&action=connexion" method="POST">
		<?php if(isset($message['error'])){echo '<p>'.$message['error'].'</p>';}?>
		<input type="text" name="mail" placeholder="mail">
		<input type="password" name="password" placeholder="password">
		<button>Ok</button>
	</form>
	<p>Le compte test de la base de donne est mail:<b>arnaud.ruffault@hotmail.fr</b> et mot de passe : <b>password</b></p>
 
</body>
</html>