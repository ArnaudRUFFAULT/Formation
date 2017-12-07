<!DOCTYPE html>
<html>
<head>
	<title>Echecs</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./CSS/user.css">
</head>
<body>
	<p>Créer un compte:</p>
	<form method="POST" action="index.php?controller=user&action=addUser">
		<label>Pseudo</label>
		<input type="text" name="pseudo" placeholder="pseudo">
		<input type="submit" value="Ok">
	</form>
	<?php
	if(!empty($error['pseudo'])){echo '<div class="error">'.$error['pseudo'].'</div>';}
	?>
	<?php
	if(!empty($error['inscriptionOK'])){echo '<div class="error">'.$error['inscriptionOK'].'</div>';}
	?>
	<?php
	if(!empty($error['pseudoUtilise'])){echo '<div class="error">'.$error['pseudoUtilise'].'</div>';}
	?>
	<hr />
	<p>Se connecter</p>
	<form method="POST" action="index.php?controller=user&action=user1">
		<label>Joueur 1:</label>
		<input type="text" name="user1" placeholder="pseudo">
		<input type="submit" value="Ok">
	</form>
	<?php
	if($user1 != null){echo '<span>Joueur 1 connecté en tant que '.$user1->getPseudo().'!</span>';}
	?>
	<?php
	if(!empty($error['user1'])){echo '<div class="error">'.$error['user1'].'</div>';}
	?>
	<form method="POST" action="index.php?controller=user&action=user2">
		<label>Joueur 2:</label>
		<input type="text" name="user2" placeholder="pseudo">
		<input type="submit" value="Ok">
	</form>
	<?php
	if($user2 != null){echo '<span>Joueur 2 connecté en tant que '.$user2->getPseudo().'!</span>';}
	if(!empty($error['user2'])){echo '<div class="error">'.$error['user2'].'</div>';}
	if(!empty($_SESSION['echecs']['user1']) && !empty($_SESSION['echecs']['user2']) && $_SESSION['echecs']['user2'] != $_SESSION['echecs']['user1']){
	?>
		<hr />
		<form action="index.php?controller=game&action=refreshGame" method="POST">
			<input type="submit" value="Jouer">
		</form>
	<?php
		}
		include ('./Views/footer.php');
	?>

</body>
</html>