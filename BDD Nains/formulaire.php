<?php
session_start();
try{
	$bdd= new PDO('mysql:host=localhost;dbname=nainexo;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e){
	die('Erreur : '.$e_>getMessage());
}
//requete pour lister tous les nains
$requete=$bdd->query('SELECT n_nom,n_id FROM nain ORDER BY n_nom ASC');
$nains=$requete->fetchAll();
//requete pour lister toutes les villes
$requete2=$bdd->query('SELECT v_nom,v_id FROM ville ORDER BY v_nom ASC');
$villes=$requete2->fetchAll();
//requete pour lister toutes les tavernes
$requete3=$bdd->query('SELECT t_nom,t_id FROM taverne ORDER BY t_nom ASC');
$tavernes=$requete3->fetchAll();
//requete pour les tunnels
$requete4=$bdd->query('SELECT t_id FROM tunnel ORDER BY t_id ASC');
$tunnels=$requete4->fetchAll();
//requete pour les groupes
$requete5=$bdd->query('SELECT g_id FROM groupe ORDER BY g_id ASC');
$groupes=$requete5->fetchAll();


?>
<!DOCTYPE html>
<html>
<head>
	<title>formulaire</title>
</head>
<body>
	<!--LES NAINS-->
	<form method='GET' action ='nain.php'>
		<label>Chercher un nain: </label>
		<select name='nain'>
			<?php
			for ($i=0; $i < count($nains); $i++){ 
				echo "<option value='".$nains[$i]['n_id']."'> ".$nains[$i]['n_nom']."</option>";
			}
			?>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<!--LES VILLES-->
	<form method='GET' action ='ville.php'>
		<label>Chercher une ville: </label>
			<select name='ville'>
			<?php
			for ($i=0; $i < count($villes); $i++){ 
				echo "<option value='".$villes[$i]['v_id']."'> ".$villes[$i]['v_nom']."</option>";
			}
			?>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<!--LES TAVERNES-->
	<form method='GET' action ='taverne.php'>
		<label>Chercher une taverne: </label>
			<select name='taverne'>
			<?php
			for ($i=0; $i < count($tavernes); $i++){ 
				echo "<option value='".$tavernes[$i]['t_id']."'> ".$tavernes[$i]['t_nom']."</option>";
			}
			?>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<!--LES TUNNELS-->
	<form method='GET' action ='tunnel.php'>
		<label>Chercher un tunnel: </label>
			<select name='tunnel'>
			<?php
			for ($i=0; $i < count($tunnels); $i++){ 
				echo "<option value='".$tunnels[$i]['t_id']."'> ".$tunnels[$i]['t_id']."</option>";
			}
			?>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<!--LES GROUPES-->
	<form method='GET' action ='groupe.php'>
		<label>Chercher un groupe: </label>
			<select name='groupe'>
			<?php
			for ($i=0; $i < count($groupes); $i++){ 
				echo "<option> ".$groupes[$i]['g_id']."</option>";
			}
			?>
		</select>
		<input type="submit" value="OK">
	</form>
</body>
</html>