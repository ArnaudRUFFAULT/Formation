<?php
	session_start();
	echo "SESSION: ";
	print_r($_SESSION);
	echo "<br>";
	echo "POST: ";
	print_r($_POST);
	echo "<br>";
	//On cherche les Utilisateurs autorisé dans ce tableau
	$Utilisateur=array();
	$Utilisateur[]=array('Pseudo'=>'Perso1','Password'=>'Password1','Droit'=>'Utilisateur');
	$Utilisateur[]=array('Pseudo'=>'Perso2','Password'=>'Password2','Droit'=>'Admin');
	$Utilisateur[]=array('Pseudo'=>'Perso3','Password'=>'Password3','Droit'=>'SuperAdmin');

	//On Verifie le formulaire de connection au compte et on met les données en session
	if(isset($_POST['Pseudo'])){
		for ($i=0; $i < count($Utilisateur) ; $i++) { 
			if($Utilisateur[$i]['Pseudo']==$_POST['Pseudo'] AND $Utilisateur[$i]['Password']==$_POST['Password']){
				$_SESSION['Utilisateur']=$Utilisateur[$i];
				header("location:Interface_Listing.php");
			}
		}
		echo "Mot de passe ou Pseudo incorrecte!";
	}

	//Détruit les fichiers Valeurs et Cle si l'utilisateur l'a demandé
	if(isset($_GET ['supprimerdonnees']) AND $_GET ['supprimerdonnees']==1){
		$supfile=fopen('Valeur.txt', 'w');
		fwrite($supfile,'');
		fclose($supfile);
		$supfile=fopen('Cle.txt', 'w');
		fwrite($supfile,'');
		fclose($supfile);
		header("Location:Interface_Listing.php");
	}

	//Deconnecte l'utilisateur
	if(isset($_GET ['supprimerdonnees']) AND $_GET ['supprimerdonnees']==2){
		session_destroy();
		header("Location:Interface_Listing.php");
	}

	//On supprime une ligne si l'utilisateur l'a demandé
	if(isset($_POST['Suprligne'])){
		$ressource=fopen('Valeur.txt','r');
		$contenu=fread($ressource, filesize('Valeur.txt'));
		fclose($ressource);
		$contenu=explode(PHP_EOL, $contenu);
		unset($contenu[$_POST['Suprligne']]);
		$contenu= array_values($contenu);
		$contenu=implode(PHP_EOL, $contenu);
		$ressource=fopen('Valeur.txt', 'w');
		fwrite($ressource, $contenu);
		fclose($ressource);
		header("Location:Interface_Listing.php");
	}

	//On modifie une ligne si l'utilisateur l'a demandé
	if(isset($_POST['Modifligne'])){	
		$ressource=fopen('Valeur.txt','r');
		$contenu=fread($ressource, filesize('Valeur.txt'));
		fclose($ressource);
		$contenu=explode(PHP_EOL, $contenu);
		$contenuExplode=explode(" ",$contenu[$_POST['Modifligne']]);

	}

	if(isset($_POST['nom'])){
		//On écrit 'Non renseigné'' si un des champs n'a pas été rempli
		foreach ($_POST as $key => $value) {
			if($_POST[$key]==""){$_POST[$key]='non_renseigne';}
		}

		//On crée le fichier 'Valeur' avec les valeurs inscrites dans le formulaire
		$AjoutLigneValeur=implode( ' ', $_POST);
		$AjoutLigneValeur=$AjoutLigneValeur.PHP_EOL;
		$Valeur=fopen('Valeur.txt', 'a');
		fwrite($Valeur, $AjoutLigneValeur);
		fclose($Valeur);

		//On crée le fichier 'Cle' avec les clé des "'name'" du formulaire
		$TabCle=array_keys($_POST);
		$LigneCle=implode(' ', $TabCle);
		$Cle=fopen('Cle.txt','w');
		fwrite($Cle, $LigneCle);
		fclose($Cle);
		header("Location:Interface_Listing.php");

	}	
	//On récupere les données du fichier Clé pour le mettre dans un tableau exploitable
	if(filesize('Cle.txt')>0){
		$Cle=fopen('Cle.txt','r');
		$TabCle=fread($Cle, filesize('Cle.txt'));
		$TabCle=explode(' ', $TabCle);
		echo "CLE: ";
		print_r($TabCle);
		echo "<br>";
	}
	//On récupere les données du fichier Valeur pour le mettre dans un tableau exploitable
	if(filesize('Valeur.txt')>0 AND !isset($_POST['Modifligne'])){
		$Valeur=fopen('Valeur.txt','r');
		$TabValeurLigne=fread($Valeur,filesize('Valeur.txt'));
		$TabValeurLigne=explode(PHP_EOL, $TabValeurLigne);
		unset($TabValeurLigne[count($TabValeurLigne)-1]);
		for ($i=0; $i < count($TabValeurLigne) ; $i++) { 
			$TabValeur[$i]=explode(' ', $TabValeurLigne[$i]);
		}
		echo "VALEUR: ";
		print_r($TabValeur);
		echo "<br>";
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Exo_Listing_Bis</title>
	<meta charset="utf-8">
	<style type="text/css">
		table,td{
			border:1px black solid;
			border-collapse: collapse;
			text-align: center;
		}
		table tr:nth-child(1){
			font-weight: bolder;
			text-transform: uppercase;
		}
	</style>
</head>
<body>
	<!--ON CREE LE FORMULAIRE POUR SE CONNECTER A SON COMPTE -->
	<?php
	if(!isset($_SESSION['Utilisateur'])){
	?>
	<form action="" method="POST">
		<input type="text" name="Pseudo" placeholder="Pseudo">
		<input type="text" name="Password" placeholder="Password">
		<input type="submit" value="Valider">
	</form>
	<?php
	}
	?>
	<!--ON CREE LE FORMULAIRE POUR AJOUTER UNE LIGNE -->
	<?php
	if(isset($_SESSION['Utilisateur'])){
		echo "<p>Bonjour ".$_SESSION['Utilisateur']['Pseudo']."!<p>";
		echo "<p><a href='Interface_Listing.php?supprimerdonnees=2&'>Se deconnecter</a></p>";
		//ON EMPECHE L'UTILISATEUR SANS DROIT DE MODIFIER LE TABLEAU
		if($_SESSION['Utilisateur']['Droit']!='Utilisateur'){
			if(!isset($_POST['Modifligne'])){
				?>

				<form action="" method="POST">
					<input type="text" name="nom" placeholder="NOM">
					<input type="text" name="prenom" placeholder="Prénom">
					<input type="text" name="age" placeholder="Age">
					<input type="text" name="ville" placeholder="Ville">
					<input type="submit" value="Valider">
				</form>
			<!--ON CREE LE TABLEAU QUI AFFICHE LES INFORMATION DU FICHIER VALEUR -->
			<?php 
			}
			else{
				?>
				<form action="" method="POST">
					<?php
						for ($i=0; $i < count($TabCle); $i++) { 
						echo "<input type='text' value='".$contenuExplode[$i]."' name='".$i."' placeholder='".$contenuExplode[$i]."'>";
					}

					?>
				<input type="submit" value="Modifier" name="ModifAFaire">
				</form>
			<?php 

			}
		}
		if(isset($TabValeur)){ 
		?>
		<table>
			<tr><?php
				for ($i=0; $i < count($TabCle); $i++) { 
					echo "<td>".$TabCle[$i]."</td>";
				}
			?></tr>
			<?php
				for ($j=0; $j < count($TabValeur); $j++) { 
					echo "<tr>";
					for($i=0; $i < count($TabCle); $i++){
						echo "<td>".$TabValeur[$j][$i]."</td>";
					}
					if($_SESSION['Utilisateur']['Droit']!='Utilisateur'){
						echo "<td><form action='' method='POST'><button name='Modifligne' value='".$j."'>Modifier</form></td>";
					}
					//ON PERMET A SUPERADMIN DE SUPPRIMER DES LIGNES
					if($_SESSION['Utilisateur']['Droit']=='SuperAdmin'){
						echo "<td><form action='' method='POST'><button name='Suprligne' value='".$j."'>X</form></td>";
					}
					echo "</tr>";
				}
			?>
			</table>
			<?php
		}
			?>
		<?php echo "<p><a href='Interface_Listing.php?supprimerdonnees=1&'>Supprimer le Tableau</a></p>";?>
		<?php
	}
	?>
</body>
</html>