<!DOCTYPE html>
<html>
<head>
	<title>Produits</title>
	<meta charset="utf-8">
	<style type="text/css">
		table{
			text-align: left;
		}
		table th{
			padding-right: 10px;
		}
	</style>
</head>
<body>
	<h1>Resumé de votre commande</h1>
	<h2>Votre article</h2>
	<table>
		<tr>
			<th>Nom</th>
			<td><?=ucfirst($commande->getProduit()->getNom())?></td>
		</tr>
		<tr>
			<th>Prix</th>
			<td style="font-weight: bolder;"><?=$commande->getProduit()->getPrix().'$'?></td>
		</tr>
		<tr>
			<th>Poids</th>
			<td><?=$commande->getProduit()->getPoids().' Kg'?></td>
		</tr>
		<tr>
			<th>Dimensions</th>
			<td><?=$commande->getProduit()->getLargeur().'*'.$commande->getProduit()->getHauteur().'*'.$commande->getProduit()->getProfondeur()?></td>
		</tr>
		<tr>
			<th>Etat</th>
			<td><?=$commande->getProduit()->getEtat()?></td>
		</tr>
	</table>
	<hr />
	<?php
	foreach ($commande->getServices() as $key => $value) {
		echo '<table>';
		echo 	'<tr>';
		echo 		'<th>Service:</th>';
		echo 		'<td>'.$value->getName().'</td>';
		echo 	'</tr>';
		if($value->getName() == 'Livraison'){
			echo 	'<tr>';
			echo 		'<th>Adresse de Livraison:</th>';
			echo 		'<td>'.$value->getAdresseLivraison().'</td>';
			echo 	'</tr>';
		}
		if($value->getName() == 'Extension de Garantie'){
			echo 	'<tr>';
			echo 		'<th>Durée:</th>';
			echo 		'<td>'.$value->getGarantie().' ans</td>';
			echo 	'</tr>';
		}
		echo 	'<tr>';
		echo 		'<th>Tarif:</th>';
		echo 		'<td>'.$value->getTarif().'$</td>';
		echo 	'</tr>';
		echo '</table>';
		echo '<hr />';
	}
	?>
	<p style="font-size: 50px;">Total:<?=$commande->getPrix().'$';?></p>
	<form action="index.php?controller=commande&action=validationCommande" method="POST">
		<input type="hidden" name="idProduit" value=<?='"'.$commande->getProduit()->getId().'"'?>>
		<input type="hidden" name="idClient" value=<?='"'.$commande->getClient()->getId().'"'?>>
		<input type="hidden" name="Total" value=<?='"'.$commande->getPrix().'"'?>>
		<?php
		foreach ($commande->getServices() as $key => $value) { 
		?>
		<input type="hidden" name=<?='"'.$value->getName().'"'?> value=<?='"'.$value->getTarif().'"'?>>
		<?php
			if($value->getName() ==  'Extension de Garantie'){
				echo '<input type="hidden" name="NbAnneesGarantie" value="'.$value->getGarantie().'">';
			}
			if($value->getName() ==  'Papier Cadeau'){
				echo '<label>Personnalisez votre cadeau avec un message:</label><br />';
				echo '<textarea name="message" rows="10" cols="50"></textarea><br />';
			}	
		}
		?>
		<button>Valider la commande</button>
	</form>
	<a href="index.php?controller=produit&action=getAllProducts">Vitrine</a>
	<br />
	<a href="index.php?controller=user&action=seDeconnecter">Deconnection</a>
</body>
</html>