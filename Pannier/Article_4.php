<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lap Top</title>
</head>
<body>
	<?php
		include 'Header.php';
	?>
	<div class="ArticlePresentation">
		<h1>Casque</h1>
		<img src="Images/Casque.jpg" alt="Casque">
		<p>Casque audio Sony MDR-ZX770 Bluetooth Bleu</p>
		<?php echo "<p class='prix'>".$_SESSION['PrixArticle_4']." $</p>"; ?>
		<form action="Traitement.php" method="POST">
			<input type="number" name="Nombre" value="1"  placeholder="Quantité">
			<button name=Article Value='Article_4'>Ajouter au Panier</button>
		</form>
	</div>
	<?php
		include 'Footer.php';
	?>
</body>
</html>