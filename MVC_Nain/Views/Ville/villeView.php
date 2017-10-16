<?php
$titre = 'Ville -MVC';
//Mis en tampon de l'affichage , qui sera enregistré dans la variable $contenu
ob_start();
?>	
	<h1><?= $mVille->_getNom() ?></h1>
	<h3><?= $mVille->_getNom() ?> a une superficie de <?= $mVille->_getSuperficie() ?> km².</h3>
	<!-- LISTE DES NAINS ORIGINAIRE DE CETTE VILLE -->
	<h3>Liste des nains originaires de <?= $mVille->_getNom() ?>:</h3>
	<ul>
		<?php
		foreach ($maVille['mesNains'] as $key => $value) {
			echo '<li><a href="index.php?c=nain&a=afficherCaracteristiqueNain&nain='.$value -> _getID().'">'.$value -> _getNom().'</a></li>';
		}
		?>
	</ul>
	<!-- LISTE DES TAVERNES DE LA VILLE -->
	<h3>Liste des Tavernes  de <?= $mVille->_getNom() ?>:</h3>
	<ul>
		<?php
		foreach ($maVille['mesTavernes'] as $key => $value) {
			echo '<li><a href="index.php?c=taverne&a=afficherCaracteristiqueTaverne&taverne='.$value->_getID().'">'.$value -> _getNom().'<a></li>';
		}
		?>
	</ul>
	<!-- LISTE DES TUNNELS DE LA VILLE ET LEUR DESTINATION,AFFICHE AUSSI LEUR POURCENTAGE DE PROGRESSION -->
	<ul>
		<?php
		foreach ($maVille['mesTunnels'] as $key => $value) {
			foreach ($maVille['mesVilles'] as $key2 => $value2) {
				if($value -> _getVilleArrivee() == $value2 -> _getID()){
					$progres = $value -> _getProgres() == 100 ? 'Ouvert' : $value ->_getProgres().'% <br />';
					echo 'Tunnel n°'.$value->_getID().' vers <a href="index.php?c=ville&a=afficherCaracteristiqueVille&ville='.$value2 -> _getID().'">'.$value2->_getNom().'</a>:'.$progres.' <br />';
				}
			}
		}
		?>
	</ul>
<?php
//ici on récupère le tampon dans notre variable $contenu puis on le nettoie, si il est vide affiche un message
$contenu = !empty(ob_get_contents()) ? ob_get_clean() : 'Aucun contenu a afficher';
//On inclu notre gabarit
include('Views/common.php');