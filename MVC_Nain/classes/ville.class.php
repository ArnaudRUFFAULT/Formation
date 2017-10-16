<?php
class Ville{
	/*
	 ** int identifiant de la ville
	  */
	private $v_id;

	/*
	 ** varchar nom de la ville
	  */
	private $v_nom;

	/*
	 ** int superficie de la ville en km²
	  */
	private $v_superficie;

	/*
	 ** @params array Tableau qui comprend toutes les informations nécessaires à la création d'une instance de Ville
	 ** @action Instancie une ville
	 ** @return 
	  */
	public function __construct($data){
		$this->v_id = $data['v_id'];
		$this->v_nom = $data['v_nom'];
		$this->v_superficie = $data['v_superficie'];
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant de la ville
	 ** @return int
	  */
	public function _getID(){
		return $this->v_id;
	}

	/*
	 ** @params
	 ** @action retourne le nom de la ville
	 ** @return varchar
	  */
	public function _getNom(){
		return $this->v_nom;
	}

	/*
	 ** @params
	 ** @action retourne la superficie en km² de la ville
	 ** @return int
	  */
	public function _getSuperficie(){
		return $this->v_superficie;
	}
}