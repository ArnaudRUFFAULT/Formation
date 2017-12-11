<?php
class Livraison extends Service{

	public function __construct(Produit $produit, User $client){
		parent::__construct($produit,$client);
		$this->name = 'Livraison';
		$this->calculatePriceService();
	}

	public function calculatePriceService(){
		$volume = $this->produit->getLargeur() * $this->produit->getProfondeur() * $this->produit->getHauteur();
		if(($this->produit->getPoids() < 2 && $volume < 1000000) || $this->produit->getPrix()> 150){
			$this->tarif = 0;
		}
		else{
			$tranche = ceil($this->produit->getPoids()/10);
			$tarif = $tranche * 5;
			$this->tarif = $tarif;
		}
	}

	public function getAdresseLivraison(){
		return $this->client->getAdresseLivraison();
	}
}