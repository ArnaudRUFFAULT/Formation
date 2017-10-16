<?php
class homeModel extends coreModel{
	//l' attribut pdo est dans la classe parente ModelController
	//la fonction makeselect() est dans la classe parente ModelController
	//la fonction makeStatement()  est dans la classe parente ModelController

	/*
	 ** @param
	 ** @action Récupere dans la BDD tous les nains puis les instancie
	 ** @return array (object Nain,..)
	  */
	public function getAllNains(){
		$mesNains=array();
		$sql='SELECT * FROM nain ORDER BY n_nom';
		$Results = $this->makeselect($sql);
		foreach ($Results as $key => $value) {
			$mesNains[] = new Nain($value);
		}
		return $mesNains;
	}

	/*
	 ** @param
	 ** @action Récupere dans la BDD toutes les villes puis les instancie
	 ** @return array (object Ville,..)
	  */
	public function getAllVilles(){
		$mesVilles=array();
		$sql='SELECT * FROM ville ORDER BY v_nom';
		$Results = $this->makeselect($sql);
		foreach ($Results as $key => $value) {
			$mesVilles[] = new Ville($value);
		}
		return $mesVilles;
	}

	/*
	 ** @param
	 ** @action Récupere dans la BDD toutes les tavernes puis les instancie
	 ** @return array (object Taverne,..)
	  */
	public function getAllTavernes(){
		$mesTavernes = array();
		$sql='SELECT t_id,t_nom,t_chambres,t_blonde,t_brune,t_rousse,t_ville_fk, t_chambres-count(n_id) AS placesLibres FROM taverne LEFT JOIN groupe ON t_id = g_taverne_fk LEFT JOIN nain ON g_id = n_groupe_fk GROUP BY t_id';
		$Results = $this->makeselect($sql);
		foreach ($Results as $key => $value) {
			$mesTavernes[] = new Taverne($value);
		}
		return $mesTavernes;
	}
	/*
	 ** @param
	 ** @action Récupere dans la BDD tous les groupes puis les instancie
	 ** @return array (object Groupe,..)
	  */
	public function getAllGroupes(){
		$mesGroupes = array();
		$sql='SELECT * FROM groupe ORDER BY g_id';
		$Results = $this->makeselect($sql);
		foreach ($Results as $key => $value) {
			$mesGroupes[] = new Groupe($value);
		}
		return $mesGroupes;
	}
	
}