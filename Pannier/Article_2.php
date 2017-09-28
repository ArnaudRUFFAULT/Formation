<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Article 2</title>
</head>
<body>
	<?php
		include 'Header.php';
	?>
	<div class="ArticlePresentation">
		<h2>Clavier</h2>
		<img src="Images/Clavier.jpg" alt="Clavier">
		<p>Clavier de jeu mécanique SteelSeries Apex M500</p>
		<?php echo "<p classe='prix'>".$_SESSION['PrixArticle_2']." $</p>"; ?>
		<form action="Traitement.php" method="POST">
			<input type="number" name="Nombre"  value="1" placeholder="Quantité">
			<button name=Article Value='Article_2'>Ajouter au Panier</button>
		</form>
	</div>
	<?php
		include 'Footer.php';
	?>
</body>
</html>