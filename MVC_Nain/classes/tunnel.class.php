<?php
class Tunnel{
	/*
	 ** int identifiant du tunnel
	  */
	private $t_id;
	/*
	 ** int pourcentage de progression du tunnel
	  */
	private $t_progres;
	/*
	 ** int identifiant de la ville de départ du tunnel
	  */
	private $t_villedepart_fk;
	/*
	 ** int identifiant de la ville d'arrivee du tunel
	  */
	private $t_villearrivee_fk;

	/*
	 ** @params array Tableau qui comprend toutes les informations nécessaires à la création d'une instance de Tunnel
	 ** @action Instancie un tunnel
	 ** @return 
	  */
	public function __construct(array $data){
		$this->t_id = $data['t_id'];
		$this->t_progres = $data['t_progres'];
		$this->t_villedepart_fk = $data['t_villedepart_fk'];
		$this->t_villearrivee_fk = $data['t_villearrivee_fk'];
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant du tunnel
	 ** @return int
	  */
	public function _getID(){
		return $this->t_id;
	}

	/*
	 ** @params
	 ** @action retourne le pourcentage de progression du tunnel
	 ** @return int
	  */
	public function _getProgres(){
		return $this->t_progres;
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant de la ville de départ du tunnel
	 ** @return int
	  */
	public function _getVilleDepart(){
		return $this->t_villedepart_fk;
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant de la ville d'arrivee du tunnel
	 ** @return int
	  */
	public function _getVilleArrivee(){
		return $this->t_villearrivee_fk;
	}	
}