<!DOCTYPE html>
<html>
<head>
	<title>Produits</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>Prestations Supplémentaires</h1>
	<h2>Votre article</h2>
	<table>
		<tr>
			<th>Nom</th>
			<td><?=$commande->getProduit()->getNom()?></td>
		</tr>
		<tr>
			<th>Prix</th>
			<td><?=$commande->getProduit()->getPrix().'$'?></td>
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
	<form method="POST" action="index.php?controller=commande&action=calculerprix">
		<input type="hidden" name="idProduit" value=<?='"'.$commande->getProduit()->getId().'"'?>>
		<p>Services optionnelles :</p>
		<div>
			<?php
			foreach ($services as $key => $value) {
				if($value['s_id']!= 2 || ($value['s_id']== 2 && $commande->getProduit()->getInstallable() == 1)){
					echo '<input type="checkbox" id="'.$value['s_nom'].'" name="'.$value['s_id'].'" value="'.str_replace(' ','',ucwords($value['s_nom'])).'">';
					echo '<label for="'.$value['s_nom'].'">'.$value['s_nom'].'</label>';
				}
			}
			?>
		</div>
		<hr />
		<div>
			<label for="garantie">Extension de garantie</label>
			<select name="garantie" id="garantie">
				<option value="0">aucune</option>
				<option value="1">1 an</option>
				<option value="2">2 ans</option>
				<option value="3">3 ans</option>
				<option value="4">4 ans</option>
				<option value="5">5 ans</option>
			</select>
		</div>
		<hr />
		<div>
			<button type="submit">Envoyer</button>
		</div>
	</form>
	<hr>
	<a href="index.php?controller=produit&action=getAllProducts">retour</a>
	<br />
	<a href="index.php?controller=user&action=seDeconnecter">Deconnection</a>
</body>
</html>