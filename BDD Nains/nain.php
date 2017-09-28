
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
if (isset($_GET['nain']) AND $_GET['nain']!=''){
	$nain=$_GET['nain'];
	//on recherche dans la BDD si ce nain existe
	$requete=$bdd->query('SELECT n_id FROM nain WHERE  n_id = \''.$nain.'\'' );
	$resultat=$requete->fetchAll();
	//si il existe , alors on traite les donnees
	//requete pour afficher la liste des groupes
	$requete6=$bdd->query('SELECT g_id FROM groupe ORDER BY g_id ASC');
	$groupes=$requete6->fetchAll();

	if (isset($_GET['modif_groupe'])){
		$modif_groupe=$_GET['modif_groupe'];
		if($_GET['modif_groupe']!='aucun'){		
			$requete=$bdd->query('SELECT g_id FROM groupe WHERE  g_id = \''.$modif_groupe.'\'' );
			$resultat=$requete->fetchAll();
			if($modif_groupe){
				$requete=$bdd->query('UPDATE nain SET n_groupe_fk='.$modif_groupe.' WHERE n_id = \''.$nain.'\'');
			}
		}
		if($_GET['modif_groupe']=='aucun'){
			$requete=$bdd->query('UPDATE nain SET n_groupe_fk= NULL WHERE n_id = \''.$nain.'\'');
		}		
	}


	if($resultat){
		//on cherche en fonction du nom du nom, la taille de sa barbe, de quel groupe il est et d'ou il vient
		$requete2=$bdd->query('SELECT n_nom,n_barbe,n_groupe_fk,v_nom,v_id FROM nain INNER JOIN ville ON v_id=n_ville_fk WHERE  n_id = \''.$nain.'\'');
		$resultat2=$requete2->fetchALL();
		//si il a un groupe
		if($resultat2[0]['n_groupe_fk']){
			echo $resultat2[0]['n_nom']." a une longueur de barbe de ".$resultat2[0]['n_barbe']." cm et appartient au <a href=groupe.php?groupe=".$resultat2[0]['n_groupe_fk'].">groupe n° ".$resultat2[0]['n_groupe_fk']."!</a></p>";
			}
		//si il n'a pas de groupe
		else{
			echo $resultat2[0]['n_nom']." a une longueur de barbe de ".$resultat2[0]['n_barbe']." cm et n'a pas de groupe!";
		}
		echo "<p>".$resultat2[0]['n_nom']." est originaire de <a href=ville.php?ville=".$resultat2[0]['v_id'].">".$resultat2[0]['v_nom']."!</a></p>";
		$requete3=$bdd->query('SELECT t_nom,n_nom FROM nain RIGHT JOIN groupe ON n_groupe_fk=g_id RIGHT JOIN taverne ON g_taverne_fk=t_id WHERE n_id=\''.$nain.'\'');
		$resultat3=$requete3->fetch();
		if($resultat3['t_nom']){
			echo $resultat3['n_nom']." va boire dans la taverne '".$resultat3['t_nom']."'.<br>";
		}
		$requete4=$bdd->query('
			SELECT t_id,g_id,n_nom,v_nom,g_debuttravail,g_fintravail
			FROM nain 
			LEFT JOIN groupe ON n_groupe_fk=g_id 
			LEFT JOIN tunnel ON g_tunnel_fk=t_id 
			INNER JOIN ville ON t_villedepart_fk=v_id
			WHERE n_id=\''.$nain.'\'');
		$resultat4=$requete4->fetch();
		
		$requete5=$bdd->query('
			SELECT v_nom
			FROM nain 
			LEFT JOIN groupe ON n_groupe_fk=g_id 
			LEFT JOIN tunnel ON g_tunnel_fk=t_id 
			INNER JOIN ville ON t_villearrivee_fk=v_id
			WHERE n_id=\''.$nain.'\'');
		$resultat5=$requete5->fetch();
		if($resultat4['g_id']){
			echo "<br>".$resultat4['n_nom']." travaille de ".$resultat4['g_debuttravail']." à ".$resultat4['g_fintravail']." dans le tunnel n° ".$resultat4['t_id']." qui relie ".$resultat4['v_nom']." à ".$resultat5['v_nom'].".<br><br>";
		}
		
		
	}
	//si ce naim n'existe pas		
	else {
		echo "Ce nain n'existe pas";
	}

	
}
//si aucun nain n'ai saisi
else{
	echo "vous n'avez pas choisi de nains!";
}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo  $resultat2[0]['n_nom']; ?></title>
</head>
<body>
	<form method='GET' action =''>
		<label>Modifier le groupe de <?php echo  $resultat2[0]['n_nom']; ?> </label>
			<input hidden type="text" name="nain" value="<?php echo $nain;?>">
			<select name='modif_groupe' >
			<?php
			for ($i=0; $i < count($groupes); $i++){ 
				if($groupes[$i]['g_id']!=$resultat2[0]['n_groupe_fk']){
					echo "<option> ".$groupes[$i]['g_id']."</option>";
				}	
			}
			if($resultat2[0]['n_groupe_fk']){
				echo "<option>aucun</option>";	
			}			
			?>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<?php
	include('footer.php')
	?>
</body>
</html>