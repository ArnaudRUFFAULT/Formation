<?php
class villeController extends coreController{
	//les attributs parameters et data sont dans la classe parente coreController
	
	/*
	 ** @params
	 ** @action Cette fonction permet l'affichage de la page Ville
	 ** @return 
	  */
	public function afficherCaracteristiqueVilleAction(){
		$model = new villeModel;
		if(array_key_exists('ville', $this->parameters)){
			if(is_numeric($this->parameters['ville'])){
				$mVille = $model -> verifyVille($this->parameters['ville']);
				
				if(empty($mVille)){
					$controller = new errorController();
					$controller->ExistePas();
				}
				else{
					$infoTunnel=array();
					$maVille=array();
					$maVille['mesTavernes'] = $model -> getTavernesVille($mVille);
					$maVille['mesNains'] = $model -> getNainsVille($mVille);
					$maVille['mesTunnels'] = $model -> getTunnelsVille($mVille);
					$maVille['mesVilles'] = $model -> getVilleArrivee($mVille);
					include ('.'.DS.'Views'.DS.'Ville'.DS.'villeView.php');		
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