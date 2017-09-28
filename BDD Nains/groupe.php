<?php
session_start();
//connexion a la BDD
try{
	$bdd= new PDO('mysql:host=localhost;dbname=nainexo;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e){
	die('Erreur : '.$e_>getMessage());
}

//requete pour lister toutes les tavernes
$requete7=$bdd->query('SELECT t_nom,t_id FROM taverne ORDER BY t_nom ASC');
$tavernes=$requete7->fetchAll();
$requete7->closeCursor();
//on verifie qu'on a bien le bon GET et qu'il ne soit pas vide
if (isset($_GET['groupe']) AND $_GET['groupe']!=''){
	$groupe=$_GET['groupe'];
	//on verifie si ce groupe existe dans la BDD
	$requete=$bdd->query('SELECT g_id FROM groupe WHERE  g_id = \''.$groupe.'\'' );
	$resultat=$requete->fetchAll();

	//requete pour attribuer un autre tunnel au groupe
	$requete4=$bdd->query('SELECT t_id FROM tunnel ORDER BY t_id ASC');
	$tunnels=$requete4->fetchAll();
	if (isset($_GET['modif_tunnel'])){
		$modif_tunnel=$_GET['modif_tunnel'];
		//si on attribut un autre tunnel
		if($_GET['modif_tunnel']!='aucun'){
			$requete=$bdd->query('SELECT t_id FROM tunnel WHERE  t_id = \''.$modif_tunnel.'\'' );
			$resultat=$requete->fetchAll();
			if($modif_tunnel){
			$requete=$bdd->query('UPDATE groupe SET g_tunnel_fk='.$modif_tunnel.' WHERE g_id = \''.$groupe.'\'');
			}
		}
		//si on attribue aucun tunnel
		if($_GET['modif_tunnel']=='aucun'){
			$requete=$bdd->query('UPDATE groupe SET g_tunnel_fk= NULL WHERE g_id = \''.$groupe.'\'');
		}				
	}
	//on liste toutes les tavernes
	$requete8=$bdd->query('SELECT t_id FROM taverne ORDER BY t_id ASC');
	$modif_taverne=$requete8->fetchAll();
	//requete pour attribuer une autre taverne au groupe
	if (isset($_GET['modif_taverne'])){
		$modif_taverne=$_GET['modif_taverne'];
		//si on attribut une taverne
		if($_GET['modif_taverne']!='aucun'){
			$requete9=$bdd->query('SELECT t_id FROM taverne WHERE  t_id = \''.$modif_taverne.'\'' );
			$resultat9=$requete9->fetchAll();
			if($modif_taverne){
				//on calcule le nombre de chambres disponibles
				$requete12=$bdd->query('SELECT count(n_id) AS nombrenain FROM nain WHERE  n_groupe_fk = \''.$groupe.'\'');
				$requete11=$bdd->query('SELECT t_chambres-count(n_id) AS dispo,t_nom FROM taverne INNER JOIN groupe ON t_id=g_taverne_fk INNER JOIN nain ON g_id=n_groupe_fk WHERE t_id=\''.$modif_taverne.'\'');
				$resultat12=$requete12->fetch();
				$resultat11=$requete11->fetch();
				//on verifie qu'il y a assez de chambres
				if($resultat11['dispo']-$resultat12['nombrenain']>=0){
					$requete10=$bdd->query('UPDATE groupe SET g_taverne_fk='.$modif_taverne.' WHERE g_id = \''.$groupe.'\'');
				}
				else{ 
					echo "<p>il n'y a pas assez de chambres de disponible dans cette taverne pour ce groupe!</p>";
				}				
			}
		}
		//si on n'attribut pas de tavernes
		if($_GET['modif_taverne']=='aucun'){
			$requete=$bdd->query('UPDATE groupe SET g_taverne_fk= NULL WHERE g_id = \''.$groupe.'\'');
		}				
	}
	//requete pour changer les horaires du groupe
	if(isset($_GET['debut']) AND $_GET['debut']!='' AND isset($_GET['fin']) AND $_GET['fin']!=''){
		$debut=htmlentities($_GET['debut']);
		$fin=htmlentities($_GET['fin']);
		$requete6=$bdd->prepare('UPDATE groupe SET g_debuttravail=:newdebut,g_fintravail=:newfin WHERE g_id= \''.$groupe.'\'' );
		$requete6->bindValue(':newdebut',$debut);
		$requete6->bindValue(':newfin',$fin);
		$requete6->execute();
}

	if($resultat){	
		//on affiche les horaires du groupe, sa taverne et son tunnel.
		$requete2=$bdd->query('SELECT g_debuttravail,g_fintravail, g_tunnel_fk,t_nom  FROM groupe LEFT JOIN taverne ON t_id = g_taverne_fk WHERE  g_id = \''.$groupe.'\'' );
		$resultat2=$requete2->fetch();
		echo "<p>Le groupe n° ".$groupe." travail de ".$resultat2['g_debuttravail']." à ".$resultat2['g_fintravail'].".</p>";
		//on affiche le tunnel associé , ou bien rien si il n'y en a pas
		if($resultat2['g_tunnel_fk']){
			echo "<p>Il travail dans le tunnel n°".$resultat2['g_tunnel_fk'].".</p>";
		}
		else{
			echo "<p>Aucun tunnel attribué.</p>";
		}
		//on affiche la taverne associée ou bien rien si il n'y en a pas
		if($resultat2['t_nom']){
			echo "<p>Il se détent dans la taverne '".$resultat2['t_nom']."'.</p>";
		}
		else{
			echo "<p>Aucune taverne associée</p>";
		}

		$requete3=$bdd->query('SELECT count(n_id) AS nombre FROM nain INNER JOIN groupe ON n_groupe_fk=g_id WHERE  g_id = \''.$groupe.'\'' );
		$resultat3=$requete3->fetchAll();		
		echo "<p>Le groupe ".$groupe." est constitué de ".$resultat3[0]['nombre']. " nains:</p>";
		//on cherche les nains qui font parti du groupe
		$requete4=$bdd->query('SELECT n_nom  FROM nain INNER JOIN groupe ON g_id=n_groupe_fk WHERE  g_id = \''.$groupe.'\' ORDER BY n_nom ');
		//on liste les nains qui fotn parti du groupe
		echo "<ul>";
		while ($resultat4=$requete4->fetch()){
			echo "<li>".$resultat4['n_nom']."</li>";
		}
		echo "</ul>";
		//on cherche les villes d'arrivées= et départ du tunnel dont le groupe est affecté
		//depart
		$requete5=$bdd->query('SELECT  t_progres,v_nom,g_id,v_id FROM groupe INNER JOIN tunnel ON g_tunnel_fk=t_id INNER JOIN ville ON t_villedepart_fk=v_id WHERE g_id = \''.$groupe.'\'');
		$resultat5=$requete5->fetch();
		//arrivee
		$requete6=$bdd->query('SELECT  v_nom,v_id FROM groupe INNER JOIN tunnel ON g_tunnel_fk=t_id INNER JOIN ville ON t_villearrivee_fk=v_id WHERE g_id = \''.$groupe.'\'');
		$resultat6=$requete6->fetch();
		//On personnalise le message si le tunnel est fini ou en cours...
		if($resultat5['t_progres']){
			if($resultat5['t_progres']==100){
				echo "Le groupe n° ".$resultat5['g_id']." entretien le tunnel qui relie ".$resultat5['v_nom']." à ".$resultat6['v_nom'].".<br>";
			}
			if($resultat5['t_progres']<100){
				echo "Le groupe n° ".$resultat5['g_id']." construit le tunnel qui relie ".$resultat5['v_nom']." à ".$resultat6['v_nom'].".<br>";
			}
		}

	}
	//si ce groupe n'existe pas dans la BDD
	else {
		echo "Ce groupe n'existe pas";
	}
}
//si le champs GET groupe est vide
else{
	echo "vous n'avez pas choisi de groupe!";
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>groupe</title>
</head>
<body>
	<?php
	if($resultat){
	?>
	<!-- formulaire pour changer le tunnel du groupe -->
	<form method='GET' action =''>
		<label>Modifier le Tunnel: </label>
			<input hidden type="text" name="groupe" value="<?php echo $groupe;?>">
			<select name='modif_tunnel' >
			<?php
			for ($i=0; $i < count($tunnels); $i++){ 
				if ($tunnels[$i]['t_id']!=$resultat2['g_tunnel_fk']) {
					echo "<option value='".$tunnels[$i]['t_id']."'> ".$tunnels[$i]['t_id']."</option>";
				}						
			}
			if($resultat2['g_tunnel_fk']){
				echo "<option>aucun</option>";	
			}	
			?>
		</select>
		<input type="submit" value="OK">
	</form>
	<br>
	<!-- formulaire pour changer les horaires du groupe -->
	<form method='GET' action =''>
		<input hidden type="text" name="groupe" value="<?php echo $groupe;?>">
		<label>Modifier les horaires de debut:</label>
		<input type="time" step=1 name="debut" value="<?php echo $resultat2['g_debuttravail'];?>">
		<br>
		<label>Modifier les horaires de fin:</label>
		<input type="time" step=1  name="fin" value="<?php echo $resultat2['g_fintravail'];?>">
		<br>
		<input type="submit" name="OK">
	</form>
	<br>
	<!-- formulaire pour changer la taverne du groupe -->
	<form method='GET' action =''>
		<input hidden type="text" name="groupe" value="<?php echo $groupe;?>">
		<label>Modifier la taverne du groupe:</label>
		<select name='modif_taverne'>
			<?php
			for ($i=0; $i < count($tavernes); $i++){ 
				if($tavernes[$i]['t_nom']!=$resultat2['t_nom']){
					echo "<option value='".$tavernes[$i]['t_id']."'> ".$tavernes[$i]['t_nom']."</option>";
				}				
			}
			if($resultat2['t_nom']){
				echo "<option>aucun</option>";	
			}
			?>
		</select>
		<input type="submit" name="OK">
	</form>
	<?php
	//On recommande les tavernes qui sont soit a la ville d'arrivee, soit a la ville de depart , et dont il y a assezde chambres disponibles. Seulement pour les groupes qui n'ont pas de tavernes.
	if (!$resultat2['t_nom']) { ?>
		<p>Voici la liste des tavernes recommandées:</p>
		<?php 
		$requeteA=$bdd->query('SELECT count(n_id) AS nombrenain FROM nain WHERE  n_groupe_fk = \''.$groupe.'\'');
		$resultatA=$requeteA->fetch();
		$requeteB=$bdd->query('SELECT t_chambres-count(n_id) AS dispo, t_id, t_nom, t_ville_fk FROM taverne LEFT JOIN groupe ON t_id=g_taverne_fk LEFT JOIN nain ON g_id=n_groupe_fk GROUP BY t_id');
		$resultatB=$requeteB->fetchAll();
		for ($i=0; $i < count($resultatB); $i++) { 
			if($resultatB[$i]['dispo']-$resultatA['nombrenain']>=0 AND ($resultat5['v_id']==$resultatB[$i]['t_ville_fk'] OR $resultat6['v_id']==$resultatB[$i]['t_ville_fk'])){
				echo "-".$resultatB[$i]['t_nom']."<br>";
			}
		}
		
	}
	}
	include('footer.php')
	?>

</body>
</html>