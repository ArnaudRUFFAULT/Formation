<?php
class Ville implements JsonSerializable {
	private $id;
	private $departement;
	private $nom;
	private $code_postal;
	private $commune;
	private $population;
	private $surface;
	private $longitude;
	private $latitute;

	public function __construct(array $data){
		$this->id = $data['ville_id'];
		$this->departement = $data['ville_departement'];
		$this->nom = $data['ville_nom_reel'];
		$this->code_postal = $data['ville_code_postal'];
		$this->commune = $data['ville_commune'];
		$this->population = $data['ville_population'];
		$this->surface = $data['ville_surface'];
		$this->longitude = $data['ville_longitude_deg'];
		$this->latitude = $data['ville_latitude_deg'];
	}

	public function jsonSerialize(){
		$array = [
			'id'=>$this->id,
			'departement'=>$this->departement,
			'nom'=>$this->nom,
			'codePostal'=>$this->code_postal,
			'commune'=>$this->commune,
			'population'=>$this->population,
			'surface'=>$this->surface,
			'longitude'=>$this->longitude,
			'latitude'=>$this->latitude
		];
		return $array;
	}
}