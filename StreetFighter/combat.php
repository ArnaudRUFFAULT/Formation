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

$m_manager= new managerPersonnage('localhost','street_fighter','root','');
$m_fighters= $m_manager->getAllFighters();

if (isset($_GET['cible'])) { ;
	foreach ($m_fighters as $value) {
		if ($value->_getID()==$_SESSION['m_personnage']['p_id']) {
			$monAttaquant=$value;
		}
		if($value->_getID()==$_GET['cible']){
			$maVictime=$value;
		}
	}
	$result=$monAttaquant->Frapper($maVictime);
	if($result[0]=='blesse'){
		header('Location:combat.php?etat='.$result[0].'&qui='.$result[1].'&combien='.$result[2]);
	}
	else if($result[0]=='mort'){
		header('Location:combat.php?etat='.$result[0].'&qui='.$result[1]);
	}
	
	
}



if (isset($_POST['p_id'])){
	foreach ($m_fighters as $key => $value) {
		if ($m_fighters[$key]->_getID()==$_POST['p_id']) {
			$_SESSION['m_personnage']['p_id']=$m_fighters[$key]->_getID();
			$_SESSION['m_personnage']['p_nom']=$m_fighters[$key]->_getNom();
			$_SESSION['m_personnage']['p_degats']=$m_fighters[$key]->_getDegats();
		}
	}
}
if (isset($_GET['etat']) AND $_GET['etat']=='mort'){
	echo $_GET['qui'].' a été tué!<hr />';
}
else if (isset($_GET['etat']) AND $_GET['etat']=='blesse'){
	echo $_GET['qui'].' a subit '.$_GET['combien'].' de dégats!<hr />';
}







	
?>
<!DOCTYPE html>
<html>
<head>
	<title>StreetFighetrs</title>
	<link rel="stylesheet" type="text/css" href="index.style.css">
</head>
<body>
	<?php include('header.php');?>
	<h2>Votre combattant est:</h2>
	<?php echo '<p>'.$_SESSION['m_personnage']['p_nom'].'</p>'; ?>

	
	<h2>Choisi qui tu veux taper:</h2>
	<div class="choixperso">
	<?php
		foreach ($m_fighters as $key => $value) {
		if ($m_fighters[$key]->_getID()!=$_SESSION['m_personnage']['p_id']) {
			echo '<a href=combat.php?cible='.$value->_getID().'>'.$value.'</a>';
		}
	}
	?>
	</div>
	<?php
		include('footer.php');
	?>
</body>
</html>