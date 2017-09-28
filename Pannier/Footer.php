<link rel="stylesheet" type="text/css" href="Sheetstyle.css" /> 
<footer>
	<a href="Index.php">Retour index</a>
	<a href='PanierModif.php' >Modifier le panier</a>
	<?php  echo "<a href='Index.php?viderpanier=1'>Vider le Panier</a>"; 
	if(isset($_SESSION['Utilisateur'])){
		echo "<a href='Index.php?deco=1&'>Se déconnecter</a>";
	}
	?>
</footer>