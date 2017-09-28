<!DOCTYPE html>
<html>
<head>
	<title>Exo_3</title>
	<meta charset="utf-8">
	<style>
		section{
			max-width: 300px;
			margin: auto;
		}
		.carre{
			width: 100px;
			height: 100px;
			background-color: red;
			margin-top: 20px;
			position: relative;
			left:35px;
		}
		.ronde{
			width: 100px;
			height: 100px;
			background-color: red;
			margin-top: 20px;
			border-radius: 50px;
			position: relative;
			left:35px;
		}
		.triangle{
			width: 0;
		    height: 0;
		    border-left: 60px solid transparent;
		    border-right: 60px solid transparent;
		    border-bottom: 100px solid red;
		    margin-top: 20px;
		    position: relative;
			left:28px;
		}
	</style>
</head>
<body>
<?php
echo "Tableau GET:";
print_r($_GET);
echo "<br>";
echo "Tableau POST:";
print_r($_POST);
echo "<br>";
?>
	<section>
		<p>Quelle forme voulez-vous?</p>
		<form action="formes.php" method="POST">
			<label for"triangle"><input type="submit" name="forme" value="triangle"></label>
			<label for"carre"><input type="submit" name="forme" value="carre"></label>
			<label for"ronde"><input type="submit" name="forme" value="ronde"></label>
		</form>
		<?php 
			if(isset($_GET['forme'])){
				if($_GET['forme']=='triangle'){
					echo "<div class='triangle'></div>";
				}
				if($_GET['forme']=='carre'){
					echo "<div class='carre'></div>";
				}
				if($_GET['forme']=='ronde'){
					echo "<div class='ronde'></div>";
				}
			}
		?>
	</section>


</body>
</html>