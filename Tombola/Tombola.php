<?php
	session_start();
/*	echo "Voici Le tableau SESSION:";
	print_r($_SESSION);
	echo "<br>";
	echo "Voici Le tableau POST:";
	print_r($_POST);
	echo "<br>";*/

	if(isset($_GET['NombreMaxTickets'])){
		echo "<p>Il ne reste pas assez de tickets en vente,vous achetez donc les derniers tickets disponibles</p>";
	}
	if(isset($_GET['NombreNegatif'])){
		echo "<p>Valeur négative ou caractère saisie non numérique!</p>";
	}
	if(isset($_GET['NoMoney'])){
		echo "<p>Pas assez d'argent , vous achetez donc le maximum de tickets avec l'argent qu'il vous reste!</p>";
	}

	define('NbrTickets', 100);
	define('PrixTicket', 4);
	define('ArgentDepart', 500);
	define('Lot1', 150);
	define('Lot2', 50);
	define('Lot3', 20);
	define('Lot4', 10);
	define('Lot5', 1);

	if(!isset($_SESSION['PrixTicket'])){$_SESSION['PrixTicket']=PrixTicket;}
	if(!isset($_SESSION['argentDepart'])){$_SESSION['argentDepart']=ArgentDepart;}
	if(!isset($_SESSION['argent'])){$_SESSION['argent']=ArgentDepart;}
	if(!isset($_SESSION['NbrTickets'])){$_SESSION['NbrTickets']=NbrTickets;}
	if(!isset($_SESSION['TicketsAchete'])){$_SESSION['TicketsAchete']=0;}
	if(!isset($_SESSION['TicketsRestant'])){$_SESSION['TicketsRestant']=NbrTickets;}
	if(!isset($_SESSION['Lot1recomp'])){$_SESSION['Lot1recomp']=Lot1;}
	if(!isset($_SESSION['Lot2recomp'])){$_SESSION['Lot2recomp']=Lot2;}
	if(!isset($_SESSION['Lot3recomp'])){$_SESSION['Lot3recomp']=Lot3;}
	if(!isset($_SESSION['Lot4recomp'])){$_SESSION['Lot4recomp']=Lot4;}
	if(!isset($_SESSION['Lot5recomp'])){$_SESSION['Lot5recomp']=Lot5;}


	


	if(isset($_POST['TicketsAchete'])){
		if($_POST['TicketsAchete']<0 OR ((!is_numeric($_POST['TicketsAchete'])AND $_POST['TicketsAchete']!=""))){
			header("Location:Tombola.php?NombreNegatif&");
		}
		else if(($_SESSION['TicketsRestant']-$_POST['TicketsAchete'])<0){
			$_SESSION['TicketsAchete']=$_SESSION['TicketsAchete']+$_SESSION['TicketsRestant'];
			$_SESSION['argent']=$_SESSION['argent']-($_SESSION['TicketsRestant']*PrixTicket);
			$_SESSION['TicketsRestant']=0;
			header("Location:Tombola.php?NombreMaxTickets&");
		}
		else if(($_POST['TicketsAchete']*PrixTicket)>$_SESSION['argent']){
			$_SESSION['TicketsAchete']=$_SESSION['TicketsAchete']+($_SESSION['argent']/PrixTicket);
			$_SESSION['argent']=0;
			$_SESSION['TicketsRestant']=NbrTickets-$_SESSION['TicketsAchete'];
			header("Location:Tombola.php?NoMoney&");
		}
		else{
			$_SESSION['TicketsAchete']=$_SESSION['TicketsAchete']+$_POST['TicketsAchete'];
			$_SESSION['argent']=$_SESSION['argent']-(PrixTicket*$_POST['TicketsAchete']);
			$_SESSION['TicketsRestant']=$_SESSION['TicketsRestant']-$_POST['TicketsAchete'];
		}
	}
	if(isset($_GET['deco'])){
		session_destroy();
		header("Location:Tombola.php");
	}
	if(isset($_GET['rejouer'])){
		foreach ($_SESSION as $key => $value) {
			if($key!='argent'){unset($_SESSION[$key]);}
		}
		header("Location:Tombola.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Tombola</title>
	<meta charset="utf-8">
	<style type="text/css">
		body{
			background-color: #3C423D;
			color:white;
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
	<p>Prix du ticket: <?php echo PrixTicket; ?>€</p>
	<?php
		echo "<p>Il reste ".$_SESSION['TicketsRestant']." Tickets disponibles à l'achat.</p>";
		echo "Les Lots à gagner sont:<br>".Lot1." €<br>".Lot2." €<br>".Lot3." €<br>".Lot4." <br>".Lot5." €<br>";
		echo "<p>Vous avez actuellement ".$_SESSION['argent']."€ et ".$_SESSION['TicketsAchete']." tickets</p>";
	?>
	<form action="" method="POST">
		<label for="TicketsAchete">Combien voulez-vous de Tickets? </label>
		<input type="number" name="TicketsAchete">
		<input type="submit" value="Acheter">
	</form>
	<?php
		if($_SESSION['TicketsAchete']!="" AND is_numeric($_SESSION['TicketsAchete'])){
			echo "<p><a href='TombolaAttributionNumero.php'>Choisir Mes Tickets achetés!</a></p>";
		}
		echo "<p><a href='Tombola.php?deco='>Réinitialiser la Tombola</a></p>";

	?>
</body>
</html>