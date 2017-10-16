<?php
class Taverne{
	/*
	 ** int Identifiant de la taverne
	  */
	private $t_id;

	/*
	 ** varchar nom de la taverne
	  */
	private $t_nom;

	/*
	 ** int Nombre de chambres totale de la taverne
	  */
	private $t_chambres;

	/*
	 ** bool Disponibilité en biere blonde
	  */
	private $t_blonde;

	/*
	 ** bool Disponibilité en biere brune
	  */
	private $t_brune;

	/*
	 ** bool Disponibilité en biere rousse
	  */
	private $t_rousse;

	/*
	 ** int l'identifiant de la ville ou se situe la taverne
	  */
	private $t_ville_fk;

	/*
	 ** int nombre de lits disponibles dans la taverne
	  */
	private $t_placesLibres;

	/*
	 ** @params array Tableau qui comprend toutes les informations nécèssaires à la création d'une instance de Taverne
	 ** @action Instancie une taverne
	 ** @return 
	  */
	public function __construct($data){
		$this->t_id = $data['t_id'];
		$this->t_nom = $data['t_nom'];
		$this->t_chambres = $data['t_chambres'];
		$this->t_blonde = $data['t_blonde'];
		$this->t_brune = $data['t_brune'];
		$this->t_rousse = $data['t_rousse'];
		$this->t_ville_fk = $data['t_ville_fk'];
		$this->t_placesLibres = $data['placesLibres'];
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant de la taverne
	 ** @return int
	  */
	public function _getID(){
		return $this->t_id;
	}

	/*
	 ** @params
	 ** @action retourne le nom de la taverne
	 ** @return varchar
	  */
	public function _getNom(){
		return $this->t_nom;
	}

	/*
	 ** @params
	 ** @action retourne le nombre total de lits de la taverne
	 ** @return int
	  */
	public function _getChambres(){
		return $this->t_chambres;
	}

	/*
	 ** @params
	 ** @action retourne la disponibilite en biere blonde de la taverne
	 ** @return bool
	  */
	public function _getBlonde(){
		return $this->t_blonde;
	}

	/*
	 ** @params
	 ** @action retourne la disponibilite en biere brune de la taverne
	 ** @return bool
	  */
	public function _getBrune(){
		return $this->t_brune;
	}

	/*
	 ** @params
	 ** @action retourne la disponibilite en biere rousse de la taverne
	 ** @return bool
	  */
	public function _getRousse(){
		return $this->t_rousse;
	}

	/*
	 ** @params
	 ** @action retourne l'identifiant de la ville ou se situe la taverne
	 ** @return int
	  */
	public function _getVille(){
		return $this->t_ville_fk;
	}

	/*
	 ** @params
	 ** @action retourne le nombre de lits disponible de la taverne
	 ** @return int
	  */
	public function _getPlacesLibres(){
		return $this->t_placesLibres;
	}
}