<?php
class Groupe{
	/*
	 ** int L'identifiant du groupe
	  */
	private $g_id;

	/*
	 ** varchar Heure d'embauche du groupe
	  */
	private $g_debuttravail;

	/*
	 ** varchar heure de débauche du groupe
	  */
	private $g_fintravail;

	/*
	 ** int L'identifiant de la taverne associé au groupe
	  */
	private $g_taverne_fk;

	/*
	 ** int L'identifiant du tunnel associé au groupe
	  */
	private $g_tunnel_fk;

	/*
	 ** @params array Tableau qui comprend toutes les information à la création d'une instance de Groupe
	 ** @action Instancie un groupe
	 ** @return 
	  */
	public function __construct(array $data){
		$this->g_id = $data['g_id'];
		$this->g_debuttravail = $data['g_debuttravail'];
		$this->g_fintravail = $data['g_fintravail'];
		$this->g_taverne_fk = $data['g_taverne_fk'];
		$this->g_tunnel_fk = $data['g_tunnel_fk'];
	}

	/*
	 ** @params 
	 ** @action retourne l'identifiant du groupe
	 ** @return int 
	  */
	public function _getID(){
		return $this->g_id;
	}

	/*
	 ** @params 
	 ** @action retourne l'heure d'embauche du groupe
	 ** @return varchar
	  */
	public function _getDebutTravail(){
		return $this->g_debuttravail;
	}

	/*
	 ** @params 
	 ** @action retourne l'heure de debauche du groupe
	 ** @return varchar
	  */
	public function _getFinTravail(){
		return $this->g_fintravail;
	}

	/*
	 ** @params 
	 ** @action retourne l'identifiant de la taverne du group
	 ** @return int
	  */
	public function _getTaverne(){
		return $this->g_taverne_fk;
	}

	/*
	 ** @params 
	 ** @action retourne l'identifiant du tunnel du groupe
	 ** @return int
	  */
	public function _getTunnel(){
		return $this->g_tunnel_fk;
	}

	/*
	 ** @params varchar 
	 ** @action modifie l'heure d'embauche du groupe
	 ** @return
	  */
	public function _setDebutTravail($debut){
		$this->g_debuttravail = $debut;
	}

	/*
	 ** @params varchar 
	 ** @action modifie l'heure de debauche du groupe
	 ** @return
	  */
	public function _setFinTravail($fin){
		$this->g_fintravail = $fin;
	}

	/*
	 ** @params int || 'aucun' 
	 ** @action modifie la taverne  associé au groupe
	 ** @return
	  */
	public function _setTaverne($taverneID){
		$this->g_taverne_fk = $taverneID;
	}

	/*
	 ** @params int || 'aucun'
	 ** @action modifie le tunnel  associé au groupe
	 ** @return
	  */
	public function _setTunnel($tunnelID){
		$this->g_tunnel_fk = $tunnelID;
	}
}