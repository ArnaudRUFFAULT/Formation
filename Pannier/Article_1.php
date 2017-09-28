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
		<h1>Lap Top</h1>
		<img src="Images/LapTop.png" alt="LapTop">
		<p>PC Ultra-Portable Microsoft Surface Laptop 13.5" Tactile Intel Core i5 4Go Ram 128 Go</p>
		<?php echo "<p classe='prix'>".$_SESSION['PrixArticle_1']." $</p>"; ?>
		<form action="Traitement.php" method="POST">
			<input type="number" name="Nombre" value="1" placeholder="Quantité">
			<button name=Article Value='Article_1'>Ajouter au Panier</button>
		</form>
	</div>
	<?php
		include 'Footer.php';
	?>

</body>
</html>