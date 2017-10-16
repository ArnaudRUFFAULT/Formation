<?php
class taverneController extends coreController{
	//les attributs parameters et data sont dans la classe parente coreController
	
	/*
	 ** @params
	 ** @action Cette fonction permet l'affichage de la page Taverne
	 ** @return 
	  */
	public function afficherCaracteristiqueTaverneAction(){
		$model = new taverneModel;
		if (array_key_exists('taverne', $this->parameters)){
			if(is_numeric($this->parameters['taverne'])){
				$maTaverne = $model -> verifyGroupe($this->parameters['taverne']);
				if (!empty($maTaverne)) {
					$maVille = $model -> getMaVille($maTaverne);
					include ('.'.DS.'Views'.DS.'Taverne'.DS.'taverneView.php');
				}
				else{
					$controller = new errorController();
					$controller->ExistePas();
				}
			}
			else{
				$controller = new errorController();
				$controller->parametreNonNumerique();
			}		
		}
		else{
			$controller = new errorController();
			$controller->parametreInvalide();
		}
		
	}
}