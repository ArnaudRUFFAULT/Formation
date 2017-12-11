<?php
class UserController extends CoreController{

	public function connexionView(array $message = null){
		include('./Views/User/connexionView.php');
	}

	public function connexion(){
		$model = new UserModel();
		try{
			$user = $model -> checkUser($this->data['mail'],$this->data['password']);
			if($user !== false){
				$_SESSION['user'] = $user->getId();
				header('Location:index.php?controller=produit&action=getAllProducts');
				exit;
			}
			else{
				$this->connexionView(array('error'=>'Utilisateur introuvable dans la base de donnée'));
			}
		}
		catch(Exception $e){
			$this->connexionView(array('error'=>'Problème de connexion à la base de donnée, veuillez réessayer plus tard'));
		}
		
	}

	public function seDeconnecter(){
		unset($_SESSION);
		header('Location:index.php');
	}
}