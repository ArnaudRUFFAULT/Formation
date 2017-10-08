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
if (empty($_SESSION['user'])){
	header('Location:index.php');
}
else{
	$m_historique = $m_manager -> HistoriqueMessage($_SESSION['user']['u_id']);



?>
<!DOCTYPE html>
<html>
<head>
	<title>Mon Espace</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
</head>
<body>
	<?php include('connexion.php');?>
	<div class="corps">
		<table>
		<tr>
			<th>Conversation</th>
			<th>Date</th>
			<th>Heure</th>
			<th>Message</th>
		</tr>
		<?php
		
			foreach ($m_historique as $key) {
			echo '<tr>';
			echo '<td><a href="message.php?conversation='.$key['c_id'].'">'.$key['c_id'].'</a></td><td>'.$key['date'].'</td><td>'.$key['heure'].'</td><td>'.$key['m_contenu'].'</td>';
			echo '</tr>';
		}

		

		?>
	</table>
		<div class="centrer"><a href="index.php">Revenir à la liste des conversations</a></div>
	</div>
</body>
</html>
<?php } ?>