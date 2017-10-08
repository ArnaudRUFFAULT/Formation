<?php
	session_start();
	echo "Voici Le tableau SESSION:";
	print_r($_SESSION);
	echo "<br>";
	
?>
<!DOCTYPE html>
<html>
	<header>
		<meta charset="utf-8">
		<title>Tirage</title>
		<style type="text/css">
			body{
				background-color: #3C423D;
			}
			a{
				color:#48D559;
				text-decoration: none;
			}
			a:hover{
				background-color: black;
			}
			table td{
				background-color: black;
				color:#48D559;
				text-align: center;
				margin: 0;
				width:150px;
			}
			.tirer{
				font-size: 40px;
				font-weight: bolder;
				background-color: #48D559;
				color:black;

			}
			.tirer:hover{
				color: #48D559;
			}
		</style>
	</header>

<div>
		
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
	if(!isset($_SESSION['$Gagnant5'])){
		$_SESSION['$Gagnant5']=false;
	}
	if(!isset($_SESSION['$Gagnant4'])){
		$_SESSION['$Gagnant4']=false;
	}
	if(!isset($_SESSION['$Gagnant3'])){
		$_SESSION['$Gagnant3']=false;
	}
	if(!isset($_SESSION['$Gagnant2'])){
		$_SESSION['$Gagnant2']=false;
	}
	if(!isset($_SESSION['$Gagnant1'])){
		$_SESSION['$Gagnant1']=false;
	}
	$Lot5=NULL;
	$Lot4=NULL;
	$Lot3=NULL;
	$Lot2=NULL;
	$Lot1=NULL;
	if(!isset($_GET['Lot1']) AND !isset($_GET['Lot2']) AND !isset($_GET['Lot3']) AND !isset($_GET['Lot4']) AND !isset($_GET['Lot5'])){
		echo "<a class='tirer' href='TombolaTirage.php?Lot5=1'>Tirer au sort le 5eme Prix </a>"; 
	}
	if(isset($_GET['Lot5'])){
		if(!isset($_SESSION['TirageLot5'])){
			$Lot5=rand(1,$_SESSION['NbrTickets']);
			$_SESSION['TirageLot5']=$Lot5;
		}
		
		echo "<p style='color:#ECD964; font-size:60px;'>Le numéro gagnant est ".$_SESSION['TirageLot5']."!</p>";
		for ($i=0; $i <count($_SESSION['tirage']) ; $i++) { 
			if($_SESSION['tirage'][$i]==$_SESSION['TirageLot5']){
				echo "<p style='color:green; font-size:60px;'>Félicitation , vous avez remporté ".$_SESSION['Lot5recomp']." grâce à votre tickets n°".(array_search($_SESSION['TirageLot5'], $_SESSION['tirage'])+1)." !</p>";
				$_SESSION['$Gagnant5']=true;
				$_SESSION['argent']=$_SESSION['argent']+$_SESSION['Lot5recomp'];
				$_SESSION['Lot5recomp']=NULL;
			}
		}
		if(!$_SESSION['$Gagnant5']){ echo "<p style='color:red; font-size:60px;'> Vous avez perdu!</p>";}
		echo "<p><a class='tirer'  href='TombolaTirage.php?Lot4=1'>Tirage au sort le 4eme Prix </a></p>"; 
	}
	if(isset($_GET['Lot4'])){
		if(!isset($_SESSION['TirageLot4'])){
			while($Lot4==$Lot5){$Lot4=rand(1,$_SESSION['NbrTickets']);}
			$_SESSION['TirageLot4']=$Lot4;
		}
		
		echo "<p style='color:#ECD964; font-size:60px;'>Le numéro gagnant est ".$_SESSION['TirageLot4']."!</p>";
		for ($i=0; $i <count($_SESSION['tirage']) ; $i++) { 
			if($_SESSION['tirage'][$i]==$_SESSION['TirageLot4']){
				echo "<p style='color:green; font-size:60px;'>Félicitation , vous avez remporté un ".$_SESSION['Lot4recomp']." grâce à votre tickets n°".(array_search($_SESSION['TirageLot4'], $_SESSION['tirage'])+1)." !</p>";
				$_SESSION['$Gagnant4']=true;
				$_SESSION['argent']=$_SESSION['argent']+$_SESSION['Lot4recomp'];
				$_SESSION['Lot4recomp']=NULL;
			}
		}
		if(!$_SESSION['$Gagnant4']){ echo "<p style='color:red; font-size:60px;'> Vous avez perdu!</p>";}
		echo "<p><a class='tirer'  href='TombolaTirage.php?Lot3=1'>Tirage au sort le 3eme Prix </a></p>"; 
	}
	if(isset($_GET['Lot3'])){
		if(!isset($_SESSION['TirageLot3'])){
			while($Lot3==$Lot4 OR $Lot3==$Lot5){$Lot3=rand(1,$_SESSION['NbrTickets']);}
			$_SESSION['TirageLot3']=$Lot3;
		}
		echo "<p style='color:#ECD964; font-size:60px;'>Le numéro gagnant est ".$_SESSION['TirageLot3']."!</p>";
		for ($i=0; $i <count($_SESSION['tirage']) ; $i++) { 
			if($_SESSION['tirage'][$i]==$_SESSION['TirageLot3']){
				echo "<p style='color:green; font-size:60px;'>Félicitation , vous avez remporté ".$_SESSION['Lot3recomp']." Euros grâce à votre tickets n°".(array_search($_SESSION['TirageLot3'], $_SESSION['tirage'])+1)." !</p>";
				$_SESSION['$Gagnant3']=true;
				$_SESSION['argent']=$_SESSION['argent']+$_SESSION['Lot3recomp'];
				$_SESSION['Lot3recomp']=NULL;
			}
		}
		if(!$_SESSION['$Gagnant3']){ echo "<p style='color:red; font-size:60px;'> Vous avez perdu!</p>";}
		echo "<p><a class='tirer'  href='TombolaTirage.php?Lot2=1'>Tirage au sort le 2eme Prix </a></p>"; 
	}
	if(isset($_GET['Lot2'])){
		if(!isset($_SESSION['TirageLot2'])){
			$Lot2=rand(1,$_SESSION['NbrTickets']);
			while($Lot2==$Lot3 OR $Lot2==$Lot4 OR $Lot2==$Lot5){$Lot2=rand(1,$_SESSION['NbrTickets']);}
			$_SESSION['TirageLot2']=$Lot2;
		}
		echo "<p style='color:#ECD964; font-size:60px;'>Le numéro gagnant est ".$_SESSION['TirageLot2']."!</p>";
		for ($i=0; $i <count($_SESSION['tirage']) ; $i++) { 
			if($_SESSION['tirage'][$i]==$_SESSION['TirageLot2']){
				echo "<p style='color:green; font-size:60px;'>Félicitation , vous avez remporté ".$_SESSION['Lot2recomp']." Euros grâce à votre tickets n°".(array_search($_SESSION['TirageLot2'], $_SESSION['tirage'])+1)." !</p>";
				$_SESSION['$Gagnant2']=true;
				$_SESSION['argent']=$_SESSION['argent']+$_SESSION['Lot2recomp'];
				$_SESSION['Lot2recomp']=NULL;
			}
		}
		if(!$_SESSION['$Gagnant2']){ echo "<p style='color:red; font-size:60px;'>Vous avez perdu!</p>";}
		echo "<p><a class='tirer'  href='TombolaTirage.php?Lot1=1'>Tirage au sort le 1er Prix </a></p>"; 
	}
	if(isset($_GET['Lot1'])){
		if(!isset($_SESSION['TirageLot1'])){
			$Lot1=rand(1,$_SESSION['NbrTickets']);
			while($Lot1==$Lot2 OR $Lot1==$Lot3 OR $Lot1==$Lot4 OR $Lot1==$Lot5){$Lot1=rand(1,$_SESSION['NbrTickets']);}
			$_SESSION['TirageLot1']=$Lot1;
		}
		echo "<p style='color:#ECD964; font-size:60px;'>Le numéro gagnant est ".$_SESSION['TirageLot1']."!</p>";
		for ($i=0; $i <count($_SESSION['tirage']) ; $i++) { 
			if($_SESSION['tirage'][$i]==$_SESSION['TirageLot1']){
				echo "<p style='color:green; font-size:60px;'>Félicitation , vous avez remporté ".$_SESSION['Lot1recomp']." Euros grâce à votre tickets n°".(array_search($_SESSION['TirageLot1'], $_SESSION['tirage'])+1)." !</p>";
				$_SESSION['$Gagnant1']=true;
				$_SESSION['argent']=$_SESSION['argent']+$_SESSION['Lot1recomp'];
				$_SESSION['Lot1recomp']=NULL;
			}
		}
		if(!$_SESSION['$Gagnant1']){ echo "<p style='color:red; font-size:60px;'>Vous avez perdu!</p>";}
		?>
		<p style='color:blue; font-size:50px;'>Bilan de la Tombola:</p>
		<p style='color:blue; font-size:50px;'>Tirage Lot n°5:<?php if($_SESSION['$Gagnant5']){echo "Vous avez gagné!";}else{echo "Vous avez perdu!";}?></p>
		<p style='color:blue; font-size:50px;'>Tirage Lot n°4:<?php if($_SESSION['$Gagnant4']){
			echo "Vous avez gagné!";
			}
			else{echo "Vous avez perdu!";}?></p>
		<p style='color:blue; font-size:50px;'>Tirage Lot n°3:<?php if($_SESSION['$Gagnant3']){echo "Vous avez gagné!";}else{echo "Vous avez perdu!";}?></p>
		<p style='color:blue; font-size:50px;'>Tirage Lot n°2:<?php if($_SESSION['$Gagnant2']){echo "Vous avez gagné!";}else{echo "Vous avez perdu!";}?></p>
		<p style='color:blue; font-size:50px;'>Tirage Lot n°1:<?php if($_SESSION['$Gagnant1']){echo "Vous avez gagné!";}else{echo "Vous avez perdu!";}?></p>
		<?php
		echo "<p style='color:blue; font-size:50px;' >Vous avez actuellement ".$_SESSION['argent']."€, et vous aviez au départ ".$_SESSION['argentDepart']."€</p>";
		echo "<p><a href='Tombola.php?rejouer='>Rejouer à la Tombola</a></p>"; 
	}
	echo "<p><a href='Tombola.php?deco='>Réinitialiser la Tombola</a></p>";

?>
</html>
