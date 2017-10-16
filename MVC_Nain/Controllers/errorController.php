<?php
class errorController extends coreController{
	public function controllerInexistantAction(){
		$error = 'Ce controller n\' existe pas';
		include ('.'.DS.'Views'.DS.'error.php');
	}

	public function actionInexistanteAction(){
		$error = 'Cette action n\' existe pas';
		include ('.'.DS.'Views'.DS.'error.php');
	}

	public function parametreNonNumerique(){
		$error = 'Le parametre attendu doit être numerique';
		include ('.'.DS.'Views'.DS.'error.php');
	}

	public function ExistePas(){
		$error = 'Aucune entité recherché utilise cet identifiant';
		include ('.'.DS.'Views'.DS.'error.php');
	}

	public function parametreInvalide(){
		$error = 'Ce parametre n\'existe pas';
		include ('.'.DS.'Views'.DS.'error.php');
	}
}