<?php
	session_start();
	echo "SESSION: ";
	print_r($_SESSION);
	echo "<br>";

	echo "POST: ";
	print_r($_POST);
	echo "<br>";
	
	if(isset($_GET ['deconnexion']) AND $_GET ['deconnexion']==1){
		$supfile=fopen('ExoListingValeur.txt', 'w');
		fwrite($supfile,'');
		fclose($supfile);
		$supfile=fopen('ExoListingCle.txt', 'w');
		fwrite($supfile,'');
		fclose($supfile);
		session_destroy();
		header("Location:Exo_Listing.php");
	}
	$fileValeur='ExoListingValeur.txt';
	$fileCle='ExoListingCle.txt';
	if(count($_POST)>1 OR isset($_GET['delete'])){
		$EcrireValeur="";
		foreach ($_POST as $key => $value) {
			if($value==""){$EcrireValeur=$EcrireValeur.'non_renseigné'.' ';}
			else {$EcrireValeur=$EcrireValeur.$value.' ';}
		}
		$EcrireValeur=$EcrireValeur.PHP_EOL;
		$ressource=fopen($fileValeur, 'a');
		fwrite($ressource, $EcrireValeur);
		fclose($ressource);

		if(!isset($_SESSION['CLE'])){
			$EcrireCle="";
			foreach ($_POST as $key => $value) {
				$EcrireCle=$EcrireCle.$key.' ';
			}
			$EcrireCle=$EcrireCle.PHP_EOL;
			$ressource=fopen($fileCle, 'w');
			fwrite($ressource, $EcrireCle);
			fclose($ressource);
		

			$RecupCle=file($fileCle);
			$Cle=explode(' ', $RecupCle[0]);
			unset($Cle[count($Cle)-1]);
			$_SESSION['CLE']=$Cle;
			echo "Les clés: ";
			print_r($Cle);
			echo "<br>";
		}
		
		
			$RecupValeur=file($fileValeur);
			for ($i=0; $i < count($RecupValeur) ; $i++) { 
				$Valeur[$i]=explode(' ', $RecupValeur[$i]);
				unset($Valeur[$i][count($Valeur[$i])-1]);
			}
			$_SESSION['VALEUR']=$Valeur;
			echo "Les valeurs: ";
			print_r($Valeur);
			echo "<br>";
		
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Exo_Listing</title>
	<meta charset="utf-8">
	<style type="text/css">
		table,td{
			border:1px black solid;
			border-collapse: collapse;
		}
		table tr:nth-child(1){
			font-weight: bolder;
			text-align: center;
			text-transform: uppercase;
		}
	</style>
</head>
<body>
	<h1>Session Webdev 2017</h1>
	<?php if($_SESSION['Utilisateur']['Droit']!='Utilisateur'){ ?>
	<form action="" method="POST">
		<input type="text" name="nom" placeholder="Nom">
		<input type="text" name="prenom" placeholder="Prénom">
		<input type="text" name="age" placeholder="Age">
		<input type="text" name="ville" placeholder="Ville">
		<input  type="submit" value="Ajouter une ligne">
	</form>
	<?php
	}
	if(isset($_SESSION['CLE']) AND $_SESSION['CLE'][0]!="" ){
	?>
	<table>
		<?php
		echo "<tr>";
		for ($i=0; $i < count($_SESSION['CLE']); $i++) { 
			echo "<td>".$_SESSION['CLE'][$i]."</td>";
		}
		if($_SESSION['Utilisateur']['Droit']=='SuperAdmin'){ echo "<td>X</td>";}
		if($_SESSION['Utilisateur']['Droit']!='Utilisateur'){ echo "<td>M</td>";}
		echo "</tr>";
		for ($i=0; $i < count($_SESSION['VALEUR']); $i++) { 
			$Test=false;
			echo "<tr>";
			for ($j=0; $j < count($_SESSION['CLE']); $j++) { 
				if(isset($_SESSION['VALEUR'][$i][$j])){
					echo "<td>".$_SESSION['VALEUR'][$i][$j]."</td>";
					$Test=true;
				}
			}
			if(isset($_SESSION['VALEUR'][$i]) AND $Test==true AND $_SESSION['Utilisateur']['Droit']=='SuperAdmin'){
				echo "<td><form action='Exo_Listing_Sup.php' method='POST'><input type='submit' value='$i' name='SUP'></form></td>";
			}
			if(isset($_SESSION['VALEUR'][$i]) AND $Test==true AND $_SESSION['Utilisateur']['Droit']!='Utilisateur'){
				echo "<td><form action='Exo_Listing_Sup.php' method='POST'><input type='submit' value='$i' name='MOD'></form></td>";
			}
		}
		echo "</tr>";
		?>
	</table>
	<?php
		}
	?>
	<?php echo "<p><a href='Exo_Listing.php?deconnexion=1&'>Réinitialiser le tableau</a></p>";?>
	<?php echo "<p><a href='Exo_Listing_Connexion_membre.php?decomembre=1&.php'>Se déconnecter du compte</a></p>";?>
</body>
</html>