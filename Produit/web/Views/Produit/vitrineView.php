<!DOCTYPE html>
<html>
<head>
	<title>Produits</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Vitrine</h1>
	<?php foreach ($products as $product){ ?>
		<table>
			<tr>
				<th>Nom</th>
				<td><?=ucfirst($product->getNom())?></td>
			</tr>
			<tr>
				<th>Prix</th>
				<td><?=$product->getPrix().'$'?></td>
			</tr>
			<tr>
				<th>Poids</th>
				<td><?=$product->getPoids().' Kg'?></td>
			</tr>
			<tr>
				<th>Dimensions</th>
				<td><?=$product->getLargeur().'*'.$product->getHauteur().'*'.$product->getProfondeur()?></td>
			</tr>
			<tr>
				<th>Etat</th>
				<td><?=$product->getEtat()?></td>
			</tr>
		</table>
		<form action="index.php?controller=Commande&action=choixServices" method="POST">
			<input type="hidden" name="idProduit" value=<?='"'.$product->getId().'"'?>>
			<button>Acheter</button>
		</form>
		<hr />
	<?php } ?>
	<a href="index.php?controller=user&action=seDeconnecter">Deconnection</a>
</body>
</html>