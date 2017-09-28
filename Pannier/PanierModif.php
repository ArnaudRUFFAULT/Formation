<?php
session_start();
include("Header.php");
echo "<div class='ModifPanier'>";
if(!isset($_SESSION['Panier']) OR count($_SESSION['Panier'])==0){
	echo "Panier vide!";
	}
if(isset($_SESSION['Panier']) AND count($_SESSION['Panier'])>0){
		echo "<h3>Panier:</h3>";
		foreach ($_SESSION['Panier'] as $key => $value) {
			$syntax=str_replace('_', ' ' ,$key);
			echo "<div><p>".$syntax." : <p><form action='Traitement.php' method='POST'>";
			foreach ($_SESSION['Panier'][$key] as $key2 => $value2) {
				if($key2!='Montant'){
					echo $key2." : <input type='text' name='$key.$key2' value='".$_SESSION['Panier'][$key][$key2]."'></input> // ";

				}
				if($key2=='Montant'){
					echo $key2." : ".$_SESSION['Panier'][$key][$key2]." $</div>";
				}
			}
		}
		echo "<button name='Modif' value='1'>Ok</button></form>";
		echo "<p>Total: ".$_SESSION['Total']." $</p>";
	}
echo "</div>";
include("Footer.php");
?>