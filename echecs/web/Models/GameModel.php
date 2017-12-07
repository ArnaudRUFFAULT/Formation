<?php
class GameModel extends CoreModel{

	public function issetGameDB($idUser1,$idUser2){
		$sql = 'SELECT * FROM game WHERE ( g_user1_fk = :user1 AND g_user2_fk = :user2 ) OR ( g_user1_fk = :user2 AND g_user2_fk = :user1 )';
		$params = array(
					'user1' => $idUser1, 
					'user2' => $idUser2
				);

		$request = $this->MakeSelect($sql, $params);

		$issetGame = $request != NULL ? true : false ;

		return $issetGame;
	}

	public function getGameDB($idUser1,$idUser2){
		$sql = 'SELECT * FROM game WHERE ( g_user1_fk = :user1 AND g_user2_fk = :user2 ) OR ( g_user1_fk = :user2 AND g_user2_fk = :user1 )';
		$params = array(
					'user1' => $idUser1, 
					'user2' => $idUser2
				);

		$request = $this->MakeSelect($sql, $params);
		$game = array();
		foreach ($request as $key => $value) {
			$game[] = new Game($value);
		}
		return $game[0];
	}

	public function getGameByIdDB($id){
		$sql = 'SELECT * FROM game WHERE  g_id = :id';
		$params = array('id' => $id);

		$request = $this->MakeSelect($sql, $params);
		$game = array();
		foreach ($request as $key => $value) {
			$game[] = new Game($value);
		}
		return $game[0];
	}

	public function saveGameDB($idUser1,$idUser2,$tour,$firstPlayer,$currentPlayer){
		$sql = 'INSERT INTO game SET g_user1_fk = :user1, g_user2_fk = :user2, g_tour = :tour, g_firstPlayer = :first, g_currentPlayer = :currentPlayer';
		$params = array(
					'user1' => $idUser1, 
					'user2' => $idUser2,
					'tour' => $tour,
					'first' => $firstPlayer,
					'currentPlayer' => $currentPlayer
				);

		if($this->MakeStatement($sql, $params)){
			return true;
		}
		return false;
	}

	public function updateTourDB($gameId,$tour){
		$sql= 'UPDATE game SET  g_tour = :tour WHERE g_id = :id';
		$params = array('id' => $gameId, 'tour' => $tour);
		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}

	public function updateCurrentPlayerDB($gameId, $CurrentPlayerId){
		$sql= 'UPDATE game SET  g_currentPlayer = :currentPlayer WHERE g_id = :id';
		$params = array('id' => $gameId, 'currentPlayer' => $CurrentPlayerId);
		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}

	public function deleteGame($id){
		$sql = 'DELETE FROM game WHERE g_id = :id';
		$params = array('id' => $id);
		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}
}