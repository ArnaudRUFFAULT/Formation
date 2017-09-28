<?php
	session_start();
	if(isset($_GET['deco'])){
		session_destroy();
		header("Location:Interface.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Bataille navale</title>
	<meta charset="utf-8">
	<style type="text/css">
		table td{
			border:1px black solid;
			width: 50px;
			height: 50px;
			text-align: center;
		}
		td button{
			width: 50px;
			height: 50px;
			background-color: lightblue;
		}
	</style>
</head>
<body>
<?php
	print_r($_SESSION);
	echo "<br>";
	print_r($_POST);
	if(isset($_POST['CoordonneJoueur1'])){
		$_SESSION['CoordonneJoueur1'][$_SESSION['NombreTour']]=$_POST['CoordonneJoueur1'];
	}
?>
	<form action="interface.php" method="POST">
		<p>JOUEUR 2, Tour n°<?php echo $_SESSION['NombreTour']; ?></p>
		<table>
			<?php
				$abcisse=array('','A','B','C','D','E','F','G','H','I','J');
				$ordonne=array('',1,2,3,4,5,6,7,8,9,10);
				for ($i=0; $i <=10 ; $i++) { 
					echo "<tr>";
					for ($j=0; $j <=10 ; $j++) { 
						
						if($i==0){
							echo "<td style='background-color: lightgreen;'>".$abcisse[$j]."</td>";
						}
						else if($j==0){
							echo "<td style='background-color: lightgreen;'>".$ordonne[$i]."</td>";
						}
						else {
							echo "<td style='background-color: lightblue;'><button";
							if(isset($_SESSION['CoordonneJoueur2'])){
								for ($u=1; $u <= count($_SESSION['CoordonneJoueur2']); $u++) { 
									if($_SESSION['CoordonneJoueur2'][$u]==$ordonne[$i].$abcisse[$j]){
										echo " style='background-color:red; ";
									}
								}
							}
							echo" type='submit' name='CoordonneJoueur2' value='".$ordonne[$i].$abcisse[$j]."'></button></td>";
						}
					}
					echo "</tr>";
				}
			?>
		</table>
	</form>
	<?php
		echo "<p><a href='Interface.php?deco=1&'>Réinitialiser la partie</a></p>"
	?>
</body>
</html>