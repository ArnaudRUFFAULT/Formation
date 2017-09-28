<?php
session_start();
//connexion a la BDD
try{
	$bdd= new PDO('mysql:host=localhost;dbname=nainexo;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e){
	die('Erreur : '.$e_>getMessage());
}
//on verifie qu'on a bien le bon GET et qu'il ne soit pas vide
if (isset($_GET['ville']) AND $_GET['ville']!=''){
	$ville=$_GET['ville'];
	//on verifie si cette ville existe dans la BDD
	$requete=$bdd->query('SELECT v_nom FROM ville WHERE  v_id = \''.$ville.'\'' );
	$resultat=$requete->fetchAll();

	if($resultat){	
		//on affiche la superficie
		$requete0=$bdd->query('SELECT v_superficie,v_nom  FROM ville WHERE  v_id = \''.$ville.'\'' );
		$resultat0=$requete0->fetch();
		$nomVille=$resultat0['v_nom'];
		echo $resultat0['v_nom']." a pour superficie ".$resultat0['v_superficie']. "km².<br>";
		//on affiche le nombre de taverne dans la ville , et leurs nom
		$requete2=$bdd->query('SELECT count(t_nom) AS nombre FROM taverne INNER JOIN ville ON t_ville_fk=v_id WHERE  v_id = \''.$ville.'\'' );
		$resultat2=$requete2->fetchAll();		
		echo "Il existe à ".$nomVille." ".$resultat2[0]['nombre']." taverne(s) dont voici leur nom:.";

		$requete3=$bdd->query('SELECT t_nom  FROM taverne INNER JOIN ville ON t_ville_fk=v_id WHERE  v_id = \''.$ville.'\' ORDER BY t_nom' );

		echo "<ul>";
		while ($resultat3=$requete3->fetch()){
			echo "<li>".$resultat3['t_nom']."</li>";
		}
		echo "</ul>";
		//on affiche les nains originaires de cette ville
		$requete4=$bdd->query('SELECT n_nom  FROM nain INNER JOIN ville ON n_ville_fk=v_id WHERE  v_id = \''.$ville.'\'' );
		echo "Voici la liste des nains originaire de ".$nomVille." :";
		echo "<ul>";
		while ($resultat4=$requete4->fetch()){
			echo "<li>".$resultat4['n_nom']."</li>";
		}
		echo "</ul>";
		//on affiche les tunnels relié a cette ville
		$requete5=$bdd->query('SELECT t_id  FROM tunnel INNER JOIN ville ON t_villedepart_fk=v_id WHERE  v_id = \''.$ville.'\'' );
			
		while ($resultat5=$requete5->fetch()){
			$requete6=$bdd->query('SELECT v_nom,t_id,t_progres  FROM ville INNER JOIN tunnel ON t_villearrivee_fk=v_id WHERE  t_id = \''.$resultat5['t_id'].'\'' );
			$resultat6=$requete6->fetch();
			echo "Le tunnel n° ".$resultat6['t_id']." relie ".$nomVille." à ".$resultat6['v_nom'].". Il est actuellement fini à ".$resultat6['t_progres']."% .<br>";
		}

		$requete7=$bdd->query('SELECT t_id  FROM tunnel INNER JOIN ville ON t_villearrivee_fk=v_id WHERE  v_id = \''.$ville.'\'' );
			
		while ($resultat7=$requete7->fetch()){
			$requete8=$bdd->query('SELECT v_nom,t_id,t_progres  FROM ville INNER JOIN tunnel ON t_villedepart_fk=v_id WHERE  t_id = \''.$resultat7['t_id'].'\'' );
			$resultat8=$requete8->fetch();
			echo "Le tunnel n° ".$resultat8['t_id']." relie ".$nomVille." à ".$resultat8['v_nom'].". Il est actuellement fini à ".$resultat8['t_progres']."% .<br>";
		}

	}
	//si cette ville n'existe pas dans la BDD
	else {
		echo "Cette ville n'existe pas";
	}
}
//si le champs GET ville est vide
else{
	echo "vous n'avez pas choisi de villes!";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ville</title>
</head>
<body>
	<?php
	$coucouc='rr';
	include('footer.php');
	?>

</body>
</html>