<?php
session_start();
//Connexion a la BDD
try{
	$bdd= new PDO('mysql:host=localhost;dbname=nainexo;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e){
	die('Erreur : '.$e_>getMessage());
}
//On verifie qu'on a bien le bon GET et qu'il ne soit pas vide
if (isset($_GET['taverne']) AND $_GET['taverne']!=''){
	$taverne=$_GET['taverne'];
	//on recherche dans la BDD si cette taverne existe
	$requete=$bdd->query('SELECT t_id FROM taverne WHERE  t_id = \''.$taverne.'\'' );
	$resultat=$requete->fetchAll();
	//si elle existe , alors on traite les donnees
	if($resultat){
		$requete2=$bdd->query('SELECT v_nom,t_chambres,t_blonde,t_brune,t_rousse,t_nom FROM taverne  INNER JOIN ville ON t_ville_fk=v_id WHERE  t_id = \''.$taverne.'\'');
		$resultat2=$requete2->fetch();
		$requete3=$bdd->query('SELECT t_chambres-count(n_id) AS dispo,t_nom FROM taverne INNER JOIN groupe ON t_id=g_taverne_fk INNER JOIN nain ON g_id=n_groupe_fk WHERE t_id=\''.$taverne.'\'');
		$resultat3=$requete3->fetch();
		echo "'".$resultat2['t_nom']."' se situe dans la bourgade de ".$resultat2['v_nom'].", elle possède ".$resultat2['t_chambres']." chambres mais il n'en reste que ".$resultat3['dispo']." de disponible(s).<br>";
		echo "<br>'".$resultat3['t_nom']."' sert en comme boisson:";
		echo "<ul>";
		if($resultat2['t_blonde']){
			echo "<li>biere blonde</li>";
		}
		if($resultat2['t_brune']){
			echo "<li>biere brune</li>";
		}
		if($resultat2['t_rousse']){
			echo "<li>biere rousse</li>";
		}
		echo "</ul>";
		//On repertorie les groupes qui se detendent dans la taverne
		$requete4=$bdd->query('SELECT g_id FROM groupe INNER JOIN taverne ON g_taverne_fk=t_id WHERE t_id=\''.$taverne.'\'');
		$resultat4=$requete4->fetchAll();
		if ($resultat4){
			echo "Le(s) groupe(s) ci-dessou(s) se detend(ent) dans cette taverne:<br>";
			echo "<ul>";
			for ($i=0; $i < count($resultat4); $i++) { 
				echo "<li> groupe n° ".$resultat4[$i]['g_id']."</li>";
			}			
			echo "</ul>";
		}
		else{
			echo "Aucun groupe ne se détend ici !<br>";
		}

		
		

		
	}
	//si ce naim n'existe pas		
	else {
		echo "Cette taverne n'existe pas";
	}

	
}
//si aucun nain n'ai saisi
else{
	echo "vous n'avez pas choisi de taverne!";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>taverne</title>
</head>
<body>
	<?php
	include('footer.php')
	?>

</body>
</html>