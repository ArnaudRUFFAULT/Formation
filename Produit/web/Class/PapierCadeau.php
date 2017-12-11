<?php
class PapierCadeau extends Service{

	private $message;

	public function __construct(Produit $produit, User $client){
		parent::__construct($produit,$client);
		$this->name = 'Papier Cadeau';
		$this->calculatePriceService();
	}

	public function calculatePriceService(){
		$tarif = 1;
		if(date('M') == 'Dec'){
			$tarif = 0;
		}
		$this->tarif = $tarif;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}
}