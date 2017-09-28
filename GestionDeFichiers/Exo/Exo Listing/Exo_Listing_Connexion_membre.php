<?php
	session_start();
	echo "SESSION: ";
	print_r($_SESSION);
	echo "<br>";

	echo "POST: ";
	print_r($_POST);
	echo "<br>";

	if(isset($_GET ['decomembre']) AND $_GET ['decomembre']==1){
		foreach ($_SESSION as $key => $value) {
			if($key!='CLE' AND $key!='VALEUR'){
				unset($_SESSION[$key]);
			}
		}
		header("Location:Exo_Listing_Connexion_membre.php");
	}



	$Utilisateur=array();
	$Utilisateur[]=array('Pseudo'=>'Perso1','Password'=>'Password1','Droit'=>'Utilisateur');
	$Utilisateur[]=array('Pseudo'=>'Perso2','Password'=>'Password2','Droit'=>'Admin');
	$Utilisateur[]=array('Pseudo'=>'Perso3','Password'=>'Password3','Droit'=>'SuperAdmin');

	echo "Utilisateur: ";
	print_r($Utilisateur);
	echo "<br>";

	if(count($_POST)>1){
		for ($i=0; $i < count($Utilisateur) ; $i++) { 
			if($Utilisateur[$i]['Pseudo']==$_POST['Pseudo'] AND $Utilisateur[$i]['Password']==$_POST['Password']){
				$_SESSION['Utilisateur']=$Utilisateur[$i];
				header("location:Exo_Listing.php");
			}
		}
		echo "Mot de passe ou Pseudo incorrecte!";
	}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Connexion Membre</title>
</head>
<body>
	<h1>Espace Membre</h1>
	<form action="" method="POST">
		<input type="text" name="Pseudo" placeholder="Pseudo">
		<input type="text" name="Password" placeholder="Password">
		<input type="submit" value="Valider">
	</form>

</body>
</html>