<?php
$titre = 'Taverne-MVC';
//Mis en tampon de l'affichage , qui sera enregistré dans la variable $contenu
ob_start();
?>
<h3><?= $maTaverne->_getNom()?></h3>
<!-- VILLE DE LA TAVERNE -->
<p><?= $maTaverne->_getNom()?> se situe dans la bourgade de <a href=<?= '"index.php?c=ville&a=afficherCaracteristiqueVille&ville='.$maVille->_getID().'"'?>><?= $maVille->_getNom()?></a></p>
<p>Cette taverne sert les bières ci-dessous:</p>
<!-- LISTE DES BIERES DISPONIBLES -->
<ul>
	<?php
	if($maTaverne->_getRousse()){echo '<li>Rousse</li>';}
	if($maTaverne->_getBlonde()){echo '<li>Blonde</li>';}
	if($maTaverne->_getBrune()){echo '<li>Brune</li>';}
	?>
</ul>
<!-- NOMBRE DE CHAMBRES TOTALES ET DISPONIBLES DE LA TAVERNE -->
<p><?= $maTaverne->_getNom()?> possede <?= $maTaverne->_getChambres()?> chambre(s) dont <?= $maTaverne->_getPlacesLibres()?> de libre(s).</p>
<?php
//ici on récupère le tampon dans notre variable $contenu puis on le nettoie, si il est vide affiche un message
$contenu = !empty(ob_get_contents()) ? ob_get_clean() : 'Aucun contenu a afficher';
//On inclu notre gabarit
include('Views/common.php');