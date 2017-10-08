<?php
session_start();

function load($class){
	$dossier= 'classes';
	$extension = '.class.php';
	if($class[0] == 'i')
	{
		$dossier = 'interfaces';
		$extension = '.interface.php';
	}

	$nomFichier = $dossier . DIRECTORY_SEPARATOR . strtolower($class) . $extension;
	if(file_exists($nomFichier))
	{
		include($nomFichier);
	}
}

spl_autoload_register('load');

if (isset($_GET['deco']) AND $_GET['deco']==1) {
	session_destroy();
	header("Location:index.php");
}



$m_manager= new managerPersonnage('localhost','street_fighter','root','');
if (isset($_POST['newPerso']) AND $_POST['newPerso']!=NULL) {
	$m_manager->Ajouter(htmlentities($_POST['newPerso']));
}
$m_fighters= $m_manager->getAllFighters();

?>
<!DOCTYPE html>
<html>
<head>
	<title>StreetFighters</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="index.style.css">
</head>
<body>
	<?php include('header.php');?>
	<h2>Choisi un combattant</h2>
	<div class="choixperso">
	<?php
	foreach ($m_fighters as  $cle => $combattant) {
		echo $m_fighters[$cle];
	}
	?>
	</div>
	<form action="combat.php" method="POST">
		<select name="p_id">
			<?php
			foreach ($m_fighters as $key => $value) {
				echo '<option value="'.$m_fighters[$key]->_getID().'";>'.$m_fighters[$key]->_getNom().'</option>';
			}
			?>
		</select>
		<input type="submit" value="Ok">
	</form>
	<br />
	<hr />
	<br />
	<form action="" method="POST">
		<label>Creer un personnage:</label><input type='text' name='newPerso'>
		<input type="submit" value="Ok">
	</form>
	<br />
	<?php include('footer.php');?>

</body>
</html>