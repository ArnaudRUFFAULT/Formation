<?php
	session_start();
	echo "POST: ";
	print_r($_POST);
	echo "<br>";
	if(isset($_POST['SUP'])){
		$ressource=fopen('ExoListingValeur.txt','r');
		$contenu=fread($ressource, filesize('ExoListingValeur.txt'));
		fclose($ressource);
		$contenu=explode(PHP_EOL, $contenu);
		unset($contenu[$_POST['SUP']]);
		$contenu= array_values($contenu);
		$contenu=implode(PHP_EOL, $contenu);
		$ressource=fopen('ExoListingValeur.txt', 'w');
		fwrite($ressource, $contenu);
		fclose($ressource);
		header("Location:Exo_Listing.php?delete=1&");
	}
	if(isset($_POST['MOD'])){
		$ressource=fopen('ExoListingValeur.txt','r');
		$contenu=fread($ressource, filesize('ExoListingValeur.txt'));
		fclose($ressource);
		$contenu=explode(PHP_EOL, $contenu);
		$contenuExplode=explode(" ",$contenu[$_POST['MOD']]);
		unset($contenuExplode[count($contenuExplode)-1]);	
		
	}
	if(isset($_POST['nom'])){
		foreach ($_POST as $key => $value) {
			if($_POST[$key]==""){$_POST[$key]='non_renseigne';}
		}
		$contenuExplode=$_POST;
		$contenu=implode(' ', $contenuExplode);	
		$contenu=implode(PHP_EOL, $contenu);
		$ressource=fopen('ExoListingValeur.txt', 'w');
		fwrite($ressource, $contenu);
		fclose($ressource);
		header("Location:Exo_Listing.php?delete=1&");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Modification</title>
</head>
<body>
	<?php 
	if(isset($_POST['MOD'])){
	?>
		<form action='' method='POST'>
			<?php
				for ($i=0; $i < count($_SESSION['CLE']); $i++) { 
					echo "<input type='text' value='".$contenuExplode[$i]."' name='".$_SESSION['CLE'][$i]."' placeholder='".$contenuExplode[$i]."'>";
				}
			?>
			<input type="submit" value="Modifier">
		</form>
	<?php
	}
	?>
</body>
</html>