<!DOCTYPE html>
<html>
<head>
	<title>Exo2_complementaire</title>
	<meta charset="utf-8">
	<style type="text/css">
		td{
			width: 100px;
			height: 40px;
			border:1px black solid;
			text-align: center;
		}
		table tr:nth-child(1){
			font-weight: bolder;
			text-decoration: underline;
		}
		.error{
			background-color: red;
			color:white;
			font-weight: bolder;
			position: fixed;
			top: 0;
			width: 100%;
			font-size: 25px;
			margin-top: 0px;
		}
		.error::before{
			content: '/!/';
		}
		.error::after{
			content: '/!/';
		}
		
	</style>
</head>
<body>
	<?php

		$tabClients[0][0]=15;
		$tabClients[0][1]=array('nom'=>'RUFFAULT','prenom'=>'Arnaud','age'=>26,'codePostal'=>34000);
		$tabClients[1][0]=25;
		$tabClients[1][1]=array('nom'=>'GRANGER','prenom'=>'Hermione','age'=>21,'codePostal'=>60000);
		$tabClients[2][0]=32;
		$tabClients[2][1]=array('nom'=>'STRANGE','prenom'=>'Alfred','age'=>56,'codePostal'=>13001);
		$tabClients[3][0]=33;
		$tabClients[3][1]=array('nom'=>'GONTRAND','prenom'=>'Paul','age'=>21,'codePostal'=>72000);
		$tabClients[4][0]=98;
		$tabClients[4][1]=array('nom'=>'CARLONE','prenom'=>'Paul','age'=>34,'codePostal'=>94000);


	?>
	<table>
		<tr><td>ID</td><td>Nom</td><td>Prénom</td><td>Age</td><td>Code Postal</td></tr>
		<?php
			for ($i=0; $i <=4 ; $i++) { 
				?>
				<tr>
					<td><?php echo $tabClients[$i][0];?></td>
					<td><?php echo $tabClients[$i][1]['nom']; ?></td>
					<td><?php echo $tabClients[$i][1]['prenom']; ?></td>
					<td><?php echo $tabClients[$i][1]['age']; ?></td>
					<td><?php echo $tabClients[$i][1]['codePostal']; ?></td>
				</tr>
				<?php
				}
				?>
	</table>
	<?php


		for ($i=0; $i <=4 ; $i++) { 
			foreach ($tabClients[$i][1] as $key => $value) {
				if($value==""){echo "<p class='error'>le champs $key n'est pas complété pour le dossier n°".$tabClients[$i][0].".</p>";}
			}
		}

		for ($i=0; $i <=4 ; $i++){
			echo "<p>ID=".$tabClients[$i][0].". Nom: ".$tabClients[$i][1]['nom'].". Département: ".substr($tabClients[$i][1]['codePostal'],0,2)."</p>";
			
		}
		?>
		<form action="" method="GET">
			<label for="idClient">Recherche par ID:</label>
			<input name =idClient type="number" placeholder="ex:15">
			<input type="submit" value="Valider">
		</form>
		<?php
		if(isset($_GET['idClient'])){
			if( $_GET['idClient']!="" AND
				$_GET['idClient']!=$tabClients[0][0] AND
				$_GET['idClient']!=$tabClients[1][0] AND
				$_GET['idClient']!=$tabClients[2][0] AND
				$_GET['idClient']!=$tabClients[3][0] AND
				$_GET['idClient']!=$tabClients[4][0] 
				){
				header("Location:PageInexistante.php");
			}
			for ($i=0; $i <=4 ; $i++) { 
				
				if($_GET['idClient']==$tabClients[$i][0]){
					?>
					<table>
						<tr><td>ID</td><td>Nom</td><td>Prénom</td><td>Age</td><td>Code Postal</td></tr>
		 				<tr>
							<td><?php echo $tabClients[$i][0];?></td>
							<td><?php echo $tabClients[$i][1]['nom']; ?></td>
							<td><?php echo $tabClients[$i][1]['prenom']; ?></td>
							<td><?php echo $tabClients[$i][1]['age']; ?></td>
							<td><?php echo $tabClients[$i][1]['codePostal']; ?></td>
						</tr>
					</table>
					<?php
				}
			}
		}
		?>
		<form action="" method="GET">
			<label for="prenomClient">Recherche par Prénom:</label>
			<input name =prenomClient type="text" placeholder="ex: Arnaud">
			<input type="submit" value="Valider">
		</form>
		<?php

		if(isset($_GET['prenomClient'])){
			if( $_GET['prenomClient']!="" AND
				$_GET['prenomClient']!=$tabClients[0][1]['prenom'] AND
				$_GET['prenomClient']!=$tabClients[1][1]['prenom'] AND
				$_GET['prenomClient']!=$tabClients[2][1]['prenom'] AND
				$_GET['prenomClient']!=$tabClients[3][1]['prenom'] AND
				$_GET['prenomClient']!=$tabClients[4][1]['prenom'] 
				){
				header("Location:PageInexistante.php");
			}
			for ($i=0; $i <=4 ; $i++) { 
				if($_GET['prenomClient']==$tabClients[$i][1]['prenom']){
					?>
					<table>
						<tr><td>ID</td><td>Nom</td><td>Prénom</td><td>Age</td><td>Code Postal</td></tr>
		 				<tr>
							<td><?php echo $tabClients[$i][0];?></td>
							<td><?php echo $tabClients[$i][1]['nom']; ?></td>
							<td><?php echo $tabClients[$i][1]['prenom']; ?></td>
							<td><?php echo $tabClients[$i][1]['age']; ?></td>
							<td><?php echo $tabClients[$i][1]['codePostal']; ?></td>
						</tr>
					</table>
					<?php
				}
			}
		}

		

	?>

</body>
</html>