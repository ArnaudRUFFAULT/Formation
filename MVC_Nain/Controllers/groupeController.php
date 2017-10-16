<?php
class groupeController extends coreController{
	//les attributs parameters et data sont dans la classe parente coreController

	/*
	 ** @params
	 ** @action Cette fonction permet d'afficher les information sur le groupe actuel et invoque le view correspondante
	 ** @return 
	  */
	public function afficherCaracteristiqueGroupeAction(){
		$model = new groupeModel;
		try{
			$monGroupe = $model -> verifyGroupe($this->parameters['groupe']);
			if (!empty($monGroupe)) {
				$mesNains = $model->getNain($monGroupe);
				$maTaverne = $model->getTaverne($monGroupe);
				$monTunnel = $model->getTunnel($monGroupe);
				$mesVilles = $model->getVilles($monGroupe);
				$listeTunnels = $model->getListTunnels();
				$listeTavernes = $model->getListTavernes();
				include ('.'.DS.'Views'.DS.'Groupe'.DS.'groupeView.php');
			}	
		}
		catch(Exception $e)	{
			include('.'.DS.'Views'.DS.'error.php');
		}	
	}

	/*
	 ** @params
	 ** @action Cette fonction permet de modifier les heures d'embauche et de débauche du groupe actuel et redirige sur l'affichage du groupe
	 ** @return 
	  */
	public function changerHoraireAction(){
		$model = new groupeModel;
		$monGroupe = $model -> verifyGroupe($this->parameters['groupe']);
		$model -> changerHoraire($monGroupe,$this->parameters['debut'],$this->parameters['fin']);
		header('Location:index.php?c=groupe&a=afficherCaracteristiqueGroupe&groupe='.$monGroupe->_getID());
	}

	/*
	 ** @params
	 ** @action Cette fonction permet de modifier le tunnel du  groupe actuel et redirige sur l'affichage du groupe
	 ** @return 
	  */
	public function changerTunnelAction(){
		$model = new groupeModel;
		$monGroupe = $model -> verifyGroupe($this->parameters['groupe']);
		$model -> changerTunnel($monGroupe,$this->parameters['tunnel']);
		header('Location:index.php?c=groupe&a=afficherCaracteristiqueGroupe&groupe='.$monGroupe->_getID());
	}

	/*
	 ** @params
	 ** @action Cette fonction permet de modifier la taverne du groupe actuel et redirige sur l'affichage du groupe
	 ** @return 
	  */
	public function changerTaverneAction(){
		$model = new groupeModel;
		$monGroupe = $model -> verifyGroupe($this->parameters['groupe']);
		$mesNains = $model->getNain($monGroupe);
		$listeTavernes = $model->getListTavernes();
		$futurtaverne = '';
		foreach ($listeTavernes as $key => $value) {
			if($value->_getPlacesLibres() >= count($mesNains)){
				$model -> changerTaverne($monGroupe,$this->parameters['taverne']);
			}
		}	
		header('Location:index.php?c=groupe&a=afficherCaracteristiqueGroupe&groupe='.$monGroupe->_getID());
	}

}
