<?php
class AcceuilController extends CoreController{

	public function afficherAcceuil(){
		$model = new PaysModel();
		$pays = $model->getPays();
		include('./view/acceuil.php');
	}

	public function requestDepartement(){
		$model = new DepartementModel();
		$departement = $model->getDepartement($this->data['idPays']);
		echo json_encode($departement);
	}

	public function requestVille(){
		$model = new VilleModel();
		$ville = $model->getVille($this->data['idDepartement']);
		echo json_encode($ville);
	}

	public function requestCaracteristiqueVille(){
		$model = new VilleModel();
		$maVille = $model->getCaracteristiqueVille($this->data['idVille']);
		echo json_encode($maVille);
	}
}