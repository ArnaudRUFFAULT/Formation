<?php
class VilleModel extends CoreModel{

	public function getVille($idDepartement){
	$villes = array();
	$request=$this->MakeSelect('SELECT ville_id,ville_nom_reel FROM ville INNER JOIN departement ON ville_departement = departement_id WHERE departement_id = '.$idDepartement.' ORDER BY ville_nom_reel');
	foreach ($request as $key => $data) {
		//$villes[$data['ville_id']]=$data['ville_nom_reel'];
		$villes[]=array("id"=>$data['ville_id'],"nom"=>$data['ville_nom_reel']);
	}
	return $villes;
	}

	public function getCaracteristiqueVille($idVille){
		$maVille = array();
		$request=$this->MakeSelect('SELECT * FROM ville  WHERE ville_id = '.$idVille);
		foreach ($request as $key => $data) {
			$maVille[] = new Ville($data);
		}
		return $maVille[0];
	}
}