<!-- <?php
	session_start();
	echo "Voici Le tableau SESSION:";
	print_r($_SESSION);
	echo "<br>";
	echo "Voici Le tableau POST:";
	print_r($_POST);
	echo "<br>";
?> -->
<!DOCTYPE html>
<html>
<head>
	<title>Choix des Tickets</title>
	<style type="text/css">
		body{
			background-color: #3C423D;
		}
		.ticket{
			height: 75px;
			width: 75px;
			font-size: 30px;
			background-color: black;
			color:#48D559;
			border:none;
			border-radius: 5px;
			box-shadow: 2px 2px 2px black;
			margin: 5px;
		}

		input{
			background-color: black;
			color:#48D559;
			border:#48D559 1px solid;
			font-size: 16px;
		}

		.ticket:hover{
			box-shadow: 4px 4px 4px black;
			font-weight: bolder;

		}
		.input{
			max-width: 600px;
			margin: auto;
		}
		.tableau{
			width: 300px;
			margin: auto;
		}

		table td{
			background-color: black;
			color:#48D559;
			text-align: center;
			margin: 0;
			width:150px;
		}
		a{
		color:#48D559;
		text-decoration: none;
		}
		a:hover{
			background-color: black;
		}

	</style>
</head>
<body>
	<form action="" method="POST">
	 <div class="form">
	<?php
		$tab=array();
		for ($i=0; $i < $_SESSION['NbrTickets']; $i++) { 
			$tab[$i]=$i+1;
		}
		shuffle($tab);
		for ($i=0; $i <$_SESSION['TicketsAchete'] ; $i++) { 
			$_SESSION['tirage'][$i]=$tab[$i];
		}
		for($j=1;$j<=$_SESSION['TicketsAchete'];$j++){
		
		

	?>
		<?php 
		echo "<select class='ticket' name='".$j."'>";
	 		
				for($i=1;$i<=$_SESSION['NbrTickets'];$i++){
					echo"<option class='optionform' ";
					if(isset($_SESSION['tirage'][$j-1]) AND $i==$_SESSION['tirage'][$j-1]){ echo " selected ";}
					if($i<10){echo" >0".$i."</option>";}
					else{echo" >".$i."</option>";}
				}
			
		echo "</select>";
		}
		?>
		</div>
		<input type="submit" value="Mettre à jour mes numéros">
	</form>
	<?php
		$Doublon=false;
			for($j=1;$j<=count($_POST);$j++){
				for($i=1;$i<=count($_POST);$i++){
					if($_POST[$j]==$_POST[$i] AND $i!=$j){
						$Doublon=true;
					}
				}
			}
		
		if ($Doublon){
			echo "<p style='color:red; font-size:25px; font-weight:bolder;'>Vous ne pouvez pas avoir deux fois le même numéro!</p>";
		}
		else if(isset($_POST) AND $_POST!=NULL){
			unset($_SESSION['tirage']);
			foreach ($_POST as $key => $value) {
				$_SESSION['tirage'][]=$value;
			}
		}
		
	?>
	<div class="tableau">
		<table>
			<tr>
				<td>Tickets n°</td>
				<td>Valeur du Ticket</td>
			<?php 
			for ($j=1; $j <= count($_SESSION['tirage']) ; $j++) { 
				echo "<tr><td>".($j)."</td><td>".$_SESSION['tirage'][$j-1]."</td></tr>";
			}
			?>
		</table>
	</div>
	<?php
		if(!$Doublon){
			echo "<p><a href='TombolaTirage.php'>Commencer le tirage au sort!</a></p>";
		}

		echo "<p><a href='Tombola.php'>Je veux racheter des Tickets!</a></p>";
		echo "<p><a href='Tombola.php?deco='>Réinitialiser la Tombola</a></p>";

	?>

</body>
</html>