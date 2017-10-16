<?php
class nainModel extends coreModel{
	//l' attribut pdo est dans la classe parente ModelController
	//la fonction makeselect() est dans la classe parente ModelController
	//la fonction makeStatement()  est dans la classe parente ModelController

	/*
	 ** @param int
	 ** @action On récupère dans la BDD un nain à partir de son identifiant, puis on l'instancie
	 ** @return object Nain
	  */
	public function afficherCaracteristiqueNain( int $nainID){
		$sql = 'SELECT * FROM nain WHERE n_id = '.$nainID;
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		foreach ($Results as $key => $value) {
			$monNain[] = new Nain($value);
		}
		return $monNain[0];
	}

	/*
	 ** @param object Nain
	 ** @action On récupère dans la BDD plusieurs informations pour la page sur les ville de départ et d'arrivee du tunnel dont le nain est affecté etc..
	 ** @return array
	  */
	public function recupInfoNain(Nain $Nain){
		$sql = 'SELECT villeOrigine.v_nom AS villeOrigine,villeOrigine.v_id AS IDOrigine,t_nom, taverne.t_id , g_debuttravail,g_fintravail,tunnel.t_id AS tunnelID,villeDepart.v_nom AS villeDepart,villeDepart.v_id AS DepartID, villeArrive.v_nom AS villeArrive,villeArrive.v_id AS ArriveeID
			FROM nain 
			LEFT JOIN groupe ON n_groupe_fk = g_id 
			LEFT JOIN taverne ON g_taverne_fk = taverne.t_id
			LEFT JOIN tunnel ON g_tunnel_fk = tunnel.t_id
			LEFT JOIN ville AS villeDepart ON t_villedepart_fk = villeDepart.v_id
			LEFT JOIN ville AS villeArrive ON t_villearrivee_fk = villeArrive.v_id
			LEFT JOIN ville AS villeOrigine ON n_ville_fk = villeOrigine.v_id
			WHERE n_id = '.$Nain -> _getID();
		$Results = $this->makeselect($sql);
		return$Results[0];
	}

	/*
	 ** @param 
	 ** @action On récupère dans la BDD tous les groupes, on les instancie et on les retourne sous forme de tableau
	 ** @return array(object Groupe,..)
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

	/*
	 ** @param int
	 ** @param int || 'aucun'
	 ** @action On récupère dans la BDD tous les groupes, on les instancie et on les retourne sous forme de tableau
	 ** @return array(object Groupe,..)
	  */
	public function changerGroupeduNain( int $nainID, $newGroupID){
		$sql =  'UPDATE nain SET n_groupe_fk = :groupe WHERE n_id = :ID';
		if($newGroupID == 'aucun'){
			$params = array('groupe'=>NULL,'ID'=>$nainID);
		}
		else{
			$params = array('groupe'=>$newGroupID,'ID'=>$nainID);
		}
		
		$this->makeStatement($sql, $params);
	}

}