<?php
class GameController extends CoreController{
	/**
	 * Permet de mettre à jour l'affichage à partir des données récoltés en BDD des Pieces, de la progression de la partie et des Joueurs
	 */
	public function refreshGame(){
		$mesCases = array();

		$idUser1= $this->session['user1'];
		$idUser2= $this->session['user2'];

		$model = new GameModel();

		if($model->issetGameDB($idUser1,$idUser2)){
			$game = $model->getGameDB($idUser1,$idUser2);
			$user1 = $this->getUsers($idUser1);
			$user1Color = $game->isFirstPlayer($user1) ? 'white' : 'black';
			$user1Pieces = $this->getPieces($idUser1, $game->getId(),$user1Color);
			$user2 = $this->getUsers($idUser2);
			$user2Color = $game->isFirstPlayer($user2) ? 'white' : 'black';
			$user2Pieces = $this->getPieces($idUser2, $game->getId(),$user2Color);
			$game->setUser1($user1);
			$game->setPiecesUser1($user1Pieces);
			$game->setUser2($user2);
			$game->setPiecesUser2($user2Pieces);
			if(isset($this->data['move'])){
				$mesCases = $this->newCases($game);
			}
			$this->getView($game,$mesCases);
		}
		else{
			$firstPlayer = rand(0,1) == 0 ? $idUser1 : $idUser2;
			if($model->saveGameDB($idUser1,$idUser2,1,$firstPlayer,$firstPlayer)){
				$game = $model->getGameDB($idUser1,$idUser2);
				$idGame = $game->getId();
				$piecesModel = new PiecesModel();
				if($piecesModel->initializePieceDB($idGame,$idUser1,$idUser2)){
					$this->refreshGame();
				}
				else{
					echo 'Initialisation des pièces impossible';
				}
			}
			else{
				echo 'Sauvegarde d\une nouvelle partie impossible';
			}
		}
	}

	/**
	 * Retourne un tableau qui contient les coordonnées des cases ou la piece d'ID idPiece peut circuler
	 * @param  Object $game Instance de Game
	 * @return array
	 */
	private function newCases($game){
		$myPiece = null;
		$playerPiece = $game->getCurrentPlayerPieces();
		foreach ($playerPiece as $key => $value) {
			if ($value->getId()==$this->data['idPiece']){
				$myPiece = $value;
				$cases = $game->getNewCases($myPiece);
				return $cases;
			}
		}
	}

	/**
	 * Recupere dans la BDD un utilisateur grâce à son ID et retourne une instance de classe User de cette utilisateur
	 * @param  int $idUser 
	 * @return Object
	 */
	private function getUsers($idUser){

		$model = new UserModel();

		$user = $model->getUserByIdDB($idUser);

		return $user;
	}

	/**
	 * Recupere dans un tableau les instances de pieces appartenant à un utilisateur d'ID $idUser, dans la partie d'ID $idGame, et determine si il faut afficher en blanc ou en noir ($color)
	 * @param  int $idUser 
	 * @param  int $idGame 
	 * @param  string $color  'blanc' ou 'noir'
	 * @return array         tableau d'instances de Piece
	 */
	private function getPieces($idUser,$idGame, $color){
		$model = new PiecesModel();

		$pieces = $model->getPiecesDB($idUser,$idGame, $color);

		return $pieces;
	}

	/**
	 * Invoque la vue de l'échiquier
	 * @param  Object $game     Instance de Game
	 * @param  array $mesCases tableau de coordonnées qui correspond aux cases où la piece qui a été selectionné peut se placer
	 */
	private function getView($game,$mesCases){
		include('./Views/Layout/Plateau.php');
	}

	/**
	 * Quand une piece est deplace, la base de donnée est mise à jour, nouvelles coordonné des pieces, a qui de jouer, quel tour etc.. et on invoque la vue
	 */
	public function updateGame(){

		$movedPieceId = $this->data['idPiece'];
		$newX =	$this->data['X'];
		$newY =	$this->data['Y'];

		$currentPlayerId = $this->data['currentPlayer'];
		$newCurrentPlayerId = $this->data['newCurrentPlayer'];
		$changeTour = $this->data['isUpTour'] == 1 ? true : false;
		$newTour= $this->data['tour']+1;
		$gameId = $this->data['gameId'];

		$pieceModel = new PiecesModel();
		$gameModel = new GameModel();

		$toDeletePiece = $pieceModel->getPieceAtCoordDB($gameId, $newX, $newY);
		if(!empty($toDeletePiece)){
			$pieceModel->deletePieceDB($toDeletePiece[0]['p_id']);
			if($toDeletePiece[0]['p_type']=='roi'){
				header('location:index.php?controller=game&action=partyOver&idWinner='.$currentPlayerId);
				exit;
			}
		}

		if($pieceModel->updatePieceByIDDB($movedPieceId,$newX,$newY)){
			if($changeTour){
				$gameModel->updateTourDB($gameId,$newTour);
			}			
			$gameModel->updateCurrentPlayerDB($gameId,$newCurrentPlayerId);
			$this->refreshGame();
		}
		else{
			echo 'mise a jour de la BDD impossible';
		}
		
	}

	/**
	 * Permet de réinitialiser une partie et de retourner une vue
	 */
	public function restart(){
		$model =new GameModel();
		$model->deleteGame($this->data['gameId']);
		$this->refreshGame();
	}

	/**
	 * Cette methode est appelé lorqu'une partie est terminé , affiche la page de victoire
	 * @return [type] [description]
	 */
	public function partyOver(){
		include('./Views/partyOver.php');
	}
}