<?php
class Installation extends Service{

	public function __construct(Produit $produit, User $client){
		parent::__construct($produit,$client);
		$this->name = 'Installation';
		$this->calculatePriceService();
	}

	public function calculatePriceService(){
		$tarif = 0;
		if($this->produit->getOccasion()){
			$tarif += 10;
		}
		$this->tarif = $tarif;
	}
}