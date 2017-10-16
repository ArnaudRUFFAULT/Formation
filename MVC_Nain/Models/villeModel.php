<?php
class villeModel extends coreModel{
	//l' attribut pdo est dans la classe parente ModelController
	//la fonction makeselect() est dans la classe parente ModelController
	//la fonction makeStatement()  est dans la classe parente ModelController

	/*
	 ** @param int
	 ** @action On vérifie l'existance d'une ville dans la BDD à partir de son idantifiant, si elle existe , on l'instancie
	 ** @return object Ville
	  */
	public function verifyVille($villeID){
		$sql = 'SELECT * FROM ville WHERE v_id = '.$villeID;
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$maVille = array();
		foreach ($Results as $key => $value) {
			$maVille[] = new Ville($value);
		}
		return $maVille[0];
	}

	/*
	 ** @param object Ville
	 ** @action On cherche dans la BDD toutes les tavernes de la ville , puis on les instancie
	 ** @return array(object Taverne,..)
	  */
	public function getTavernesVille(Ville $mVille){
		$sql = 'SELECT t_id,t_nom,t_chambres,t_blonde,t_brune,t_rousse,t_ville_fk, t_chambres-count(n_id) AS placesLibres FROM taverne INNER JOIN groupe ON t_id = g_taverne_fk INNER JOIN nain ON g_id = n_groupe_fk INNER JOIN ville ON t_ville_fk = v_id WHERE v_id = '.$mVille->_getID();
		$Results = $this->makeselect($sql);
		$mesTavernes=array();
		if (empty($Results)) {
			return false;
		}
		foreach ($Results as $key => $value) {
			$mesTavernes[] = new Taverne($value);
		}
		return $mesTavernes;
	}

	/*
	 ** @param object Ville
	 ** @action On cherche dans la BDD tous les nains originaires  de la ville , puis on les instancie
	 ** @return array(object Nain,..)
	  */
	public function getNainsVille(Ville $mVille){
		$sql = 'SELECT * FROM nain WHERE n_ville_fk = '.$mVille->_getID();
		$Results = $this->makeselect($sql);
		$mesNains=array();
		if (empty($Results)) {
			return false;
		}
		foreach ($Results as $key => $value) {
			$mesNains[] = new Nain($value);
		}
		return $mesNains;
	}

	/*
	 ** @param object Ville
	 ** @action On cherche dans la BDD tous les tunnels dont la ville de départ est notre ville, puis on les instancie
	 ** @return array(object Tunnel,..)
	  */
	public function getTunnelsVille(Ville $mVille){
		$sql = 'SELECT * FROM tunnel WHERE t_villedepart_fk = '.$mVille->_getID();
		$Results = $this->makeselect($sql);
		$mesTunnels=array();
		if (empty($Results)) {
			return false;
		}
		foreach ($Results as $key => $value) {
			$mesTunnels[] = new Tunnel($value);
		}
		return $mesTunnels;
	}

	/*
	 ** @param object Ville
	 ** @action On cherche dans la BDD toutes les villes reliées à notre ville par un tunnel , puis on les instancie
	 ** @return array(object Ville,..)
	  */
	public function getVilleArrivee(Ville $mVille){
		$sql = 'SELECT arrivee.v_id,arrivee.v_nom, arrivee.v_superficie FROM ville AS arrivee INNER JOIN tunnel ON arrivee.v_id = t_villearrivee_fk INNER JOIN ville AS depart ON t_villedepart_fk = depart.v_id WHERE depart.v_id = '.$mVille->_getID();
		$Results = $this->makeselect($sql);
		$mesVilles=array();
		if (empty($Results)) {
			return false;
		}
		foreach ($Results as $key => $value) {
			$mesVilles[] = new Ville($value);
		}
		return $mesVilles;
	}
}