<?php
class Nain{
	/*
	 ** int Identifiant du nain
	  */
	private $n_id = NULL;

	/*
	 ** varchar Nom du nain
	  */
	private $n_nom;

	/*
	 ** float Taille de la barbe du nain en cm
	  */
	private $n_barbe;

	/*
	 ** int ou NULL  Identifiant du groupe du nain
	  */
	private $n_groupe_fk;

	/*
	 ** int Identifiant de la ville d'origine du nain
	  */
	private $n_ville_fk;

	/*
	 ** @params array Tableau qui comprend toutes les information à la création d'une instance de Nain
	 ** @action Instancie un nain
	 ** @return 
	  */
	public function __construct(array $data){
		$this->n_id = $data['n_id'];
		$this->n_nom = $data['n_nom'];
		$this->n_barbe = $data['n_barbe'];
		$this->_setGroupe($data['n_groupe_fk']);
		$this->n_ville_fk = $data['n_ville_fk'];
	}

	/*
	 ** @params 
	 ** @action retourne l' Identifiant du nain
	 ** @return int 
	  */
	public function _getID(){
		return $this->n_id;
	}

	/*
	 ** @params
	 ** @action retourne le nom du nain
	 ** @return varchar 
	  */
	public function _getNom(){
		return $this->n_nom;
	}

	/*
	 ** @params
	 ** @action retourne la taille de la barbe du nain
	 ** @return float 
	  */
	public function _getBarbe(){
		return $this->n_barbe;
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant du groupe du nain
	 ** @return int || NULL 
	  */
	public function _getGroupe(){
		return $this->n_groupe_fk;
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant de la ville d'origine du nain
	 ** @return int 
	  */
	public function _getVille(){
		return $this->n_ville_fk;
	}

	/*
	 ** @params int || NULL 
	 ** @action Modifie l'identifiant de la ville d'origine du nain
	 ** @return
	  */
	public function _setGroupe($Groupe){
		if (empty($Groupe)) {
			$this->n_groupe_fk = 'aucun';
		}
		else{
			$this->n_groupe_fk = $Groupe;
		}
	}
}