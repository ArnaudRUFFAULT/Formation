<?php
	$titre = 'MVC-Les Nains';
	//Mis en tampon de l'affichage , qui sera enregistré dans la variable $contenu
	ob_start(); ?>
	<!-- SELECT POUR CHOISIR UN NAIN -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="nain">
		<input type="hidden" name="a" value="afficherCaracteristiqueNain">
		<label>Nains:</label>
		<select name="nain" id="">
			<?php
			foreach ($mesInfo['nains'] as $value) {
			echo '<option value="'.$value->_getID().'">'.$value->_getNom().'</option>';
			}
			?>
		</select>
		<input type="submit">
	</form>
	<br />
	<br />
	<!-- SELECT POUR CHOISIR UNE VILLE -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="ville">
		<input type="hidden" name="a" value="afficherCaracteristiqueVille">
		<label>Villes:</label>
		<select name="ville" id="">
			<?php
			foreach ($mesInfo['villes'] as $value) {
			echo '<option value="'.$value->_getID().'">'.$value->_getNom().'</option>';
			}
			?>
		</select>
		<input type="submit">
	</form>
	<br />
	<br />
	<!-- SELECT POUR CHOISIR UNE TAVERNE -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="taverne">
		<input type="hidden" name="a" value="afficherCaracteristiqueTaverne">
		<label>Tavernes:</label>
		<select name="taverne" id="">
			<?php
			foreach ($mesInfo['tavernes'] as $value) {
			echo '<option value="'.$value->_getID().'">'.$value->_getNom().'</option>';
			}
			?>
		</select>
		<input type="submit">
	</form>
	<br />
	<br />
	<!-- SELECT POUR CHOISIR UN GROUPE -->
	<form action="index.php" method="GET">
		<input type="hidden" name="c" value="groupe">
		<input type="hidden" name="a" value="afficherCaracteristiqueGroupe">
		<label>Groupes:</label>
		<select name="groupe" id="">
			<?php
			foreach ($mesInfo['groupes'] as $value) {
			echo '<option value="'.$value->_getID().'">'.$value->_getID().'</option>';
			}
			?>
		</select>
		<input type="submit">
	</form>	
	<br />
	<br />
	<?php
	//ici on récupère le tampon dans notre variable $contenu puis on le nettoie, si il est vide affiche un message
	$contenu = !empty(ob_get_contents()) ? ob_get_clean() : 'Aucun contenu a afficher';
	//On inclu notre gabarit
	include('Views/common.php');