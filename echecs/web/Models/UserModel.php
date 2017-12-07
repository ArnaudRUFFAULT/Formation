<?php
class UserModel extends CoreModel{

	public function issetUserDB($pseudoUser){
		$sql = 'SELECT * FROM user WHERE u_pseudo = :pseudo';
		$params = array ('pseudo' => $pseudoUser);
		$request = $this->MakeSelect($sql, $params);
		$issetUser = $request != NULL ? true : false ;
		return $issetUser;
	}


	public function getUserDB($pseudoUser){
		$sql = 'SELECT * FROM user WHERE u_pseudo = :pseudo';
		$params = array ('pseudo' => $pseudoUser);
		$request = $this->MakeSelect($sql, $params);

		$user = array();
		foreach ($request as $key => $value) {
			$user[] = new User($value);
		}

		return $user[0];
	}

	public function getUserByIdDB($idUser){
		$sql = 'SELECT * FROM user WHERE u_id = :id';
		$params = array ('id' => $idUser);
		$request = $this->MakeSelect($sql, $params);

		$user = array();
		foreach ($request as $key => $value) {
			$user[] = new User($value);
		}
		return $user[0];
	}

	public function AddUserDB($pseudo){
		$sql ='INSERT INTO user (u_pseudo) VALUES (:pseudo)';
		$params = array('pseudo'=>$pseudo);
		if($this->MakeStatement($sql,$params)){
			return true;
		}
		return false;
	}
}