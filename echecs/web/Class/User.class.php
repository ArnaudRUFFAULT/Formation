<?php
class User {
    /**
     * Identifiant de l'utilisateur(correspond à la clé primaire de la table user dans la BDD)
     * @var int
     */
	private $id;

    /**
     * Pseudo de l'utilisateur
     * @var string 
     */
	private $pseudo;

    /**
     * Permet d'instancier un User
     * @param array $data Contient toutes les informations nécessaire àl'instanciation
     */
	public function __construct(array $data){
		$this->id = $data['u_id'];
		$this->pseudo = $data['u_pseudo'];
	}

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param string $pseudo
     *
     * @return self
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }
}