<?php
class groupeModel extends coreModel{
	//l' attribut pdo est dans la classe parente ModelController
	//la fonction makeselect() est dans la classe parente ModelController
	//la fonction makeStatement()  est dans la classe parente ModelController

	/*
	 ** @param int
	 ** @action Cette fonction permet de vérifier dans la BDD si cet ID de groupe existe , si c'est le cas, on retourne le groupe et on l'instancie
	 ** @return object Groupe
	  */
	public function verifyGroupe(int $groupeID){
		$sql = 'SELECT * FROM groupe WHERE g_id = '.$groupeID;
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$monGroupe = array();
		foreach ($Results as $key => $value) {
			$monGroupe[] = new Groupe($value);
		}
		return $monGroupe[0];	
	}

	/*
	 ** @param object Groupe
	 ** @action Instancie les nains qui font parti du groupe et les enregistre dans un tableau qu l'on retourne
	 ** @return array contient des object Nains
	  */
	public function getNain(Groupe $groupe){
		$sql = 'SELECT * FROM nain INNER JOIN groupe ON n_groupe_fk = g_id WHERE g_id='.$groupe->_getID();
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$mesNains = array();
		foreach ($Results as $key => $value) {
			$mesNains[] = new Nain($value);
		}
		return $mesNains;
	}

	/*
	 ** @param object Groupe
	 ** @action Instancie la taverne associé au groupe et la retourne
	 ** @return object Taverne
	  */
	public function getTaverne(Groupe $groupe){
		$sql = 'SELECT t_id,t_nom,t_chambres,t_blonde,t_brune,t_rousse,t_ville_fk, t_chambres-count(n_id) AS placesLibres FROM taverne INNER JOIN groupe ON t_id = g_taverne_fk INNER JOIN nain ON g_id = n_groupe_fk  WHERE g_id= '.$groupe->_getID();
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$maTaverne = array();
		foreach ($Results as $key => $value) {
			$maTaverne[] = new Taverne($value);
		}
		if ($maTaverne[0]->_getID()==NULL){
			return false;
		}
		return $maTaverne[0];
	}

	/*
	 ** @param object Groupe
	 ** @action Instancie le tunnel associé au groupe et le retourne
	 ** @return object Tunnel
	  */
	public function getTunnel(Groupe $groupe){
		$sql = 'SELECT * FROM tunnel INNER JOIN groupe ON t_id = g_tunnel_fk WHERE g_id='.$groupe->_getID();
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$monTunnel = array();
		foreach ($Results as $key => $value) {
			$monTunnel[] = new Tunnel($value);
		}
		return $monTunnel[0];
	}

	/*
	 ** @param object Groupe
	 ** @action Instancie la ville de départ et la ville d'arrivé associé au tunnel du groupe
	 ** @return array contient des object Villes
	  */
	public function getVilles(Groupe $groupe){
		$sql = 'SELECT ville.* FROM ville INNER JOIN tunnel ON v_id = t_villedepart_fk OR v_id = t_villearrivee_fk INNER JOIN groupe ON t_id = g_tunnel_fk WHERE g_id='.$groupe->_getID();
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$mesVilles = array();
		foreach ($Results as $key => $value) {
			$mesVilles[] = new Ville($value);
		}
		return $mesVilles;
	}

	/*
	 ** @param object Groupe
	 ** @param varchar
	 ** @param varchar
	 ** @action Modifie dans la BDD les horaires d'embauche et débauche du groupe
	 ** @return 
	  */
	public function changerHoraire(Groupe $groupe,$debut,$fin){
		try{
			$sql = 'UPDATE groupe SET g_debuttravail = :debut,g_fintravail=:fin WHERE g_id = :ID';
		$params = array('debut'=>$debut,'fin'=>$fin,'ID'=>$groupe->_getID());
		$this->makeStatement($sql,$params);
		}
		catch(Exception $e){
			echo 'Probleme lors de la modification des horaires';
		}	
	}

	/*
	 ** @param object Groupe
	 ** @param int || 'aucun'
	 ** @action Modifie dans la BDD le tunnel associé au groupe
	 ** @return 
	  */
	public function changerTunnel(Groupe $groupe,$tunnel){
		try{
		$sql = 'UPDATE groupe SET g_tunnel_fk = :tunnel WHERE g_id = :ID';
		if($tunnel=='aucun'){
			$params = array('tunnel'=>NULL,'ID'=>$groupe->_getID());
		}
		else{
			$params = array('tunnel'=>$tunnel,'ID'=>$groupe->_getID());
		}		
		$this->makeStatement($sql,$params);
		}
		catch(Exception $e){
			echo 'Probleme lors de la modification du tunnel';
		}	
	}

	/*
	 ** @param object Groupe
	 ** @param int || NULL
	 ** @action Modifie dans la BDD le tunnel associé au groupe
	 ** @return 
	  */
	public function changerTaverne(Groupe $groupe,$taverne){
		try{
		$sql = 'UPDATE groupe SET g_taverne_fk = :taverne WHERE g_id = :ID';
		if($taverne=='aucun'){
			$params = array('taverne'=>NULL,'ID'=>$groupe->_getID());
		}
		else{
			$params = array('taverne'=>$taverne,'ID'=>$groupe->_getID());
		}		
		$this->makeStatement($sql,$params);
		}
		catch(Exception $e){
			echo 'Probleme lors de la modification de la taverne';
		}	
	}

	/*
	 ** @param
	 ** @action Récupere dans la BDD tous les tunnel puis les instancie
	 ** @return array (object Tunnel,..)
	  */
	public function getListTunnels(){
		$sql = 'SELECT * FROM tunnel ';
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$tunnels = array();
		foreach ($Results as $key => $value) {
			$tunnels[] = new Tunnel($value);
		}
		return $tunnels;
	}

	/*
	 ** @param
	 ** @action Récupere dans la BDD toutes les tavernes puis les instancie
	 ** @return array (object Taverne,..)
	  */
	public function getListTavernes(){
		$sql = 'SELECT t_id,t_nom,t_chambres,t_blonde,t_brune,t_rousse,t_ville_fk, t_chambres-count(n_id) AS placesLibres FROM taverne LEFT JOIN groupe ON t_id = g_taverne_fk LEFT JOIN nain ON g_id = n_groupe_fk GROUP BY t_id';
		$Results = $this->makeselect($sql);
		if (empty($Results)) {
			return false;
		}
		$tavernes = array();
		foreach ($Results as $key => $value) {
			$tavernes[] = new Taverne($value);
		}
		return $tavernes;
	}
}