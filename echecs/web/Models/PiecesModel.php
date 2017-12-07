<?php
class PiecesModel extends CoreModel{

	public function initializePieceDB($idGame, $idUser1, $idUser2){
		$sql= '
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="roi", p_X = 3, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="reine", p_X = 4, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="pion", p_X = 0, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="pion", p_X = 1, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="pion", p_X = 6, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="pion", p_X = 7, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="cavalier", p_X = 2, p_Y = 0, p_YDepart = 0;
			INSERT INTO piece SET p_user_fk = :user1, p_game_fk = :game, p_type ="cavalier", p_X = 5, p_Y = 0, p_YDepart = 0;

			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="roi", p_X = 3, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="reine", p_X = 4, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="pion", p_X = 0, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="pion", p_X = 1, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="pion", p_X = 6, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="pion", p_X = 7, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="cavalier", p_X = 2, p_Y = 7, p_YDepart = 7;
			INSERT INTO piece SET p_user_fk = :user2, p_game_fk = :game, p_type ="cavalier", p_X = 5, p_Y = 7, p_YDepart = 7;';

		$params = array('user1' => $idUser1,'user2' => $idUser2, 'game' => $idGame);

		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}

	public function getPiecesDB($idUser,$idGame, $color){
		$sql= 'SELECT * FROM piece WHERE p_user_fk = :user AND p_game_fk = :game';
		$params = array('user' => $idUser, 'game' => $idGame);
		$request = $this->MakeSelect($sql,$params);

		$myPieces = array();
		foreach ($request as $key => $value) {
			switch ($value['p_type']) {
				case 'pion':
					$myPieces[] = new Pion($value,$color);
					break;

				case 'cavalier':
					$myPieces[] = new Cavalier($value,$color);
					break;

				case 'roi':
					$myPieces[] = new Roi($value,$color);
					break;

				case 'reine':
					$myPieces[] = new Reine($value,$color);
					break;
			}
		}
		return $myPieces;
	}

	public function getPieceByIdDB($id){
		$sql= 'SELECT * FROM piece WHERE p_id = :id';
		$params = array('id' => $id);
		$request = $this->MakeSelect($sql,$params);

		$myPiece = array();
		foreach ($request as $key => $value) {
			switch ($value['p_type']) {
				case 'pion':
					$myPieces[] = new Pion($value);
					break;

				case 'cavalier':
					$myPieces[] = new Cavalier($value);
					break;

				case 'roi':
					$myPieces[] = new Roi($value);
					break;

				case 'reine':
					$myPieces[] = new Reine($value);
					break;
			}
		}
		return $myPieces[0];
	}

	public function updatePieceByIdDB($id,$X,$Y){
		$sql= 'UPDATE piece SET p_X = :X , p_Y = :Y WHERE p_id = :id';
		$params = array('id' => $id,'X' => $X, 'Y' => $Y);
		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}

	public function getPieceAtCoordDB($gameId, $X, $Y){
		$sql = 'SELECT p_id,p_type FROM piece WHERE p_game_fk=:game AND p_X =:X AND p_Y=:Y';
		$params=array('game'=>$gameId, 'X'=>$X, 'Y'=>$Y);
		$request = $this->MakeSelect($sql, $params);

		$piece= array();
		foreach ($request as $key => $value) {
			$piece[] = $value;
		}
		return $piece;
	}

	public function deletePieceDB($id){
		$sql = 'DELETE FROM piece WHERE p_id = :id';
		$params = array('id' => $id);
		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}
}