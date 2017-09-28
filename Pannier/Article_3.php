<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>TEST</title>
</head>
<body>
	<?php
		include 'Header.php';
	?>
	<div class="ArticlePresentation">
		<h1>Souris</h1>
		<img src="Images/Souris.jpg" alt="LapTop">
		<p>Souris Gaming SteelSeries Rival 300 Argent</p>
		<?php echo "<p class='prix'>".$_SESSION['PrixArticle_3']." $</p>"; ?>
		<form action="Traitement.php" method="POST">
			<input type="number" name="Nombre" value="1"  placeholder="Quantité">
			<button name=Article Value='Article_3'>Ajouter au Panier</button>
		</form>
	</div>
	<?php
		include 'Footer.php';
	?>
</body>
</html>