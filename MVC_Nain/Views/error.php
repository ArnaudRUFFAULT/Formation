<?php
	$titre ='Groupe-MVC';
	//Mis en tampon de l'affichage , qui sera enregistré dans la variable $contenu
	ob_start();
	?>
	<h1><?= $error ?> !!</h1>
	<?php
	//ici on récupère le tampon dans notre variable $contenu puis on le nettoie, si il est vide affiche un message
	$contenu = !empty(ob_get_contents()) ? ob_get_clean() : 'Aucun contenu a afficher';
	//On inclu notre gabarit
	include('Views/common.php');