<?php
class taverneModel extends coreModel{
	//l' attribut pdo est dans la classe parente ModelController
	//la fonction makeselect() est dans la classe parente ModelController
	//la fonction makeStatement()  est dans la classe parente ModelController

	/*
	 ** @param int
	 ** @action On vérifie l'existance d'une taverne dans la BDD à partir de son idantifiant, si elle existe , on l'instancie
	 ** @return object Taverne
	  */
	public function verifyGroupe($taverneID){
		$sql = 'SELECT t_id,t_nom,t_chambres,t_blonde,t_brune,t_rousse,t_ville_fk, t_chambres-count(n_id) AS placesLibres FROM taverne INNER JOIN groupe ON t_id = g_taverne_fk INNER JOIN nain ON g_id = n_groupe_fk WHERE t_id = '.$taverneID;
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$maTaverne = array();
		foreach ($Results as $key => $value) {
			$maTaverne[] = new Taverne($value);
		}
		return $maTaverne[0];
	}

	/*
	 ** @param object Taverne
	 ** @action On recherche dans la BDD la ville dans laquelle la taverne se situe, puis on l'instancie
	 ** @return object Ville
	  */
	public function getMaVille(Taverne $taverne){
		$sql = 'SELECT * FROM ville INNER JOIN taverne ON v_id = t_ville_fk WHERE t_id = '.$taverne->_getID();
		$Results = $this->makeselect($sql);
		if(empty($Results)){
			return false;
		}
		$maVille = array();
		foreach ($Results as $key => $value) {
			$maVille[] = new Ville($value);
		}
		return $maVille[0];
	}	
}