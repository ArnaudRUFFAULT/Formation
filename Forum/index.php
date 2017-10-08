
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

$m_manager = managerForum::GetManagerForum();
$mesConversations= $m_manager -> GetAllConversations();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Forum</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>	
	<?php include('connexion.php') ?>
		<div class="corps">
		<table>
			<tr>
				<th>ID de la conversation</th>
				<th>Date de la conversation</th>
				<th>Heure de la conversation</th>
				<th>Nombre de messages</th>
				<th>Details</th>
			</tr>
			<?php
			foreach ($mesConversations as $key) {
				$classname= $key['c_termine'] ?'closed' : 'opened' ;
				echo '<tr class="'.$classname.'">';
				echo '<td>'.$key['c_id'].'</td><td>'.$key['date'].'</td><td>'.$key['heure'].'</td><td>'.$key['NbMessage'].'</td><td><a href="message.php?conversation='.$key['c_id'].'">->[]</a></td>';
				echo '</tr>';
			}

			?>
		</table>
	</div>
</body>
</html>