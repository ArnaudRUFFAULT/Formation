<?php
class UserModel extends CoreModel{

	public function checkUser($mail,$password){
		$sql = 'SELECT * FROM user WHERE u_mail = :mail AND u_password = :password';
		$params = array('mail'=>$mail, 'password'=>$password);
		$request = $this->makeSelect($sql,$params);

		if(!empty($request)){
			$user = array();
			foreach ($request as $key => $value) {
				$user[] = new User($value);
			}
			return $user[0];
		}

		return false;
	}

	public function getUser($id){
		$sql = 'SELECT * FROM user WHERE u_id=:id';
		$params = array('id'=>$id);
		$request = $this->makeSelect($sql, $params);
		$user = array();
		foreach ($request as $key => $value) {
			$user[] = new User($value);
		}
		return $user[0];
	}
}