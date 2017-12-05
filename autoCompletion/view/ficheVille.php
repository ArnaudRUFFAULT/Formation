
<!DOCTYPE html>
<html>
<head>
	<title>Fiche Ville</title>
	<meta charset="utf-8">
</head>
<body>
<?php
	if(count($maVille)>0){
?>
	<table>
		<tr>
			<th>Identifiant</th>
			<th>Departement</th>
			<th>Nom</th>
			<th>Code postal</th>
			<th>Commune</th>
			<th>Population</th>
			<th>Surface</th>
			<th>Longitude</th>
			<th>Latitude</th>
		</tr>
		<tr>
			<td><?=$maVille[0]->getId()?></td>
			<td><?=$maVille[0]->getDepartement()?></td>
			<td><?=$maVille[0]->getNom()?></td>
			<td><?=$maVille[0]->getCodePostal()?></td>
			<td><?=$maVille[0]->getCommune()?></td>
			<td><?=$maVille[0]->getpopulation()?></td>
			<td><?=$maVille[0]->getSurface()?></td>
			<td><?=$maVille[0]->getLongitude()?></td>
			<td><?=$maVille[0]->getLatitude()?></td>
		</tr>
	</table>
<?php
}
	else{
		echo 'Aucun résultat ne correspond à votre recherche';
	}
?>
	<p><a href="index.php">retour</a></p>
</body>
</html>