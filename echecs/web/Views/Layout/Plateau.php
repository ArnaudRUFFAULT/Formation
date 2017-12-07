<!DOCTYPE html>
<html>
<head>
	<title>Echecs</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./CSS/plateau.css">
</head>
<body>
	<table>
		<tr>
			<th>Tour:</th><td><?=$game->getTour()?></td>
		</tr>
		<tr>
			<th>Au tour de</th><td><?=$game->getCurrentPlayerPseudo()?></td>
		</tr>
		<tr>
			<th>Blanc:</th><td><?=$game->getFirstPlayer()->getPseudo()?></td>
		</tr>
		<tr>
			<th>Noir:</th><td><?=$game->getSecondPlayer()->getPseudo()?></td>
		</tr>
	</table>
	<?php
	echo '<table id="grille">';
		for ($y=7; $y >= 0; $y--) { 
			echo '<tr>';
			for ($x=0; $x < 8; $x++) { 
				echo '<td>';
				foreach ($mesCases as $key => $value) {
					if($value['X'] == $x && $value['Y']== $y){
						echo '<form method="POST" action="index.php?controller=game&action=updateGame">';
						echo '<input hidden type="text" name="X" value="'.$x.'">';
						echo '<input hidden type="text" name="Y" value="'.$y.'">';
						echo '<input hidden type="text" name="idPiece" value="'.$_POST['idPiece'].'">';
						echo '<input hidden type="text" name="gameId" value="'.$game->getId().'">';
						echo '<input hidden type="text" name="tour" value="'.$game->getTour().'">';
						echo '<input hidden type="text" name="isUpTour" value="'.$game->isUpTour().'">';
						echo '<input hidden type="text" name="newCurrentPlayer" value="'.$game->newCurrentPlayerId().'">';
						echo '<input hidden type="text" name="currentPlayer" value="'.$game->getCurrentPlayerPseudo().'">';
						echo '<input class="target" type="submit" value="">';
						echo '</form>';
					}
				}
				foreach ($game->getUser1Pieces() as $key => $value) {
					if($value->getX() == $x && $value->getY() == $y){
						$class= $game->isFirstPlayer($game->getUser1()) ? 'white' : 'black';
						if($game->getUser1()==$game->getCurrentPlayer()){	
								echo '<form action="index.php?controller=game&action=refreshGame" method="POST">';
								echo '<input name="idPiece" hidden type="text" class="white" value="'.$value->getId().'">';
								echo '<input name="X" hidden type="text" class="white" value="'.$value->getX().'">';
								echo '<input name="Y" hidden type="text" class="white" value="'.$value->getY().'">';
								echo '<input name="move" hidden type="text" class="white" value="1">';
								echo '<button><img src="'.$value->getGabarit().'"></button>';
								echo '</form>';
						}
						else{
							echo '<img src="'.$value->getGabarit().'">';
						}
					}
				}
				foreach ($game->getUser2Pieces() as $key => $value) {
					if($value->getX() == $x && $value->getY() == $y){
						$class= $game->isFirstPlayer($game->getUser2()) ? 'white' : 'black';
						if($game->getUser2()==$game->getCurrentPlayer()){	
							echo '<form action="index.php?controller=game&action=refreshGame" method="POST">';
							echo '<input name="idPiece" hidden type="text" class="white" value="'.$value->getId().'">';
							echo '<input name="X" hidden type="text" class="white" value="'.$value->getX().'">';
							echo '<input name="move" hidden type="text" class="white" value="1">';
							echo '<input name="Y" hidden type="text" class="white" value="'.$value->getY().'">';
							echo '<button><img src="'.$value->getGabarit().'"></button>';
							echo '</form>';
						}
						else{
							echo '<img src="'.$value->getGabarit().'">';
						}
					}
				}
				echo'</td>';
			}
			echo '</tr>';
		}
	echo '</table>';
	?>
	<hr />
	<form method="POST" action="index.php?controller=game&action=restart">
		<input hidden type="text" name="gameId" value="<?=$game->getId()?>">
		<input type="submit" value="Recommencer la partie">
	</form>
<?php include('./Views/footer.php');?>
</body>
</html>