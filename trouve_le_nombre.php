<?php 
	session_start(); 
	if(!isset($_SESSION['Historique']))	{
		$_SESSION['Historique']=array();
	}

	if(isset($_GET['deco']) AND $_GET['deco']==1){
		session_destroy();
		header("Location:Mini_jeu_interface_utilisateur.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mini Jeu</title>
</head>
<body>
	<h1>Mini Jeu: Trouver le bon nombre entre 0 et 1000</h1>
	<?php 
		if(!isset($_SESSION['NbreAleatoire'])){
			$NbreAleatoire=rand(0,1000);
			$_SESSION['NbreAleatoire']=$NbreAleatoire;
		}
		
	?>
	<p><a href="Mini_jeu_interface_utilisateur.php?deco=1&">Nouvelle Partie</a><p>
	<form action="" method="GET">
		<p><input name="saisie" type="number"> Saisissez un Nombre</input></p>
		<p><input type="submit"></input></p>
	</form>
	<?php
		if(isset($_GET['saisie']) AND $_GET['saisie']!=""){
			if($_GET['saisie']>$_SESSION['NbreAleatoire']){
				echo "Plus petit!";
				$_SESSION['Historique'][]=$_GET['saisie'];
				
			}
			if($_GET['saisie']<$_SESSION['NbreAleatoire']){
				echo "Plus grand!";
				$_SESSION['Historique'][]=$_GET['saisie'];
				
			}
			if($_GET['saisie']==$_SESSION['NbreAleatoire']){
				echo "<p style='color:green;font-size:25px;'>Vous avez gagné!</p>";
				unset($_SESSION['NbreAleatoire']);
				header("Refresh:2;url=Mini_jeu_interface_utilisateur.php?deco=1&");
			}
		}
		for($i=count($_SESSION['Historique'])-1;$i>=0;$i--){
			echo "<p>".$_SESSION['Historique'][$i]."</p>";
			

		}

	?>
</body>
</html>