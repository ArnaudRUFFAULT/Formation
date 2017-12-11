<?php
class Produit{
	private $id;
	private $nom;
	private $prix;
	private $poids;
	private $largeur;
	private $hauteur;
	private $profondeur;
	private $installable;
	private $occasion;

	public function __construct(array $data){
		$this->id = $data['p_id'];
		$this->nom = $data['p_nom'];
		$this->prix = $data['p_prix'];
		$this->poids = $data['p_poids'];
		$this->largeur = $data['p_largeur'];
		$this->hauteur = $data['p_hauteur'];
		$this->profondeur = $data['p_profondeur'];
		$this->installable = $data['p_installable'];
		$this->occasion = $data['p_occasion'];
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
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @return mixed
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * @return mixed
     */
    public function getLargeur()
    {
        return $this->largeur;
    }

    /**
     * @return mixed
     */
    public function getHauteur()
    {
        return $this->hauteur;
    }

    /**
     * @return mixed
     */
    public function getProfondeur()
    {
        return $this->profondeur;
    }

    /**
     * @return mixed
     */
    public function getInstallable()
    {
        return $this->installable;
    }

    /**
     * @return mixed
     */
    public function getOccasion()
    {
        return $this->occasion;
    }

    public function getEtat(){
    	return $this->occasion == 0 ? 'neuf' : 'occasion';
    }
}