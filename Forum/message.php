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
$m_manager = managerForum::getManagerForum();


$c_id = NULL;
$page = 1 ;
$precedent=$page-1;
$suivant=$page+1;
$tri = 'date';
if (!empty($_SESSION['tri'])) {
	$tri = $_SESSION['tri'];
}
$tri = 'date';

if(!empty($_GET['conversation'])){
	$c_id = $_GET['conversation'];
}
if(!empty($_GET['page'])){
	$page = $_GET['page'];
}

if(!empty($_GET['tri']) AND ($_GET['tri']=='date' OR $_GET['tri']=='id' OR $_GET['tri']=='auteur')){
	$_SESSION['tri'] = $_GET['tri'];
	$tri = $_SESSION['tri'];
}

if(!empty($_POST['reponse'])){
	$m_manager->AddMessage($_SESSION['user']['u_id'],$c_id,htmlentities($_POST['reponse']));
}

//$mesMessages= $m_manager -> GetAllMessagebyConversation($c_id);
$mesMessages= $m_manager -> GET20Messages($c_id,$page,$tri);
$NbPage = $m_manager -> GetNbrPage($c_id);
$EtatConversation = $m_manager -> GetEtatConversation($c_id);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Forum</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include('connexion.php');?>
	<div class="corps">
	<?php
	if(!empty($mesMessages)){ 
		if($page>1){
		
		echo '<span class="left"><a href="message.php?conversation='.$c_id.'&page='.$precedent.'&tri='.$tri.'">Précédent</a></span>';
	}
	if($page<$NbPage){
		echo '<span class="right"><a class="centrer" href="message.php?conversation='.$c_id.'&page='.$suivant.'&tri='.$tri.'">Suivant</a></span>';
	}
	?>
	<hr />
	<?php
	echo '<div>';
	for ($i=1; $i <= $NbPage; $i++) { 
		echo '<div class="flex ';
		if ($i==$page) {
			echo 'pageActuelle';
		}
		
		echo'";><a href="message.php?conversation='.$c_id.'&page='.$i.'&tri='.$tri.'">'.$i.'</a></div>';
	}
	echo '</div><hr />';
	?>
	<table>
		<tr>
			<th>Date du message</th>
			<th>Heure du message</th>
			<th>Nom Prénom</th>
			<th>Message</th>
		</tr>
		<?php
		
			foreach ($mesMessages as $key) {
			echo '<tr>';
			echo '<td>'.$key['date'].'</td><td>'.$key['heure'].'</td><td>'.$key['auteur'].'</td><td class="messageDisposition">'.$key['message'].'</td>';
			echo '</tr>';
		}

		

		?>
	</table><?php }
	else{
		echo "Cette conversation n' a aucun messages pour le moment ou le numéro de page demandé n'existe pas.";
	}
	?>
	<hr />
	<?php 
	if($page>1){
		
		echo '<span class="left"><a href="message.php?conversation='.$c_id.'&page='.$precedent.'&tri='.$tri.'">Précédent</a></span>';
	}
	if($page<$NbPage){
		echo '<span class="right"><a class="centrer" href="message.php?conversation='.$c_id.'&page='.$suivant.'&tri='.$tri.'">Suivant</a></span>';
	}
	?>
	<hr />
	<?php
	echo '<div>';
	for ($i=1; $i <= $NbPage; $i++) { 
		echo '<div class="flex ';
		if ($i==$page) {
			echo 'pageActuelle';
		}
		
		echo'";><a href="message.php?conversation='.$c_id.'&page='.$i.'&tri='.$tri.'">'.$i.'</a></div>';
	}
	echo '</div><hr />';
	if(isset($_SESSION['user']) AND !$EtatConversation ){
	?>
	<form class="centrer" action="" method="POST">
		<label for="reponse"></label>
		<textarea name="reponse" id="reponse" cols="250" rows="5"></textarea>
		<br>
		<input type="submit">
	</form>
	<?php
	}
	?>
	<hr />
	<form class="centrer" action="" method="GET">
		<input type="hidden" name="conversation" value=<?= '"'.$c_id.'"'?>>
		<label for="tri">Trier les messages par:</label>
		<select id="tri" name="tri">
			<option value="date" <?php if($tri=='date'){echo 'selected';}?>>Date</option>
			<option value="id" <?php if($tri=='id'){echo 'selected';}?>>Id</option>
			<option value="auteur" <?php if($tri=='auteur'){echo 'selected';}?>>Auteur</option>
		</select>
		<input type="submit" name="">
	</form>
	<hr />
	<div class="centrer"><a href="index.php">Revenir à la liste des conversations</a></div>
</body>
</html>
