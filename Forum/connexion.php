<?php 
if(!empty($_POST['deco'])){
	session_destroy();
	header('Location:index.php');
}
if(!empty($_POST['u_login']) AND !empty($_POST['u_id'])){
	$m_manager = managerForum::GetManagerForum();
	$user = $m_manager->ConnexionUser($_POST['u_login'],$_POST['u_id']);
	if(!$user){
		echo "Login incorrecte! <hr />";
	}
	else{
		$_SESSION['user']=$user;
	}
}
if(empty($_SESSION['user'])){
?>
<form method="POST" action="">
	<label>Login</label>
	<input type="text" name="u_login">
	<label>ID</label>
	<input type="text" name="u_id">
	<input type="submit" value="Se connecter">
</form>
<?php }
else{ 
	echo '<div class="blocUtilisateur">';
	echo '<div class="utilisateur">Bienvenue '.$_SESSION['user']['u_prenom'].' '.$_SESSION['user']['u_nom'].' !</div>';
	?>
	<form class='deco' action="" method="POST"><input name="deco" type="submit" value="Deconnexion"></form>
	<form class='deco' action="espace_membre.php" method="POST"><input name="espace" type="submit" value="Mon espace"></form>
	<?php
	echo '</div>'; } ?>
<hr />