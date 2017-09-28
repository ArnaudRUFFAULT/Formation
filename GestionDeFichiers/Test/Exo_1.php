<?php
	$file='Exo1.txt';
	$fileVar="nom : Paul".PHP_EOL;
	$fileVar2="nom : Pierre";
	file_put_contents($file, $fileVar.$fileVar2);

	$StringFile=file($file);
	echo "<br>";
	$tab=array();

	for ($i=0;$i<count($StringFile);$i++) {
	 	$tab[]=explode(':', $StringFile[$i]);
	}	
	print_r(pathinfo($file));
	echo "<br>";
	echo realpath($file);
	file_put_contents('coucou.txt', 'hello');
	unlink('coucou.txt');
	if(!file_exists('Retest')){
		mkdir('Retest',0707);
		mkdir('Retest/coucou1',0707);
		mkdir('Retest/coucou2',0707);
		mkdir('Retest/coucou3',0707);
		mkdir('Retest/coucou4',0707);
		mkdir('Retest/coucou5',0707);
	}
	
	

	$Repertoire=scandir('Retest');
	print_r(scandir('Retest')) ;
	for ($i=0; $i < count($Repertoire); $i++) { 
		if($Repertoire[$i]=='.' OR $Repertoire[$i]=='..'){

		}
		else if(is_dir('Retest/'.$Repertoire[$i])){
			echo "<br>".$Repertoire[$i]." est un repertoire.<br>";
		}
		else if(is_file('Retest/'.$Repertoire[$i])){
			echo "<br>".$Repertoire[$i]." est  un fichier.<br>";
		}
	}
	$RepertoireRead=opendir('Retest');
	while(false!==($entry=readdir($RepertoireRead))){
		if ($entry!='.' AND $entry!='..') {
			if(is_dir('Retest/'.$entry)){
				echo "<p>$entry:C'est un repertoire. $entry a été modifié le ".date ("d F Y H:i:s.", filemtime('Retest/'.$entry))." et a été crée le ".date("d F Y H:i:s.", filectime('Retest/'.$entry))."</p>";
			}

			else{echo "<p>$entry:C'est un fichier. $entry a été modifié le ".date ("d F Y H:i:s.", filemtime('Retest/'.$entry))."</p> ";}
		}
	}
	closedir($RepertoireRead);

	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Exo 1 Fichiers</title>
	<meta charset="utf-8">
	<style type="text/css">
		table,td{
			border:black 1px solid;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td><?php echo $tab[0][0] ?></td>
			<td><?php echo $tab[0][1] ?></td>
		</tr>
		<tr>
			<td><?php echo $tab[1][0] ?></td>
			<td><?php echo $tab[1][1] ?></td>
		</tr>
	</table>
</body>
</html>