<?php
define('NBR_COLONNE', 100);
define('NBR_LIGNE',100);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>Life</title>
	<script type="text/javascript" src="life.js"></script>
	<style type="text/css">
	#data
	{
		border-collapse: collapse;
		border: 1px solid black;
		margin: auto;
	}

	#data td
	{
		border: 1px solid grey;
		width: 5px;
		height: 5px;
	}

	#data .dead
	{
		background-color: white;
	}

	#data .alive
	{
		background-color: lightblue;
	}
	#menu{
		text-align: center;
	}
	</style>
</head>
<body>
	<h1>Le jeu de la vie de Conway</h1>
	<h2>Description</h2>
	<p>Le jeu de la vie, créé par John Horton Conway en 1970, est un automate cellulaire. Un automate cellulaire est une simulation divisée en multiples cases(les cellules) qui ont chacune un état et qui, à chaque étape(ou génération), évoluent(ou non) vers un nouvel état, suivant un jeu de règles simples.<br/>
	Dans le cas du jeu de la vie, les cellules peuvent être vivantes ou mortes, et obéissent aux règles suivantes :</p>
	<ul>
		<li>Une cellule nait si elle a exactement 3 voisins vivants</li>
		<li>Une cellule vivante peut mourir de solitude si elle a moins de 2 voisins</li>
		<li>Une cellule vivante peut mourir d'étouffement si elle a plus de 3 voisins</li>
		<li>Dans tout les autres cas, la cellule conserve son état</li>
	</ul>
	<p>Notez que les voisins incluent les diagonales(donc un total de 8 voisins au plus)</p>
	<h2>L'exercice</h2>
	<p>Pour cet exercice, vous devrez :</p>
	<ul>
		<li>Créer un grille de jeu (Au moins 10x10, recommandé 100x100)</li>
		<li>Permettre le changement d'état par clic sur une cellule (Au moins à l'arrêt, à vous de choisir si vous le permettez en cours de jeu)</li>
		<li>Permettre de démarrer le jeu et le remettre en pause(lorsque le jeu tourne, faire une mise a jour toutes les <i>x</i> millisecondes, recommandé 100)</li>
		<li>Proposer un bouton pour faire avancer le jeu d'une génération</li>
	</ul>
	<hr/>
	<h2>Le jeu</h2>
	<div id="life">
		<table id="data">
		<?php
			for ($i=0; $i < NBR_LIGNE; $i++){
				if($i<10){
					echo '<tr id="tr0'.$i.'">';
				}
				else{
					echo '<tr id="tr'.$i.'">';
				}
				for ($y=0; $y < NBR_COLONNE; $y++){ 
					if($i<10){
						if($y<10){
							echo '<td class="dead" id="0'.$y.'0'.$i.'">';
						}
						else{
							echo '<td class="dead" id="'.$y.'0'.$i.'">';
						}

					}
					else{
						if($y<10){
							echo '<td class="dead" id="0'.$y.$i.'">';
						}
						else{
							echo '<td class="dead" id="'.$y.$i.'">';
						}
					}
					echo '</td>';
				}
				echo '</tr>';
			}
		?>
		</table>
	</div>
	<hr />
	<div id="menu">
		<input id="go" type="submit" name="GO" value="GO">
		<input id ="step" type="submit"  value="STEP">
		<input id ="stop" type="submit"  value="STOP">
		<input id ="restart" type="submit"  value="RESTART">
	</div>
</body>
</body>
</body>
</html>