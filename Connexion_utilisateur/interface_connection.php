<!DOCTYPE html>
<html>
<head>
	<title>Exo_1_PHP</title>
	<meta charset="utf-8">
	<style type="text/css">
		p{
			background-color: red;
		}
	</style>
</head>
<body>
	<p>
	<?php
		if(isset($_GET['ErrorEmpty'])){
			echo "<br>".$_GET['ErrorEmpty'];
		}
		if(isset($_GET['Errornom'])){
			echo "<br>".$_GET['Errornom'];
		}
		if(isset($_GET['ErrorSizenom'])){
			echo "<br>".$_GET['ErrorSizenom'];
		}
		if(isset($_GET['ErrorConfirm'])){
			echo "<br>".$_GET['ErrorConfirm'];
		}
	?>
	</p>
	<form action="OK.php" method="GET">
		<div>
			<label for="nom">Nom:</label>
			<input name="nom" type="text" <?php if(isset($_GET['nom'])){echo " value='".$_GET['nom']."'";} ?>>
		</div>
		<div>
			<label for="mdp">Mot de passe:</label>
			<input name="mdp" type="password" <?php if(isset($_GET['mdp'])){echo " value='".$_GET['mdp']."'";} ?>>
		</div>
		<div>
			<label for="confirm">Confirmer le mot de passe:</label>
			<input name="confirm" type="password" <?php if(isset($_GET['confirm'])){echo " value='".$_GET['confirm']."'";} ?>>
		</div>
		<input type="submit" value="OK">
	</form>
</body>
</html>