<?php
class nainController extends coreController{
	//les attributs parameters et data sont dans la classe parente coreController
	
	/*
	 ** @params
	 ** @action Cette fonction permet l'affichage de la page Nain
	 ** @return 
	  */
	public function afficherCaracteristiqueNainAction(){
		$model = new nainModel;
		if(isset($this->parameters['nain'])){
			if(is_numeric($this->parameters['nain'])){
				$monNain = $model -> afficherCaracteristiqueNain($this->parameters['nain']);
				if(!$monNain){
					$controller = new errorController();
					$controller->ExistePas();	
				}
				else{
					$infoMonNain = $model -> recupInfoNain($monNain);
					$mesGroupes = $model ->getAllGroupes();
					include ('.'.DS.'Views'.DS.'Nain'.DS.'nainView.php');		
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
	
	/*
	 ** @params
	 ** @action Cette fonction permet de changer le groupe du nain actuel, redirige ensuite sur l'affichage de la page nain
	 ** @return 
	  */
	public function changerGroupeAction(){
		$model = new nainModel;
		$model -> changerGroupeduNain($this->parameters['nain'],$this->parameters['nouveauGroupe']);
		header('Location:index.php?c=nain&a=afficherCaracteristiqueNain&nain='.$this->parameters['nain']);
		exit;
	}
		
}