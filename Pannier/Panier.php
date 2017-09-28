<div class="Panier">
<?php
	if(isset($_SESSION['Panier'])){
		echo "<h3>Panier:</h3>";
		foreach ($_SESSION['Panier'] as $key => $value) {
			$syntax=str_replace('_', ' ' ,$key);
			echo "<div><p class='ArticleTitre'>".$syntax." : <p>";
			foreach ($_SESSION['Panier'][$key] as $key2 => $value2) {
				if($key2!='Montant'){
					echo $key2." : ".$_SESSION['Panier'][$key][$key2]."<br>";
				}
				if($key2=='Montant'){
					echo $key2." : ".$_SESSION['Panier'][$key][$key2]." $</div>";
				}
			}
		}
		echo "<p class='Total'>Total: ".$_SESSION['Total']." $</p>";
	}
?>
</div>
