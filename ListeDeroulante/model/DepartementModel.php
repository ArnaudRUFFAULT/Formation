<?php
class DepartementModel extends CoreModel{

		public function getDepartement($idPays){
		$departements = array();
		$request=$this->MakeSelect('SELECT departement_id,departement_nom, departement_code FROM departement INNER JOIN pays ON departement_pays = pays_id WHERE pays_id = '.$idPays.' ORDER BY departement_nom');
		foreach ($request as $key => $data) {
			$departements[$data['departement_id']]=$data['departement_code'].' || '.$data['departement_nom'];
		}
		return $departements;
	}
}