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
	private $latitude;

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

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDepartement()
    {
        return $this->departement;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getCodePostal()
    {
        return $this->code_postal;
    }

    /**
     * @return mixed
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * @return mixed
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * @return mixed
     */
    public function getSurface()
    {
        return $this->surface;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }
}