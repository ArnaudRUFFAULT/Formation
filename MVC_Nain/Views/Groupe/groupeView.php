
	<?php
	$titre ='Groupe-MVC';
	//Mis en tampon de l'affichage , qui sera enregistré dans la variable $contenu
	ob_start(); 
	?>
	<!-- ON LISTE LES NAINS DU GROUPE -->
	<p>Les nains suivant appartiennent au groupe n° <?=$monGroupe->_getID()?>:</p>
	<ul>
	<?php
	foreach ($mesNains as  $value) {
		echo '<li><a href="index.php?c=nain&a=afficherCaracteristiqueNain&nain='.$value->_getID().'">'.$value->_getNom().'</a></li>';
	}
	?>
	</ul>
	<!-- ON AFFICHE LA TAVERNE DU GROUPE SI IL Y EN A UNE , SINON ON AFFICHE UN MESSAGE PAS DE TAVERNE -->
	<?php
	if ($maTaverne) {
		echo '<p>Ils viennent boire dans la taverne <a href="index.php?c=taverne&a=afficherCaracteristiqueTaverne&taverne='.$maTaverne->_getID().'">"'.$maTaverne->_getNom().'"</a>.</p>';
	}
	else{
		echo '<p>Ce groupe n\'a pas de taverne attitrée.</p>';
	}
	//SI LE GROUPE EST AFFECTE A UN TUNNEL, ON AJOUTE DES PRECISIONS
	if($monGroupe->_getTunnel()){
	$action = $monTunnel->_getProgres() < 100 ? 'creuse' :'entretien';
	?>
	<p>Le groupe n° <?=$monGroupe->_getID().' '.$action?> le tunnel n°<?=$monTunnel->_getID()?> qui relie <?= $mesVilles[0]->_getNom()?> à <?= $mesVilles[1]->_getNom()?> de <?=$monGroupe->_getDebutTravail()?> à <?=$monGroupe->_getFinTravail()?>.</p>
	<!-- FORMULAIRE POUR CHANGER LES HORAIRES DE TRAVAIL -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="groupe">
		<input type="hidden" name="a" value="changerHoraire">
		<input type="hidden" name="groupe" value=<?= '"'.$monGroupe->_getID().'"'?>>
		<label>Heure de début:</label>
		<input type="text" name="debut" value=<?= '"'.$monGroupe->_getDebuttravail().'"'?>>
		<label>Heure de fin:</label>
		<input type="text" name="fin" value=<?= '"'.$monGroupe->_getFintravail().'"'?>>
		<input type="submit" value="Ok">
	</form>
	<?php } 
	else{
	 echo '<p>Aucun tunnel attitré</p>';
	}?>
	<!-- FORMULAIRE POUR CHANGER LE TUNNEL DU GROUPE -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="groupe">
		<input type="hidden" name="a" value="changerTunnel">
		<input type="hidden" name="groupe" value=<?= '"'.$monGroupe->_getID().'"'?>>
		<label>Modifier le tunnel:</label>
		<select name='tunnel'>
			<?php $select = $monGroupe->_getTunnel()==NULL? 'selected':'';
			echo '<option value="aucun" '.$select.'>aucun</option>';
			
			foreach ($listeTunnels as $value) { 
				$select = $monGroupe->_getTunnel()==$value->_getID() ? 'selected':'';
				echo '<option value="'.$value->_getID().'" '.$select.'>'.$value->_getID().'</option>';
			}
			?>
		</select>
		<input type="submit" value="Ok">
	</form>
	<!-- FORMULAIRE POUR CHANGER LA TAVERNE DU GROUPE -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="groupe">
		<input type="hidden" name="a" value="changerTaverne">
		<input type="hidden" name="groupe" value=<?= '"'.$monGroupe->_getID().'"'?>>
		<label>Modifier la taverne:</label>
		<select name='taverne'>
			<?php $select = $monGroupe->_getTaverne()==NULL? 'selected':'';
			echo '<option value="aucun" '.$select.'>aucun</option>';
			
			foreach ($listeTavernes as $value) { 
				if (count($mesNains) <= $value->_getPlacesLibres()) {
					$select = $monGroupe->_getTaverne()==$value->_getID() ? 'selected':'';
				echo '<option value="'.$value->_getID().'" '.$select.'>'.$value->_getNom().'</option>';
				}
				
			}
			?>
		</select>
		<input type="submit" value="Ok">
	</form>
	<?php 
	//ici on récupère le tampon dans notre variable $contenu puis on le nettoie, si il est vide affiche un message
	$contenu = !empty(ob_get_contents()) ? ob_get_clean() : 'Aucun contenu a afficher';
	//On inclu notre gabarit
	include('Views/common.php');