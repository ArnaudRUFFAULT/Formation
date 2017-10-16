
<?php 
$titre = 'Nain-MVC';
//Mis en tampon de l'affichage , qui sera enregistré dans la variable $contenu
ob_start();
 ?>
 <!-- TABLEAU QUI REPERTORIE LES CARACTERISTIQUE DU NAIN -->
	<table class="tab">
		<tr>
			<th class="tab">Nom</th>
			<th class="tab">Longueur de barbe</th>
			<th class="tab">Originaire de</th>
			<?php if ($monNain->_getGroupe() != 'aucun') { ?>
			<th class="tab">Bois dans la taverne</th>
			<th class="tab">Heure de début</th>
			<th class="tab">Heure de fin</th>
			<th class="tab">Tunnel n°</th>
			<?php } ?>
			<th class="tab">Membre du groupe n°</th>
			<?php if ($monNain->_getGroupe() != 'aucun') { ?>
				<th class="tab">Acceder au groupe</th>
			<?php } ?>
			
			
		</tr>
		<tr>
			<td class="tab"><?= $monNain->_getNom() ?></td>
			<td class="tab"><?= $monNain->_getBarbe().' cm' ?></td>
			<td class="tab"><a <?='href="index.php?c=ville&a=afficherCaracteristiqueVille&ville='.$infoMonNain['IDOrigine'].'"' ?>><?= $infoMonNain['villeOrigine'] ?></a></td>
			<?php if ($monNain->_getGroupe() != 'aucun') { ?>
			<td class="tab"><a href=<?='"index.php?c=taverne&a=afficherCaracteristiqueTaverne&taverne='.$infoMonNain['t_id'].'"' ?>><?= $infoMonNain['t_nom'] ?></a></td>
			<td class="tab"><?= $infoMonNain['g_debuttravail'] ?></td>
			<td class="tab"><?= $infoMonNain['g_fintravail'] ?></td>
			<td class="tab"><?= $infoMonNain['tunnelID'].': de <a href="index.php?c=ville&a=afficherCaracteristiqueVille&ville='.$infoMonNain['DepartID'].'">'.$infoMonNain['villeDepart'].'</a> à <a href="index.php?c=ville&a=afficherCaracteristiqueVille&ville='.$infoMonNain['ArriveeID'].'">'.$infoMonNain['villeArrive'].'</a>' ?></td>
			<?php } ?>
			<td class="tab">
				<form action="index.php" method="GET">
				<input type="hidden" name="c" value="nain">
				<input type="hidden" name="a" value="changerGroupe">
				<input type="hidden" name="nain" value=<?= '"'. $monNain->_getID() .'"' ?>>
				<select name='nouveauGroupe'>
					<option value='aucun' <?php $aucun = $monNain->_getGroupe() == 'aucun' ? 'selected':''; echo $aucun; ?>>aucun</option>
					<?php
					foreach ($mesGroupes as $key => $value) {
						if ($value->_getID() == $monNain->_getGroupe()) {
							echo '<option value="'.$value->_getID().'" selected >' . $value->_getID() . '</option>';			
						}
						else{
							echo '<option value="'.$value->_getID().'" >' . $value->_getID() . '</option>';
						}
					}
					?>
				</select>	
				<input type="submit" value="Ok">
				</form>
			</td>
			<?php if ($monNain->_getGroupe() != 'aucun') { ?>
			<td><a href=<?='"index.php?c=groupe&a=afficherCaracteristiqueGroupe&groupe='.$monNain->_getGroupe().'"' ?>><?=$monNain->_getGroupe()?> </a></td>
			<?php } ?>

		</tr>
	</table>
	<?php 
	//ici on récupère le tampon dans notre variable $contenu puis on le nettoie, si il est vide affiche un message
	$contenu = !empty(ob_get_contents()) ? ob_get_clean() : 'Aucun contenu a afficher';
	//On inclu notre gabarit
	include('Views/common.php');
