<?php
class UserController extends CoreController{
	/**
	 * Affiche la vue pour se connecter/s'inscrire
	 * @param  array|null $error permet de passer des erreur à la vue si il en existe
	 */
	public function acceuil(array $error = null){
		$model = new UserModel();
		$user1 = null;
		$user2 = null;

		if(!empty($_SESSION['echecs']['user1'])){
			$user1 = $model->getUserByIdDB($_SESSION['echecs']['user1']);
		}

		if(!empty($_SESSION['echecs']['user2'])){
			$user2 = $model->getUserByIdDB($_SESSION['echecs']['user2']);
		}
		include('./Views/User/AcceuilView.php');
	}

	/**
	 * Verifie que le pseudo tapé par l'utilisateur existe en BDD et le connecte en tant que Joueur 1, retourne la vue d'acceuil
	 */
	public function user1(){
		$error= array();
		$userPseudo = htmlentities($this->data['user1']);
		$model = new UserModel();
		if($model->issetUserDB($userPseudo)){
			$user1 = $model->getUserDB($userPseudo);
			$_SESSION['echecs']['user1'] = $user1->getId();
		}
		else{
			$error['user1'] ='Cet utilisateur n\'existe pas en base de donnée';
		}
		$this->acceuil($error);
	}

	/**
	 * Verifie que le pseudo tapé par l'utilisateur existe en BDD et le connecte en tant que Joueur 2, retourne la vue d'acceuil
	 */
	public function user2(){
		$error= array();
		$userPseudo = htmlentities($this->data['user2']);
		$model = new UserModel();
		if($model->issetUserDB($userPseudo)){
			$user2 = $model->getUserDB($userPseudo);
			$_SESSION['echecs']['user2'] = $user2->getId();
		}
		else{
			$error['user2'] ='Cet utilisateur n\'existe pas en base de donnée';
		}
		$this->acceuil($error);
	}
	/**
	 * Supprime la session 'echecs' en cours et redirige sur l'acceuil
	 */
	public function deco(){
		unset($_SESSION['echecs']);
		header('Location:index.php');
	}

	/**
	 * Ajoute un utilisateur en BDD si le gestionnaire ne renvoie aucune erreur et retounr la vue d'acceuil sans erreur, sinon on retourne la vue d'acceuil avec les erreurs detectés
	 */
	public function addUser(){
		$model = new UserModel();
		//On vérifie que ce pseudo ne soit pas déjà en BDD
		if($model->issetUserDB($this->data['pseudo'])){
			$this->acceuil(array('pseudoUtilise'=>'Ce pseudo existe deja en base de donnée'));
		}
		else{
			$error=array();
			$handler = new InscriptionHandler(array('pseudo'=>$this->data['pseudo']));
			if(count($handler->checkInfo()) == 0){
				$model->AddUserDB($this->data['pseudo']);
				$error['inscriptionOK']='Enregistrement effectué , vous pouvez vous connecter';
			}
			else{
				$error['pseudo']=$handler->checkInfo()['pseudo'];
			}
			$this->acceuil($error);
		}
	}
}