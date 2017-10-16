<!-- Ceci est le gabarit commun à toutes les Views, chaque view affiche son titre dans la variable $titre et son contenu dans la variable $contenu -->
<!DOCTYPE html>
<html>
<head>
	<title><?= $titre ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./assets/css/affichageTableau.css">
</head>
<body>
	<div class="corps">
		<?= $contenu ?>
	</div>
	<footer>
		<p><a href="index.php">Retourner à l'acceuil</a></p>
	</footer>

</body>
</html>