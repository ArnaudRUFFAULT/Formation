<link rel="stylesheet" type="text/css" href="Sheetstyle.css" /> 
<?php
	$Utilisateur=array('pseudo'=>'Arnaud','password'=>'coucou');
	if(isset($_POST['pseudo']) AND $_POST['pseudo']=='Arnaud' AND isset($_POST['password']) AND $_POST['password']=='coucou'){
		$_SESSION['Utilisateur']=$_POST;
	}
	
?>
<header>
	<?php
		if(!isset($_SESSION['Utilisateur'])){
	?>

	<form action="" method="POST">
		<input type="text" name="pseudo" placeholder="Nom de compte"><br>
		<input type="text" name="password" placeholder="Mot de passe"><br>
		<input type="submit" value="Se connecter">
	</form>
	<?php
	}
	?>
	<h2>Bienvenue sur Achat.Net <?php if(isset($_SESSION['Utilisateur'])){ echo $_SESSION['Utilisateur']['pseudo'];}?> !</h2>
	<?php include('Panier.php');?>
</header>