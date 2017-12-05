<?php
class AcceuilController extends CoreController{

	public function afficherAcceuil(){
		include('./view/acceuil.php');
	}

	public function getCities(){
		$model = new VilleModel();
		$request = $model -> getCitiesDB(ucfirst($this->parameters['piece']));
		echo json_encode($request);
	}

	function getficheVille(){
		$ville =ucfirst(htmlentities($this->parameters['request']));
		$model = new VilleModel();
		$maVille = $model -> getCityDB($ville);
		include('./view/ficheVille.php');
	}
}