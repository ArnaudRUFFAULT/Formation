<?php
class PaysModel extends CoreModel{

	public function getPays(){
		$pays = array();
		$request=$this->MakeSelect('SELECT pays_id,pays_nom FROM pays ORDER BY  pays_nom');
		foreach ($request as $key => $data) {

			$pays[$data['pays_id']]=$data['pays_nom'];
		}
		return $pays;
	}
}