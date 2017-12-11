<?php
class User{
	private $id;
	private $mail;
	private $password;
	private $adresseLivraison;
	private $nom;
	private $prenom;

	public function __construct(array $data){
		$this->id = $data['u_id'];
		$this->mail = $data['u_mail'];
		$this->password = $data['u_password'];
		$this->adresseLivraison = $data['u_adresseLivraison'];
		$this->nom = $data['u_nom'];
		$this->prenom = $data['u_prenom'];
	}

	public function getId(){
		return $this->id;
	}

	public function getAdresseLivraison(){
		return $this->adresseLivraison;
	}

}